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

    public static function obtenerProducto($id )
    {
        $producto = self::where('id', $id)
            ->first();
        $espaniol = ProductoTraducciones::obtenerEspaniol($id);
        $ingles = ProductoTraducciones::obtenerIngles($id);



        $datos = [
            "id" => $producto->id,
            "sku" => $producto->sku,
            "precioDolares" => $producto->precio_dolares,
            "precioPesos" => $producto->precio_pesos,
            "puntos" => $producto->puntos,
            "registroActivo" => $producto->registro_activo,



            "idEs" => $espaniol->id,
            "nombreEs" => $espaniol->nombre,
            "descripcionCortaEs" => $espaniol->descripcion_corta,
            "descripcionLargaEs" => $espaniol->descripcion_larga,
            "urlEs" => $espaniol->url,

            "idEn" => $ingles->id,
            "nombreEn" => $ingles->nombre,
            "descripcionCortaEn" => $ingles->descripcion_corta,
            "descripcionLargaEn" => $ingles->descripcion_larga,
            "urlEn" => $ingles->url,
        ];

        return $datos;

    }
}
