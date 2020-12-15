<?php

declare(strict_types=1);


namespace Pixelant\Demander\Service;

use TYPO3\CMS\Core\Database\Query\Expression\CompositeExpression;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;

/**
 * Main API entry point for using demands from the Demander Extension
 */
class DemandService implements \TYPO3\CMS\Core\SingletonInterface
{
    /**
     * Get active demand restrictions using configured DemandProviders
     *
     * @param array $tables Array of tables, where array key is table alias and value is a table name
     * @param QueryBuilder $queryBuilder
     * @return CompositeExpression
     */
    public function getRestrictions(
        array $tables,
        QueryBuilder $queryBuilder
    ): CompositeExpression
    {
        // TODO: Set $demandProviders with DemandProviders configured in TypoScript

        return $this->getRestrictionsFromDemandProviders($tables, $demandProviders);
    }

    /**
     * Get active demand restrictions using provided DemandProviders
     *
     * @param array $tables Array of tables, where array key is table alias and value is a table name
     * @param array $demandProviders Array of FQCNs
     * @param QueryBuilder $queryBuilder
     * @return CompositeExpression
     */
    public function getRestrictionsFromDemandProviders(
        array $tables,
        array $demandProviders,
        QueryBuilder $queryBuilder
    ): CompositeExpression
    {
        // TODO: Set $demandArray to merged, returned values of $demandProviders

        return $this->getRestrictionsFromDemandArray($tables, $demandArray);
    }

    /**
     * Get active demand restrictions using provided DemandProviders
     *
     * @param array $tables Array of tables, where array key is table alias and value is a table name
     * @param array $demandArray Demand array
     * @param QueryBuilder $queryBuilder
     * @return CompositeExpression
     */
    public function getRestrictionsFromDemandArray(
        array $tables,
        array $demandArray,
        QueryBuilder $queryBuilder
    ): CompositeExpression
    {
        // TODO: Most of the code for this class goes here
    }
}
