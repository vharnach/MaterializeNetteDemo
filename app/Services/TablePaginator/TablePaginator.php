<?php declare(strict_types=1);

namespace App\Services\TablePaginator;

use Nette\Utils\Paginator;

class TablePaginator extends Paginator
{
    private string $orderDirection;

    private string $orderBy;

    public function __construct(string $orderDirection, string $orderBy)
    {
        $this->orderDirection = $orderDirection;
        $this->orderBy = $orderBy;
    }

    public function getOrderDirection(): string
    {
        return $this->orderDirection;
    }

    public function getOrderBy(): string
    {
        return $this->orderBy;
    }
}