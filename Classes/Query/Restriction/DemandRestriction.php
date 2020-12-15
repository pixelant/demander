<?php

declare(strict_types=1);

namespace Pixelant\Demander\Query\Restriction;


use TYPO3\CMS\Core\Database\Query\Expression\CompositeExpression;
use TYPO3\CMS\Core\Database\Query\Expression\ExpressionBuilder;
use TYPO3\CMS\Core\Database\Query\Restriction\QueryRestrictionInterface;

class DemandRestriction implements QueryRestrictionInterface
{
    public function buildExpression(array $queriedTables, ExpressionBuilder $expressionBuilder): CompositeExpression
    {
        return $expressionBuilder->andX([]);
    }
}