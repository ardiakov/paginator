<?php

declare(strict_types=1);

namespace App\Services\Paginator;

class Paginator
{
    private $dataProvider;

    public static function create(): self
    {
        return new self();
    }

    public function setDataProvider(DataProviderInterface $dataProvider): self
    {
        $this->dataProvider = $dataProvider;

        return $this;
    }

    public function setCurrentPage(Page $page): self
    {
        $this->currentPage = $page;

        return $this;
    }

    public function paginate(): PaginatorResult
    {
        return new PaginatorResult(
            $this->dataProvider->countItems(),
            $this->dataProvider->countPages(),
            $this->dataProvider->getData(),
            $this->dataProvider->getCurrentPage()->getPage()
        );
    }
}
