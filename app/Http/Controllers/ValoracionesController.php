<?php

namespace App\Http\Controllers;

use App\Models\Obra;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Inertia\Inertia;
use Inertia\Response;

class ValoracionesController
{
    /**
     * Peticiones GET: carga inicial o enlaces de filtrado de la barra lateral
     * @return Response
     */
    public function cargarDatos(): Response
    {
        $obras = Obra::select('obras.titulo', 'p.ruta', 'p.alt', DB::raw('AVG(e.evaluacion) AS nota_media, COUNT(*) as num_valoraciones'))->join('posters AS p', 'obras.id', '=', 'p.obra_id')->leftJoin('evaluaciones AS e', 'obras.id', '=', 'e.obra_id')->groupBy('obras.titulo', 'p.ruta', 'p.alt')->orderBy('num_valoraciones', 'desc')->orderBy('obras.titulo')->paginate(12)->withQueryString();

        return Inertia::render('Valoraciones', ['obras' => $obras]);
    }
}
