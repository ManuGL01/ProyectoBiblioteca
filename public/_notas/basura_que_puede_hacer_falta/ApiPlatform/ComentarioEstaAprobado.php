<?php

namespace App\ApiPlatform;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryItemExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use Doctrine\ORM\QueryBuilder;
use App\Entity\Comentario;

class ComentarioEstaAprobado implements QueryItemExtensionInterface
{
    public function applyToItem(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, array $identifiers, string $operationName = null, array $context = [])
    {
        $this->addWhere($queryBuilder, $resourceClass);
    }

    private function addWhere(QueryBuilder $queryBuilder, string $resourceClass): void
    {
        if ($resourceClass !== Comentario::class) {
            return;
        }

        $rootAlias = $queryBuilder->getRootAliases()[0];
        var_dump($rootAlias);
        die();
        $queryBuilder->andWhere(sprintf('%s.aprobado = :aprobado', $rootAlias))
            ->setParameter('aprobado', true);
    }
}