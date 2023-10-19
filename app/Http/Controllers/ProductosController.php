<?php

namespace App\Http\Controllers;

use App\Models\Empleados;
use App\Models\Productos;
use App\Models\productoTraducciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
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

    private function validaciones($datos)
    {


        $validatedData = $datos->validateWithBag('productos', [
            'sku' => ['required', 'unique:m_productos,sku'],
            'precioDolares' => ['required', 'numeric'],
            'precioPesos' => ['required', 'numeric'],
            'puntos' => ['required', 'numeric'],

            'nombreEs' => ['required', 'regex:/^[a-zA-Z0-9-]+$/'],
            'descripcionCortaEs' => ['required'],
            'urlEs' => ['required'],

            'nombreEn' => ['required', 'regex:/^[a-zA-Z0-9-]+$/'],
            'descripcionCortaEn' => ['required'],
            'urlEn' => ['required'],
        ]);

      //  return redirect('/admin/agregar')->withErrors($validatedData, 'productos');


        return Redirect::back()->withErrors($validatedData, 'productos');

    }

    public function guardar(Request $datos)
    {

     //  try{
        $this->validaciones($datos);


           $prod = Productos::guardarProducto($datos);

            ProductoTraducciones::guardarIngles($datos, $prod, true);
            ProductoTraducciones::guardarEspaniol($datos, $prod, true);



          return $this->index();

  /* } catch (\Exception $ex) {
        Log::error($ex->getMessage());
        return Redirect::back()->withInput()->withErrors();
         return Redirect::back()->with('message','Operation Successful !');
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


    public function obtenerDetalle($slug):View
    {
       // dd($slug);
        $news = ProductoTraducciones::join('m_productos as prod', 'prod.id', '=', 'r_producto_traducciones.id_producto' )
            ->where('url', $slug)->firstOrFail();

        $prod = [
            "id" => $news->id,
            "sku" => $news->sku,
            "precioDolares" => $news->precio_dolares,
            "precioPesos" => $news->precio_pesos,
            "puntos" => $news->puntos,
            "nombre" => $news->nombre,
            "descripcionCorta" => $news->descripcion_corta,
            "descripcionLarga" => $news->descripcion_larga,



        ];


        return view('productos.DetalleGrafica', ['prod' => $prod]);

    }

    public function guardarEdicion(Request $datos)
    {



            $validatedData =  \Validator::make($datos->all(), [

                'precioDolares' => 'required|numeric',
                'precioPesos' => 'required|numeric',
                'puntos' => 'required|numeric',

                'nombreEs' => 'required|regex:/^[a-zA-Z-]+$/',
                'descripcionCortaEs' => 'required',
                'urlEs' => 'required',

                'nombreEn' => 'required|regex:/^[a-zA-Z-]+$/',
                'descripcionCortaEn' => 'required',
                'urlEn' => 'required',
            ]);

        $respuesta = ['status' => true];
        if ($validatedData->fails()) {
            $mensajes = $validatedData->errors()->all();
            $respuesta['status'] = false;
            $respuesta ['msg'] = $mensajes;


        } else {

            $prod = Productos::guardarProducto($datos);

            ProductoTraducciones::guardarIngles($datos, $prod, false);
            ProductoTraducciones::guardarEspaniol($datos, $prod, false);

            $respuesta['msg'] = ['Se guardó correctamente'];
        }
        echo json_encode($respuesta);
        exit;

    }

    public function detalleProducto(): View
    {

        $productos = DB::table('m_productos')
            ->join( 'r_producto_traducciones as trad', 'trad.id_producto', '=', 'm_productos.id')
            ->where('m_productos.registro_activo', 1)
            ->where( 'trad.idioma', App::getLocale())
            ->orderBy('m_productos.id')
            ->get();
        return view('productos.ListaProductosDetalle', ['productos' => $productos]);
    }

    public function inactivar(Request $request){
        $empleado = Productos::where('id', $request->id)->first();
        $empleado->registro_activo = false;
        $empleado->save();

        return $this->index();
    }

    public function eliminar(Request $request){
       ProductoTraducciones::eliminarRegistros($request->id);
       Productos::eliminarProducto($request->id);
    }


}
