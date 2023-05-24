<?php

namespace App\Http\Controllers;

use App\Models\Like;
use DB;

class LikeController extends Controller
{
    /**
     * @return void
     */
    public function darLike(): void
    {
        $like = new Like([
            'user_id' => request('user_id'),
            'critica_id' => request('critica_id'),
        ]);
        // Si el like ya existe, se elimina
        if (DB::table('likes')->where('user_id', $like['user_id'])->where('critica_id', $like['critica_id'])->exists()) {
            DB::table('likes')->where('user_id', $like['user_id'])->where('critica_id', $like['critica_id'])->delete();
        } else {
            // Sino, se guarda
            $like->save();
        }
    }
}
