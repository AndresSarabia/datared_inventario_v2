<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'producto';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'codigo',
        'descripcion',
        'FK_id_tipo_producto',
        'FK_id_unidad',
        'estado',
        'created_at',
        'updated_at',
    ];

    public function tipoProducto()
    {
        return $this->belongsTo(TipoProducto::class, 'FK_id_tipo_producto');
    }

    public function unidadMedida()
    {
        return $this->belongsTo(UnidadMedida::class, 'FK_id_unidad');
    }
}
