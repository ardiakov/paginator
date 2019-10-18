<?php

declare(strict_types=1);

namespace Ardiakov\Paginator;

class PaginatorResult
{
    private $totalItems;

    private $totalPages;

    private $currentData;

    private $currentPage;

    public function __construct(
        int $totalItems,
        int $totalPages,
        iterable $currentData,
        int $currentPage
    ) {
        $this->totalItems = $totalItems;
        $this->totalPages = $totalPages;
        $this->currentData = $currentData;
        $this->currentPage = $currentPage;
    }

    public function getTotalItems(): int
    {
        return $this->totalItems;
    }

    public function getTotalPages(): int
    {
        return $this->totalPages;
    }

    public function getCurrentData(): iterable
    {
        return $this->currentData;
    }

    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }
}
