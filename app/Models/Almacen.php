<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    use HasFactory;

    protected $table = 'almacen';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'codigo',
        'descripcion',
        'estado',
        'created_at',
        'updated_at',
    ];
}
