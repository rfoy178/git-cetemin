<?php

namespace App\Http\Controllers;

use App\Entidad\Empleado;
use App\Entidad\Rq;
use Caffeinated\Shinobi\Facades\Shinobi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TareoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        if (Shinobi::canAtLeast(['tareo'])) {

            return view ('tareo.index' );
        }else{



            $x="<div class=\"note note-danger\">
                                <h4 class=\"block\">Alerta! </h4>
                                <p>  Ud. no tiene permiso para ver esto  </p>
                            </div>";

            echo $x;
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {

        ini_set('max_execution_time', 300); //300 seconds = 5 minutes

        $inicio=$request->inicio;
        $fin=$request->fin;


        $iniA = explode("-", $request->inicio);
        $ini_=$iniA[1]."_".$iniA[0]."_".$iniA[2];

        $finA = explode("-", $request->fin);
        $fin_=$finA[1]."_".$finA[0]."_".$finA[2];


        $asistencia[][][] = " ";
        $client = new \GuzzleHttp\Client();
        $url = "http://".env('APP_IP').":".env('APP_PORT')."/api/Tareo/".$ini_."/".$fin_."/a/" ;

        $request = $client->get($url);
        $js = json_decode($request->getBody(), true);
        $i = 0;
        $alumnos = array();
        $nombre = array();

        foreach ($js as $item) {
            $alumnos[$i]["dni"] = $item["Dni"];


            $empleado = Empleado::where('dni', $item["Dni"])->first(); // model or null
            if (!$empleado) {


                $client = new \GuzzleHttp\Client();
                $url = "http://".env('APP_IP').":".env('APP_PORT')."/api/RedCaja/". str_pad($item["Dni"], 8, "0", STR_PAD_LEFT) ."/dni";
                $request = $client->get($url);
                $js = json_decode($request->getBody(), true);

                $doc = array();
                foreach ($js as $itemx) {
                    $doc["Code"] = $itemx["Code"];
                    $doc["Datos"] = $itemx["Mensaje"];
                }
                $porciones = explode("|", $doc["Datos"]);





                $x= new Empleado();
                $x->dni=str_pad($item["Dni"], 8, "0", STR_PAD_LEFT);
                $x->nombre=$porciones[0] . " ".$porciones[1] ." " .$porciones[2];
             $x->save();

                $alumnos[$i]["nombre"] = $x->nombre;



             }else{
                $alumnos[$i]["nombre"] = $empleado->nombre;

            }




            $doc["Tipo"]=1;


            $i++;
        }


        $request = new \GuzzleHttp\Client();
        $url = "http://".env('APP_IP').":".env('APP_PORT')." /api/Tareo/".$ini_."/".$fin_."/" ;

        $request = $client->get($url);
        $js = json_decode($request->getBody(), true);
        $i = 0;
        $asistencia = array();
        foreach ($js as $item) {
            $fechai = explode("-", substr($item["Dia"], 0, 10));
            $hora=explode(":",substr($item["Dia"], 11, 8));
            $first = Carbon::create($fechai[0], $fechai[1], $fechai[2], 5,0,0);
            $second = Carbon::create($fechai[0], $fechai[1], $fechai[2], 11,0,0);
            $tolerancia = Carbon::create($fechai[0], $fechai[1], $fechai[2], 7,50,0);
            $entrada = Carbon::create($fechai[0], $fechai[1], $fechai[2], 7,45,0);
            $salida = Carbon::create($fechai[0], $fechai[1], $fechai[2], 18,0,0);

            if(Carbon::create($fechai[0], $fechai[1], $fechai[2],$hora[0], $hora[1], $hora[2])->between($first, $second)){
                $asistencia["A".$item["Dni"]]["D". substr($item["Dia"], 0, 10)]["M"] = substr($item["Dia"], 11, 8);
                $E=Carbon::create($fechai[0], $fechai[1], $fechai[2],$hora[0], $hora[1], $hora[2]);
                if($E->greaterThan($tolerancia)){
                    $asistencia["A".$item["Dni"]]["D". substr($item["Dia"], 0, 10)]["MT"]="background-color: #ff8e89";
                    $diferencia=$entrada->diffInMinutes($E);
                    if (isset($asistencia["A".$item["Dni"]]["D"])) {
                        $asistencia["A" . $item["Dni"]]["D"] = $asistencia["A" . $item["Dni"]]["D"] + $diferencia;
                    }else{
                        $asistencia["A" . $item["Dni"]]["D"] = 0;
                    }

                }else{
                    $asistencia["A".$item["Dni"]]["D". substr($item["Dia"], 0, 10)]["MT"]="";
                }

            }else{
                $asistencia["A".$item["Dni"]]["D". substr($item["Dia"], 0, 10)]["T"] = substr($item["Dia"], 11, 8);

            }
            $i++;
        }

        $emple=Empleado::orderBy("nombre")->get();

          $view = view("tareo.tabla", compact('alumnos', 'inicio','fin', 'asistencia','nombre','emple')) ;

        return $view;

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
