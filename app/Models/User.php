<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $apellido
 * @property Carbon|null $edad
 * @property string|null $pais
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $creado
 * @property Carbon|null $modificado
 *
 * @property Collection|Critica[] $criticas
 * @property Collection|Evaluacion[] $evaluaciones
 * @property Collection|Like[] $likes
 *
 * @package App\Models
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    

    /**
     * Atributos asignables.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'username',
        'age',
        'country',
        'email',
        'password',
        'email_verified_at',
        'google_id'
    ];

    /**
     * Atributos escondidos.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Castings.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'age' => 'datetime',
        'creado' => 'datetime',
        'modificado' => 'datetime',
        'email_verified_at' => 'datetime',
    ];


    public static function generateUserName($username)
    {
        if($username === null){
            $username = Str::lower(Str::random(8));
        }
        if(User::where('username', $username)->exists()){
            $newUsername = $username.Str::lower(Str::random(3));
            $username = self::generateUserName($newUsername);
        }
        return $username;
    }

    /**
     * Obtiene las críticas.
     */
    public function criticas(): HasMany
    {
        return $this->hasMany(Critica::class);
    }

    /**
     * Obtiene las evaluaciones.
     */
    public function evaluaciones(): HasMany
    {
        return $this->hasMany(Evaluacion::class);
    }

    /**
     * Obtiene los likes.
     */
    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(Critica::class, 'likes', 'user_id', 'critica_id', 'id', );
    }
}
