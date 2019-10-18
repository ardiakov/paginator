<?php

declare(strict_types=1);

namespace Ardiakov\Paginator;

class Page
{
    private $page;

    private $limit;

    private function __construct()
    {
    }

    public static function create(?int $page, ?int $limit): self
    {
        $object = new self();
        $object->page = $page ?? 1;
        $object->limit = $limit ?? 6;

        return $object;
    }

    public function getOffset(): int
    {
        return ($this->page - 1) * $this->limit;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }
}
