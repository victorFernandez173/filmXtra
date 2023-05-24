<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class GeneroObra
 *
 * @property int $obra_id
 * @property int $genero_id
 *
 * @property Genero $genero
 * @property Obra $obra
 *
 * @package App\Models
 */
class GeneroObra extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'genero_obra';

    /**
     * primaryKey
     *
     * @var null
     * @access protected
     */
    protected $primaryKey = null;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * No timestamps
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var int[]
     */
    protected $fillable = [
        'obra_id',
        'genero_id',
    ];

    /**
     * Castings
     *
     * @var string[]
     */
	protected $casts = [
		'obra_id' => 'int',
		'genero_id' => 'int'
	];

    /**
     * Obtiene el genero
     *
     * @return BelongsTo
     */
	public function genero(): BelongsTo
	{
		return $this->belongsTo(Genero::class);
	}

    /**
     * Obtiene la obra
     *
     * @return BelongsTo
     */
	public function obra(): BelongsTo
	{
		return $this->belongsTo(Obra::class);
	}
}
