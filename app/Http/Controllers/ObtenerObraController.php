<?php

namespace App\Http\Controllers;

use App\Models\Obra;
use DB;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class ObtenerObraController extends Controller
{
    /**
     * Para obtener los datos iniciales/base de la obra con relaciones
     * @param $titulo
     * @return \Illuminate\Database\Eloquent\Collection|Builder[]
     */
    public function obtenerDatosObra($titulo): array|\Illuminate\Database\Eloquent\Collection
    {
        return Obra::with(['poster', 'secuela:saga_id,obra_id,orden', 'criticas', 'directors:nombre,edad,defuncion,pais', 'festivals:obra_id,nombre,edicion', 'profesionals:obra_id,medio_id,autor,contenido', 'evaluaciones:obra_id,user_id,evaluacion', 'actors:nombre,nombre_real,edad,defuncion,pais', 'generos:genero'])->where('titulo', '=', "$titulo")->get();
    }

    /**
     * Para devolver la nota media de todas las evaluaciones, devuelve 0 si no hay evaluaciones
     * @param $evaluaciones
     * @return float
     */
    public function calcularMediaEvaluaciones($evaluaciones): float
    {
        $sumatorio = 0;
        foreach ($evaluaciones as $eva){
            $sumatorio += $eva['evaluacion'];
        }
        if(count($evaluaciones) == 0){
            return 0;
        }
        return round($sumatorio/count($evaluaciones), 1);
    }

    /**
     * Crea un array con el contenido, likes y fecha de cada critica para la vista
     * @param $criticas
     * @return array
     */
    public function obtenerArrayInfoCriticas($criticas): array
    {
        $criticasLikes = array();
        foreach ($criticas as $critica){
            $criticasLikes[] =  [
                'critica' => $critica['critica'],
                'likes' => DB::table('likes')->where('critica_id', '=', $critica['id'])->count(),
                'fecha' => $critica['modificada'],
                'usuario' => DB::table('users')->select('nombre', 'apellido')->where('id', '=', $critica['user_id'])->get()
                ];
        }
        return $criticasLikes;
    }

    /**
     * Para obtener el nombre de la saga si la hay
     * @param $esSecuela
     * @return Collection|string
     */
    public function obtenerSaga($esSecuela): Collection|string
    {
        $saga = '';
        if(isset($esSecuela['saga_id'])){
            $saga = DB::table('sagas')->select('nombre')->where('id', '=', $esSecuela['saga_id'])->get();
        }
        return $saga;
    }

    /**
     * Para obtener la secuela/precuela si las hubiera
     * @param $obra
     * @return mixed
     */
     public function obtenerSecuelaPrecuela($obra): mixed
     {
         // Si es una secuela esta obra
        if(isset($obra[0]['secuela'])){
            // Obtenemos su orden en la saga
            $orden = $obra[0]['secuela']['orden'];
            $secuelaPrecuela = array();
            // Obtenemos las array con las pelis de la saga
            $secuelas = DB::table('secuelas')->select('saga_id', 'obra_id', 'orden')->where('saga_id', '=', $obra[0]['secuela']['saga_id'])->orderBy('orden', 'desc')->get();
            //proceso el array $secuelas para orden + 1 (secuela) y orden - 1 (precuela) y orden = 0 (spin-off)
            foreach ($secuelas as $esSecuela){
                if( ($esSecuela->orden == 0 && $orden >= 1) || (($orden - 1)  == $esSecuela->orden || ($orden + 1) == $esSecuela->orden)){
                    $secuelaPrecuela[] = $esSecuela->obra_id;
                }
            }
            return Obra::with('poster', 'secuela:obra_id,orden')->find($secuelaPrecuela);
        }
        return null;
    }

    /**
     * Para generar array con la info de las criticas profesionales
     * @param $obra
     * @return array|null
     * @throws Exception
     */
    public function obtenerInfoMediosProfesionals($obra): ?array
    {
        if(count($obra[0]['profesionals']) > 0){
            $arrayProfesionals = array();
            foreach ( $obra[0]['profesionals'] as $profesional ){
                $infoMedio = DB::table('medios')->find($profesional['medio_id']);
                $arrayProfesionals[] =  ['medio' => $infoMedio->nombre, 'web' => $infoMedio->web, 'contenido' => $profesional->contenido, 'autor' => $profesional['autor']];
            }
            return $arrayProfesionals;
        }
        return null;
    }

    /**
     * Se organizan y recopilan todos los datos necesarios para pasar a la ficha de película
     * @param $titulo
     * @return Response
     * @throws Exception
     */
    public function fichaPelicula($titulo)
{
        $titulo = rawurldecode($titulo);
        $obra = $this->obtenerDatosObra($titulo);

        return Inertia::render('Obra', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'obra' => $obra,
            'mediaEvaluaciones' => $this->calcularMediaEvaluaciones($obra[0]['evaluaciones']),
            'criticas' => $this->obtenerArrayInfoCriticas($obra[0]['criticas']),
            'saga' => $this->obtenerSaga($obra[0]['secuela']),
            'secuelaPrecuela' => $this->obtenerSecuelaPrecuela($obra),
            'profesionales' => $this->obtenerInfoMediosProfesionals($obra),
            ]);
    }
}
