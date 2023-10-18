<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class SistemaGeneralController extends Controller
{
    //
    public function cambiarIdioma(Request $request){

//dd($request);
        App::setLocale($request->all()['idioma']);

        session()->put('locale', $request->all()['idioma']);
        return redirect()->back();
    }

    public static function conversion()
    {
        try{
            $client = new Client(['verify' => false,]);
            $response = $client->request(
                'GET',
                'https://www.banxico.org.mx/SieAPIRest/service/v1/series/SF43718/datos/oportuno?token=f9b5714534c83796c8be94e10fff072397cdf2825fbd0ddc4628f9b630970885',
                ['header' => ['bmx-token' => 'f9b5714534c83796c8be94e10fff072397cdf2825fbd0ddc4628f9b630970885']]);

            $respuesta = json_decode($response->getBody()->getContents());

            $valor = $respuesta->bmx->series[0]->datos[0]->dato;

            return $valor;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('status','Ocurrió un error, revise los datos');
        }
    }

}
