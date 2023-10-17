<?php

namespace App\Models;

use http\Env\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productoTraducciones extends Model
{
    use HasFactory;
    protected $table = 'r_producto_traducciones';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public static function guardarIngles($datos, $prod)
    {
        $ingles = new productoTraducciones();
        $ingles -> id_producto = $prod['id'];
        $ingles -> nombre = $datos['nombreEn'];
        $ingles -> descripcion_corta = $datos['descripcionCortaEn'];
        $ingles -> descripcion_larga = $datos['descripcionLargaEn'];
        $ingles -> url = $datos['urlEn'];
        $ingles -> idioma = 'en';
        $ingles -> save();
    }

    public static function guardarEspaniol($datos, $prod)
    {

        $espaniol = new productoTraducciones();
        $espaniol -> id_producto = $prod['id'];
        $espaniol -> nombre = $datos['nombreEs'];
        $espaniol -> descripcion_corta = $datos['descripcionCortaEs'];
        $espaniol -> descripcion_larga = $datos['descripcionLargaEs'];
        $espaniol -> url = $datos['urlEs'];
        $espaniol -> idioma = 'es';
        $espaniol -> save();
    }
}
