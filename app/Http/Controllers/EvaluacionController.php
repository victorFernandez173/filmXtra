<?php

namespace App\Http\Controllers;

use App\Models\Evaluacion;
use DB;

class EvaluacionController extends Controller
{
    public function evaluar(){

        $evaluacion = new Evaluacion([
            'user_id' => request('user_id'),
            'obra_id' => request('obra_id'),
            'evaluacion' => request('evaluacion')
        ]);

        if(DB::table('evaluaciones')->where('user_id', $evaluacion->user_id)->where('obra_id', $evaluacion->obra_id)->exists()){
            // Si la evaluación ya existía, se modifica
            $evaluacion->where('user_id', $evaluacion->user_id)->where('obra_id', $evaluacion->obra_id)->update(['evaluacion'=>$evaluacion->evaluacion]);
        } else {
            // Sino, se guarda
            $evaluacion->save();
        }
    }
}
