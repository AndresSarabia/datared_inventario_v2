<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'nombre',
        'apellidos',
        'ci',
        'sexo',
        'cargo',
        'telefono',
        'direccion',
        'email',
        'password',
        'perfil',
        'estado',
        'created_at',
        'updated_at',
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
        'email_verified_at' => 'datetime',
    ];

    public function adminlte_desc()
    {
        return $this->nombre . ' ' . $this->apellidos;
    }

    public function adminlte_image()
    {
        return '/images/user2-160x160.jpg';
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function syncPerfilWithRole()
    {
        $map = [
            'admin' => 'administrador',
            'supervisor' => 'supervisor',
            'tecnico' => 'tecnico',
            'user' => 'user',
        ];

        $role = $this->getRoleNames()->first();

        if ($role && isset($map[$role])) {
            $this->perfil = $map[$role];
            $this->save();
        }
    }

    public function getPerfilColorAttribute()
    {
        return match ($this->perfil) {
            'administrador' => 'primary',
            'supervisor' => 'info',
            'tecnico' => 'secondary',
            default => 'light',
        };
    }

    public function getFechaRegistroAttribute()
    {
        return $this->created_at->format('d/m/Y H:i:s');
    }
}
