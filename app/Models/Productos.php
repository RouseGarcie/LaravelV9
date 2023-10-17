<?php

namespace App\Models;

use http\Client\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;
    protected $table = 'm_productos';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public static function guardarProducto($producto )
    {
        $prod = new Productos();
        $prod -> sku = $producto['sku'];
        $prod -> precio_dolares = $producto['precioDolares'];
        $prod -> precio_pesos = $producto['precioPesos'];
        $prod -> puntos = $producto['puntos'];
        $prod -> registro_activo = true;
        $prod -> save();

        return $prod;
    }
}
