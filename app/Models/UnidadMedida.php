<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadMedida extends Model
{
    use HasFactory;

    protected $table = 'unidad_medida';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'codigo',
        'descripcion',
        'abreviatura',
        'estado',
        'created_at',
        'updated_at',
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class, 'FK_id_unidad');
    }
}
