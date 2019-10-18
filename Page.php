<?php

declare(strict_types=1);

namespace Ardiakov\Paginator;

use Ardiakov\Paginator\DataProviders\DoctrineDataProvider;

class Page
{
    private $page;

    private function __construct()
    {
    }

    public static function create(?int $page): self
    {
        $object = new self();
        $object->page = $page ?? 1;

        return $object;
    }

    public function getOffset(): int
    {
        return ($this->page - 1) * DoctrineDataProvider::LIMIT;
    }

    public function getPage(): int
    {
        return $this->page;
    }
}
