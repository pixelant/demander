<?php

declare(strict_types=1);


namespace Pixelant\Demander\Service;

use TYPO3\CMS\Core\Database\Query\Expression\CompositeExpression;
use TYPO3\CMS\Core\Database\Query\Expression\ExpressionBuilder;

/**
 * Main API entry point for using demands from the Demander Extension
 */
class DemandService implements \TYPO3\CMS\Core\SingletonInterface
{
    /**
     * Get active demand restrictions using configured DemandProviders
     *
     * @param array $tables Array of tables, where array key is table alias and value is a table name
     * @param ExpressionBuilder $expressionBuilder
     * @return CompositeExpression
     */
    public function getRestrictions(
        array $tables,
        ExpressionBuilder $expressionBuilder
    ): CompositeExpression
    {
        // TODO: Set $demandProviders with DemandProviders configured in TypoScript

        return $this->getRestrictionsFromDemandProviders($demandProviders, $tables, $expressionBuilder);
    }

    /**
     * Get active demand restrictions using provided DemandProviders
     *
     * @param array $demandProviders Array of FQCNs
     * @param array $tables Array of tables, where array key is table alias and value is a table name
     * @param ExpressionBuilder $expressionBuilder
     * @return CompositeExpression
     */
    public function getRestrictionsFromDemandProviders(
        array $demandProviders,
        array $tables,
        ExpressionBuilder $expressionBuilder
    ): CompositeExpression
    {
        // TODO: Set $demandArray to merged, returned values of $demandProviders

        return $this->getRestrictionsFromDemandArray($demandArray, $tables, $expressionBuilder);
    }

    /**
     * Get active demand restrictions using provided DemandProviders
     *
     * @param array $demandArray Demand array
     * @param array $tables Array of tables, where array key is table alias and value is a table name
     * @param ExpressionBuilder $expressionBuilder
     * @return CompositeExpression
     */
    public function getRestrictionsFromDemandArray(
        array $demandArray,
        array $tables,
        ExpressionBuilder $expressionBuilder
    ): CompositeExpression
    {
        // TODO: Most of the code for this class goes here
    }
}
