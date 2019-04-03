<?php

namespace App\Http\Controllers;

use App\Entidad\SapAlumno;
use Illuminate\Http\Request;
use Tecactus\Reniec\DNI;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function alumnos(){

         $alumnos=SapAlumno::where("estado",0)->get();

        foreach ($alumnos as $item){


              $reniecDni = new  DNI('xvLKRAB1dch7uMntzkz442CWbDw4XwP8vBN3smeS');

                $datos=$reniecDni->get($item->dni, true);

if($datos) {
    $item->nombre1 = $datos["nombres"];
    $item->ape_pat = $datos["apellido_paterno"];
    $item->ape_mat = $datos["apellido_materno"];
    $item->estado = 1;
    $item->save();
}else{

    $item->estado = 2;
    $item->save();
}

         }





    }
}
