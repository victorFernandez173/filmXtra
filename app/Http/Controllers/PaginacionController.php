<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PaginacionController extends Controller
{
    /**
     * Para a partir de un array paginar los datos
     * @param $items
     * @param int $perPage
     * @param $page
     * @param array $options
     * @return LengthAwarePaginator
     */
    static function paginar($items, int $perPage = 5, $page = null, array $options = []): LengthAwarePaginator
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page,
            // Parametro: (array $options) clave para que la paginación cargue los datos de la siguiente pagina cogiendo el parametro 'page' de la url
            ['path' => Paginator::resolveCurrentPath()]
        );
    }
}
