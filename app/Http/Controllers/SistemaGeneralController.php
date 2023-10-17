<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SistemaGeneralController extends Controller
{
    //
    public function cambiarIdioma(Request $request){

//dd($request);
        App::setLocale($request->all()['idioma']);

        session()->put('locale', $request->all()['idioma']);
        return redirect()->back();
    }

}
