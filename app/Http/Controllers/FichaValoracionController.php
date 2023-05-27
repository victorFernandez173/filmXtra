<?php

namespace App\Http\Controllers;

use DB;
use Exception;
use Inertia\Inertia;
use Inertia\Response;

class FichaValoracionController extends Controller
{
    /**
     * Para cargar la vista con la info necesaria, se basa en las funcionalidades de ObtenerObraControler.php
     *
     * @throws Exception
     */
    public function obtenerFichaValoracion($titulo): Response
    {
        $titulo = rawurldecode($titulo);
        $obra = ObtenerObraController::obtenerDatosObra($titulo);

        return Inertia::render('FichaValoraciones', [
            'obra' => $obra,
            'mediaEvaluaciones' => ObtenerObraController::calcularMediaEvaluaciones($obra[0]['evaluaciones']),
            'criticas' => ObtenerObraController::obtenerArrayInfoCriticas($obra[0]['criticas']),
            'profesionales' => ObtenerObraController::obtenerInfoMediosProfesionals($obra),
        ]);
    }
}
