<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Saga
 *
 * @property int $id
 * @property string $nombre
 * @property Carbon $creada
 * @property Carbon $modificada
 *
 * @property Collection|Secuela[] $secuelas
 *
 * @package App\Models
 */
class Saga extends Model
{
    const CREATED_AT = 'creada';
    const UPDATED_AT = 'modificada';

    /**
     * Castings
     *
     * @var string[]
     */
    protected $casts = [
        'creada' => 'datetime',
        'modificada' => 'datetime'
    ];

    /**
     * Atributos asignables.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
    ];

    /**
     * Obtiene las secuelas.
     */
    public function secuelas(): HasMany
    {
        return $this->hasMany(Secuela::class);
    }
}
