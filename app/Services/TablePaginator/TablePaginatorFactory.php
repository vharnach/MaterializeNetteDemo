<?php declare(strict_types=1);

namespace App\Services\TablePaginator;

use Nette\Utils\Strings;

final class TablePaginatorFactory
{
    public function create(
        int $currentPage,
        int $itemsPerPage,
        string $orderDirection,
        string $orderBy = 'name',
    ): TablePaginator {
        $tablePaginator = new TablePaginator($this->resolveOrderDirection($orderDirection), $orderBy);

        $tablePaginator->setPage($currentPage);
        $tablePaginator->setItemsPerPage($itemsPerPage);

        return $tablePaginator;
    }


    private function resolveOrderDirection(string $orderDirection): string
    {
        return match(Strings::upper($orderDirection)) {
            'DESC', 'ASC' => Strings::upper($orderDirection),
            default => 'DESC',
        };
    }
}