<?php

declare(strict_types=1);

namespace Ardiakov\Paginator;

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

    public function countPages(): int
    {
        return (int)ceil($this->dataProvider->countItems() / $this->dataProvider->getCurrentPage()->getLimit());
    }

    public function paginate(): array
    {
        return [
            'totalItems' => $this->dataProvider->countItems(),
            'totalPages' => $this->countPages(),
            'data' => $this->dataProvider->getData(),
            'currentPage' => $this->dataProvider->getCurrentPage()->getPage(),
        ];
    }
}
