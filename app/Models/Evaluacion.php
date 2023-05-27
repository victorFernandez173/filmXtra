<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Evaluacion
 *
 * @property int $id
 * @property int $obra_id
 * @property int $user_id
 * @property float $evaluacion
 * @property Carbon $creada
 * @property Carbon $modificada
 *
 * @property Obra $obra
 * @property User $user
 *
 * @package App\Models
 */
class Evaluacion extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'evaluaciones';

    const CREATED_AT = 'creada';
    const UPDATED_AT = 'modificada';

    /**
     * Castings
     * @var string[]
     */
    protected $casts = [
        'obra_id' => 'int',
        'user_id' => 'int',
        'evaluacion' => 'int',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'obra_id',
        'user_id',
        'evaluacion',
    ];

    /**
     * Get the obra associated with the evaluación.
     */
    public function obra(): BelongsTo
    {
        return $this->belongsTo(Obra::class);
    }

    /**
     * Get the user associated with the evaluación.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
