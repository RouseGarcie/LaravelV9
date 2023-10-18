<?php

namespace App\Http\Controllers;

use App\Models\Empleados;
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
        $prod = [
            "id" => null,
            "sku" => null,
            "precioDolares" => null,
            "precioPesos" => null,
            "puntos" => null,
            "registroActivo" => null,



            "idEs" => null,
            "nombreEs" => null,
            "descripcionCortaEs" => null,
            "descripcionLargaEs" => null,
            "urlEs" => null,

            "idEn" => null,
            "nombreEn" => null,
            "descripcionCortaEn" => null,
            "descripcionLargaEn" => null,
            "urlEn" => null,
        ];
        return view('productos.AgregarProductos',  ['prod' => $prod]);
    }

    public function guardar(Request $datos)
    {

       // try{

           $prod = Productos::guardarProducto($datos);

            ProductoTraducciones::guardarIngles($datos, $prod);
            ProductoTraducciones::guardarEspaniol($datos, $prod);

            return $this->index();

        /*}catch (\Exception $e){
            Log::error($e->getMessage());
            return back()->with('status','Ocurrió un error, revise los datos');
        } */
    }

    public function conversionPesos(Request $request)
    {
        $params = $request->all();
        $valor = SistemaGeneralController::conversion();
        return round($params['precio'] * $valor, 2); //El último dato (2) son los dígitos que debemos tomar
    }

    public function conversionDolar(Request $request)
    {
        try{
            $params = $request->all();

            $valor = SistemaGeneralController::conversion();

            return round($params['precio'] / $valor, 2);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return json_encode([
                'status' => 500,
                'message' => 'Error',
                'data' => null
            ]);
        }
    }

    public function editar($productoId): View
    {
        try {

            $prod = Productos::obtenerProducto($productoId);
            return view('productos.AgregarProductos',  ['prod' => $prod]);

        } catch (Exception $ex) {
            Log::error($ex->getMessage());

            return $this->index();
        }

    }



}
