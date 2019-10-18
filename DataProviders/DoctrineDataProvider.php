<?php

declare(strict_types=1);

namespace Ardiakov\Paginator\DataProviders;

use App\Services\Paginator\DataProviderInterface;
use App\Services\Paginator\Page;
use Doctrine\ORM\QueryBuilder;

class DoctrineDataProvider implements DataProviderInterface
{
    public const OFFSET = 0;
    public const LIMIT = 6;

    /**
     * @var QueryBuilder
     */
    private $queryBuilder;

    /**
     * @var Page
     */
    private $currentPage;

    public function __construct(QueryBuilder $queryBuilder, Page $currentPage)
    {
        $this->queryBuilder = $queryBuilder;
        $this->currentPage = $currentPage;
    }

    public function countPages()
    {
        return (int) ceil($this->countItems() / self::LIMIT);
    }

    public function getData(): iterable
    {
        return $this->queryBuilder
            ->setFirstResult($this->currentPage->getOffset())
            ->setMaxResults(self::LIMIT)
            ->getQuery()
            ->getResult();
    }

    public function countItems(): int
    {
        $cloneQb = clone $this->queryBuilder;

        $alias = $cloneQb->getRootAliases()[0];

        return $cloneQb->select(sprintf('count(%s)', $alias))
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function getCurrentPage(): Page
    {
        return $this->currentPage;
    }
}
