<?php

namespace App\Http\Controllers;

use App\Models\Like;
use DB;

class LikeController extends Controller
{
    /**
     * Para insertar tupla en likes o borrarla
     * @return void
     */
    public function darLike(): void
    {
        $like = new Like([
            'user_id' => request('user_id'),
            'critica_id' => request('critica_id'),
        ]);
        if (DB::table('likes')->where('user_id', $like['user_id'])->where('critica_id', $like['critica_id'])->exists()) {
            // Si el like ya existe, se elimina
            DB::table('likes')->where('user_id', $like['user_id'])->where('critica_id', $like['critica_id'])->delete();
        } else {
            // Sino, se guarda
            $like->save();
        }
    }
}
