<?php

(function (): void {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
        'demander',
        'Configuration/TypoScript',
        'Typoscript'
    );
})();
