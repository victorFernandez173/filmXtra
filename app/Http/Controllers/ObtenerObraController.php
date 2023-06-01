<?php

namespace App\Http\Controllers;

use Exception;
use Inertia\Inertia;
use Inertia\Response;

class ObtenerObraController extends Controller
{
    /**
     * Datos necesarios para pasar a la ficha de película
     * @param $titulo
     * @return Response
     * @throws Exception
     */
    public function fichaPelicula($titulo)
    {
        $titulo = rawurldecode($titulo);
        $obra = InfoController::obtenerDatosObra($titulo);

        return Inertia::render('Obra', [
            'obra' => $obra,
            'mediaEvaluaciones' => InfoController::calcularMediaEvaluaciones($obra[0]['evaluaciones']),
            'criticas' => InfoController::obtenerArrayInfoCriticas($obra[0]['criticas']),
            'saga' => InfoController::obtenerSaga($obra[0]['secuela']),
            'secuelaPrecuela' => InfoController::obtenerSecuelaPrecuela($obra),
            'profesionales' => InfoController::obtenerInfoMediosProfesionals($obra),
            //Numero de gifs disponibles en public/gif
            'nGifs' => count(glob( public_path('/gif/') . '*')) - 2
        ]);
    }
}
