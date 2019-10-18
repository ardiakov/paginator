Paginator
---

- Need to implement DataProviderInterface

    Example DataProvider for Doctrine ORM:

    ```
    class DoctrineDataProvider implements DataProviderInterface
    {
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
    
        public function getData(): iterable
        {
            return $this->queryBuilder
                ->setFirstResult($this->currentPage->getOffset())
                ->setMaxResults($this->currentPage->getLimit())
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
    ```

- Call Paginator
    ```
     $page - page number from request (int)
    
     Paginator::create()
        ->setDataProvider(new DoctrineDataProvider($qb, Page::create($page,6)))
        ->paginate();
    ```


Result
---

```
[
    totalItems: 124,
    totalPages: 10,
    currentPage: 1,
    data: []
]

```
