<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use App\Models\productoTraducciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ProductosController extends Controller
{
    //

    public function index(): View
    {

        $productos = DB::table('m_productos')
            ->join( 'r_producto_traducciones as trad', 'trad.id_producto', '=', 'm_productos.id')
            ->where('m_productos.registro_activo', 1)
            ->where( 'trad.idioma', App::getLocale())
            ->orderBy('m_productos.id')
            ->get();
        return view('dashboard', ['productos' => $productos]);
    }

    public function agregar(): View
    {
        return view('productos.agregarProductos');
    }

    public function guardar(Request $datos)
    {
        try{

           $prod = Productos::guardarProducto($datos);

            productoTraducciones::guardarIngles($datos, $prod);
            productoTraducciones::guardarEspaniol($datos, $prod);

            return $this->index();

        }catch (\Exception $e){
            Log::error($e->getMessage());
            return back()->with('status','Ocurrió un error, revise los datos');
        }




    }
}
