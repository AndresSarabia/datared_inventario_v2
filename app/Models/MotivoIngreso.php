<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotivoIngreso extends Model
{
    use HasFactory;

    protected $table = 'motivo_ingreso';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'descripcion',
        'obsv',
        'estado',
        'created_at',
        'updated_at',
    ];
}
