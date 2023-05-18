<?php

namespace App\Http\Controllers;

use App\Models\Obra;
use Carbon\Carbon;
use DB;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class FiltrarObrasController extends Controller
{
    /**
     * Peticiones GET: carga inicial o enlaces de filtrado de la barra lateral
     * @return Response
     * @throws Exception
     */
    public function cargaDatos(): Response
    {
        // Si no hay valor se asigna valor vacío
        $desde = request('desde') ?? '';
        $hasta = request('hasta') ?? '';
        $pais = request('pais') ?? '';
        $genero = request('genero') ?? '';

        // Consulta multicondición para obtener películas
        $d = request('desde') ?: '1870';
        $h = request('hasta') ?: Carbon::now()->format('Y');
        $obras = Obra::with('poster')->where(
            'pais', 'like', '%' . $pais . '%')->whereBetween('fecha', [$d, $h])->whereHas('generos', function (Builder $query) use ($genero) {
            $query->where('genero', 'like', '%' . $genero . '%');
        })->paginate(12)->withQueryString();

        // Renderizamos & props
        return Inertia::render('Obras', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'obras' => $obras,
            'generos' => DB::table('generos')->select('genero')->get(),
            'paises' => DB::table('obras')->select('pais')->groupBy('pais')->orderBy('pais')->get(),
            'filtros' => [$genero, $pais, $desde, $hasta],
        ]);
    }
}
