<?php

declare(strict_types=1);

namespace App\Services\Paginator;

interface DataProviderInterface
{
    public function countPages();

    public function getData(): iterable;

    public function countItems(): int;

    public function getCurrentPage(): Page;
}
