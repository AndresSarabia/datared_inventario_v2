<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoProducto extends Model
{
    use HasFactory;

    protected $table = 'tipo_producto';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'codigo',
        'descripcion',
        'estado',
        'created_at',
        'updated_at',
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class, 'FK_id_tipo_producto');
    }
}
