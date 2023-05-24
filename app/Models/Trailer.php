<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Trailer
 *
 * @property int $obra_id
 * @property string $trailers
 *
 * @property Obra $obra
 *
 * @package App\Models
 */
class Trailer extends Model
{
    /**
     * The primary key associated with the table.
     *
     * @var integer
     */
    protected $primaryKey = 'obra_id';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    const CREATED_AT = 'creado';
    const UPDATED_AT = 'modificado';

    /**
     * The attributes that are mass assignable.
     *
     * @var int[]
     */
    protected $fillable = [
        'obra_id',
        'trailers',
    ];

    /**
     * Castings
     *
     * @var string[]
     */
	protected $casts = [
		'obra_id' => 'int',
        'creado' => 'datetime',
        'modificado' => 'datetime'
	];

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
