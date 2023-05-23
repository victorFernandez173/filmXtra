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
 * @property Carbon $creado
 * @property Carbon $modificado
 * @property string|null $provider
 * @property string|null $provider_id
 * @property string|null $provider_token
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

    const CREATED_AT = 'creado';
    const UPDATED_AT = 'modificado';
    /*public $timestamps = false;*/


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'apellido',
        'edad',
        'pais',
        'email',
        'password',
        'username',
        'provider',
        'provider_id',
        'provider_token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'edad' => 'datetime',
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
     * Get the criticas that belong to the user.
     */
    public function criticas(): HasMany
    {
        return $this->hasMany(Critica::class);
    }

    /**
     * Get the evaluaciones that belong to the user.
     */
    public function evaluaciones(): HasMany
    {
        return $this->hasMany(Evaluacion::class);
    }

    /**
     * Get the likes that belong to the user.
     */
    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(Critica::class);
    }
}
