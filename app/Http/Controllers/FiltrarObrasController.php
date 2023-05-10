<?php

namespace App\Http\Controllers;

use App\Models\Obra;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class FiltrarObrasController extends Controller
{
    /**
     * Para obtener la información de una obra
     * @throws Exception
     */
    public function cargaDatos(){
        $obras = null;
        if(count(request()->all()) == 0){
            $obras = Obra::with('poster')->get();
        } else {
            if(request()->has('genero')){
                $obras = Obra::with('poster', 'generos') ->whereHas('generos', function (Builder $query) { $query->where('genero', 'like', '%'. request('genero') .'%');})->get()->toArray();
            }
        }

        return Inertia::render('Obras', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'obras' => $obras]);
    }
}
