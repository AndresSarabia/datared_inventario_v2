<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'proveedor';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'codigo',
        'razon_social',
        'nit',
        'telefono',
        'direccion',
        'tipo_prov',
        'contacto',
        'celular',
        'email_cont',
        'email_prov',
        'obsv',
        'estado',
        'created_at',
        'updated_at',
    ];
}
