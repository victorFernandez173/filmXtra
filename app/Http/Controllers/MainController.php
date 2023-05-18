<?php

namespace App\Http\Controllers;

use Arr;
use DB;
use Inertia\Inertia;
use App\Models\Obra;
use Illuminate\Support\Facades\Route;
use Exception;

class MainController extends Controller
{
    /**
     * @throws Exception
     */
    public function obtenerDoceObrasAleatorias(){
        $numPeliculas = DB::table('obras')->count();
        $peliculasId = [];
        for($i = 0; $i < 16; $i++){
            $aleatorio = random_int(1, $numPeliculas);
            while(in_array($aleatorio, $peliculasId)){
                $aleatorio = random_int(1, $numPeliculas);
            }
            $peliculasId[] = $aleatorio;
        }
        return $peliculasId;
    }

    /**
     * @throws Exception
     */
    public function bienvenida(){
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'obras' => Obra::with('poster')->find($this->obtenerDoceObrasAleatorias()),
            'mostrarCarrusel' => true,
            'mostrarBarraLateral' => true,
        ]);
    }

    public function logueado(){
        return Inertia::render('Logueado');
    }

    /**
     * @throws Exception
     */
    public function fichaPelicula($titulo){
        $titulo = str_replace('_', ' ', $titulo);

        return Inertia::render('Obra', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'obra' => Obra::with(['poster', 'secuelas:saga_id,obra_id,orden', 'criticas', 'evaluaciones:obra_id,user_id,evaluacion', 'directors:nombre,edad,defuncion,pais', 'festivals:obra_id,nombre,edicion', 'profesionals:obra_id,medio_id,autor,web,contenido', 'actors:nombre,nombre_real,edad,defuncion,pais', 'generos:genero'])->where('titulo', '=', "$titulo")->get()]);
    }
}
