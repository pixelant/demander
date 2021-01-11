<?php

declare(strict_types=1);


namespace Pixelant\Demander\LinkHandler;


use Pixelant\PxaProductManager\Backend\Tree\BrowserTreeView;
use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\View\StandaloneView;
use TYPO3\CMS\Recordlist\Controller\AbstractLinkBrowserController;
use TYPO3\CMS\Recordlist\LinkHandler\AbstractLinkHandler;
use TYPO3\CMS\Recordlist\LinkHandler\LinkHandlerInterface;
use TYPO3\CMS\Recordlist\Tree\View\LinkParameterProviderInterface;

/**
 * Link handler for page links with preset demand
 */
class DemandLinkHandler implements
    LinkHandlerInterface,
    LinkParameterProviderInterface
{
    /**
     * Available additional link attributes
     *
     * 'rel' only works in RTE, still we have to declare support for it.
     *
     * @var string[]
     */
    protected $linkAttributes = ['target', 'title', 'class', 'params', 'rel'];

    /**
     * @var \TYPO3\CMS\Fluid\View\StandaloneView
     */
    protected $view;

    /**
     * @var int
     */
    protected int $expandPage = 0;

    /**
     * @var int
     */
    protected int $pid = 0;

    /**
     * @inheritDoc
     */
    public function getLinkAttributes()
    {
        return $this->linkAttributes;
    }

    /**
     * @inheritDoc
     */
    public function modifyLinkAttributes(array $fieldDefinitions)
    {
        return $fieldDefinitions;
    }

    /**
     * @inheritDoc
     */
    public function initialize(AbstractLinkBrowserController $linkBrowser, $identifier, array $configuration)
    {
        $this->linkBrowser = $linkBrowser;
        $this->view = GeneralUtility::makeInstance(StandaloneView::class);
        $this->view->getRequest()->setControllerExtensionName('recordlist');
        $this->view->setTemplateRootPaths([GeneralUtility::getFileAbsFileName('EXT:demander/Resources/Private/Templates/LinkBrowser')]);
        $this->view->setPartialRootPaths([GeneralUtility::getFileAbsFileName('EXT:demander/Resources/Private/Partials/LinkBrowser')]);
        $this->view->setLayoutRootPaths([GeneralUtility::getFileAbsFileName('EXT:demander/Resources/Private/Layouts/LinkBrowser')]);
    }

    /**
     * @inheritDoc
     */
    public function canHandleLink(array $linkParts)
    {
        var_dump($linkParts);
    }

    /**
     * @inheritDoc
     */
    public function formatCurrentUrl()
    {
        return 'demand:123?d[tablename-fieldname]=1-3';
    }

    /**
     * @inheritDoc
     */
    public function render(ServerRequestInterface $request)
    {
        $this->expandPage = (int)($request->getQueryParams()['expandPage'] ?? 0);

        GeneralUtility::makeInstance(PageRenderer::class)
            ->loadRequireJsModule('TYPO3/CMS/Demander/DemandLinkHandler');

        $tsConfig = $this->getBackendUser()->getTSConfig();

        /** @var BrowserTreeView $pageTree */
        $pageTree = GeneralUtility::makeInstance(BrowserTreeView::class);
        $pageTree->setLinkParameterProvider($this);
        $pageTree->ext_showNavTitle = (bool)($tsConfig['options.']['pageTree.']['showNavTitle'] ?? false);
        $pageTree->ext_showPageId = (bool)($tsConfig['options.']['pageTree.']['showPageIdWithTitle'] ?? false);
        $pageTree->ext_showPathAboveMounts = (bool)($tsConfig['options.']['pageTree.']['showPathAboveMounts'] ?? false);
        $pageTree->addField('nav_title');

        $this->view->assignMultiple([
            'expandActivePage' => $this->expandPage > 0, // TODO: Limit to pages on sites
            'tree' => $pageTree->getBrowsableTree()
        ]);

        return $this->view->render('DemandLinkHandler');
    }

    /**
     * @param array $values Values to be checked
     *
     * @return bool Returns TRUE if the given values match the currently selected item
     */
    public function isCurrentlySelectedItem(array $values): bool
    {
        $compareToPid = $this->expandPage ?: $this->pid;

        return $compareToPid === (int)$values['pid'];
    }

    /**
     * Returns the URL of the current script.
     *
     * @return string
     */
    public function getScriptUrl(): string
    {
        return $this->linkBrowser->getScriptUrl();
    }

    /**
     * @param array $values Array of values to include into the parameters or which might influence the parameters
     *
     * @return string[] Array of parameters which have to be added to URLs
     */
    public function getUrlParameters(array $values): array
    {
        $parameters = [
            'expandPage' => isset($values['pid']) ? (int)$values['pid'] : $this->expandPage,
        ];

        return array_merge($this->linkBrowser->getUrlParameters($values), $parameters);
    }

    /**
     * @inheritDoc
     */
    public function isUpdateSupported()
    {
        return false;
    }

    /**
     * @inheritDoc
     */
    public function getBodyTagAttributes()
    {
        return [];
    }

    /**
     * Sets a DB mount and stores it in the currently defined backend user in her/his uc
     */
    protected function setTemporaryDbMounts()
    {
        $backendUser = $this->getBackendUser();

        // Clear temporary DB mounts
        $tmpMount = GeneralUtility::_GET('setTempDBmount');
        if (isset($tmpMount)) {
            $backendUser->setAndSaveSessionData('pageTree_temporaryMountPoint', (int)$tmpMount);
        }

        $backendUser->initializeWebmountsForElementBrowser();
    }

    /**
     * @return BackendUserAuthentication
     */
    protected function getBackendUser()
    {
        return $GLOBALS['BE_USER'];
    }

    /**
     * @return LanguageService
     */
    protected function getLanguageService()
    {
        return $GLOBALS['LANG'];
    }
}
