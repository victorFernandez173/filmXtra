<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Like
 *
 * @property int $user_id
 * @property int $critica_id
 *
 * @property Critica $critica
 * @property User $user
 *
 * @package App\Models
 */
class Like extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'likes';

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
        'user_id',
        'critica_id',
    ];

    /**
     * Castings
     *
     * @var string[]
     */
	protected $casts = [
		'user_id' => 'int',
		'critica_id' => 'int'
	];

    /**
     * Obtiene la critica
     *
     * @return BelongsTo
     */
	public function critica(): BelongsTo
	{
		return $this->belongsTo(Critica::class);
	}

    /**
     * Obtiene el usuario
     *
     * @return BelongsTo
     */
	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}
}
