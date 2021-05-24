<?php

namespace Scooby\Helpers;

use Scooby\Core\Model;
use JasonGrimes\Paginator;

class Pagination
{
    /**
     * Cria Paginação de dados vindos do banco
     *
     * @param Model $model
     * @param integer $limit
     * @param string $urlPattern
     * @return array
     */
    public static function paginate(Model $model, int $limit, string $orderBy = 'DESC'): array
    {
        $currentPage = 1;
        if (!empty($_GET['page'])) {
            $currentPage = $_GET['page'];
        }
        $offset = ($currentPage * $limit) - $limit;
        $urlPattern = '?page=(:num)';
        $totalItems = $model::count();
        $info = $model->orderBy('id', $orderBy)->skip($offset)->take($limit)->get();
        $paginator = new Paginator((int) $totalItems, $limit, $currentPage, $urlPattern);
        return ['data' => $info, 'pages' => $paginator];
    }
}
