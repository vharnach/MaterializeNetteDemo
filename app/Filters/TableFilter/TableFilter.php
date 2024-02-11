<?php declare(strict_types=1);

namespace App\Filters\TableFilter;

class TableFilter
{
    private ?int $itemsPerPage;

    private int $currentPage;

    private string $orderBy;

    private string $orderDirection;
}