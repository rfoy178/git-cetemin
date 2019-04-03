<?php

namespace App\Http\Controllers\Comedor;

use App\Entidad\MarcasComedor;
use App\Entidad\Personal;
use Caffeinated\Shinobi\Facades\Shinobi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ComedorController extends Controller
{
    public function show($id,Request $request)
    {


        ini_set('max_execution_time', 0); // for infinite time of execution

        $iniciox=$request->inicio;
        $finx=$request->fin;

        $inicio=$request->inicio;
        $fin=$request->fin;


        $iniA = explode("-", $request->inicio);
        $finicio=$iniA[2]."-".$iniA[1]."-".$iniA[0];

        $finA = explode("-", $request->fin);
        $ffin=$finA[2]."-".$finA[1]."-".$finA[0];

        $finicio2=str_replace("-","_",$finicio);
        $ffin2=str_replace("-","_",$ffin);





        $finicio=Carbon::parse($finicio." 00:00:01");
        $ffin=Carbon::parse($ffin." 23:59:59");
        $client = new \GuzzleHttp\Client();
        $url = "http://siga2.cetemin.com/api/programacion/".$finicio2."/".$ffin2;
        $request = $client->get($url);
        $js = json_decode($request->getBody(), true);


        $client = new \GuzzleHttp\Client();
        $url = "http://siga2.cetemin.com/api/programacion_i/".$finicio2."/".$ffin2;
        $request = $client->get($url);
        $instructores = json_decode($request->getBody(), true);



        $pila = array();


        foreach ($instructores as $item){

            array_push($pila,str_pad($item["C_DNIDOC"], 8, "0", STR_PAD_LEFT));
        }


        $marcas=MarcasComedor::whereBetween('sTime', [$finicio, $ffin])->get();

        $i=0;
        foreach ($marcas as $item) {
            $fechai = explode("-", substr($item["sTime"], 0, 10));
            $hora=explode(":",substr($item["sTime"], 11, 8));
            $first = Carbon::create($fechai[0], $fechai[1], $fechai[2], 5,0,0);
            $second = Carbon::create($fechai[0], $fechai[1], $fechai[2], 11,59,59);
            $firstA = Carbon::create($fechai[0], $fechai[1], $fechai[2], 12,0,0);
            $secondA = Carbon::create($fechai[0], $fechai[1], $fechai[2], 16,00,0);
            $firstC = Carbon::create($fechai[0], $fechai[1], $fechai[2], 16,1,0);
            $secondC = Carbon::create($fechai[0], $fechai[1], $fechai[2], 23,30,0);
            if(Carbon::create($fechai[0], $fechai[1], $fechai[2],$hora[0], $hora[1], $hora[2])->between($first, $second)){
                $asistencia["A".str_pad($item["dni"], 8, "0", STR_PAD_LEFT)]["D". substr($item["sTime"], 0, 10)]["D"] = substr($item["sTime"], 11, 8);
            }



            if(Carbon::create($fechai[0], $fechai[1], $fechai[2],$hora[0], $hora[1], $hora[2])->between($firstA, $secondA)){
                $asistencia["A".str_pad($item["dni"], 8, "0", STR_PAD_LEFT)]["D". substr($item["sTime"], 0, 10)]["A"] = substr($item["sTime"], 11, 8);
                if(isset($asistencia["A".str_pad($item["dni"], 8, "0", STR_PAD_LEFT)]["D". substr($item["sTime"], 0, 10)]["AC"])){
                    $asistencia["A".str_pad($item["dni"], 8, "0", STR_PAD_LEFT)]["D". substr($item["sTime"], 0, 10)]["AC"]=$asistencia["A".str_pad($item["dni"], 8, "0", STR_PAD_LEFT)]["D". substr($item["sTime"], 0, 10)]["AC"]+1;

                }else{
                    $asistencia["A".str_pad($item["dni"], 8, "0", STR_PAD_LEFT)]["D". substr($item["sTime"], 0, 10)]["AC"]=1;
                }
            }


            if(Carbon::create($fechai[0], $fechai[1], $fechai[2],$hora[0], $hora[1], $hora[2])->between($firstC, $secondC)){
                $asistencia["A".str_pad($item["dni"], 8, "0", STR_PAD_LEFT)]["D". substr($item["sTime"], 0, 10)]["C"] = substr($item["sTime"], 11, 8);
            }
            $i++;
        }

        $inicio=$iniciox;
        $fin=$finx;


        $gaf=Personal::where("gerencia",20)->orderBy("nombre")->get();
        $ga=Personal::where("gerencia",10)->whereNotIn("dni",$pila)->orderBy("nombre")->get();
        $gc=Personal::where("gerencia",30)->orderBy("nombre")->get();

        $view = view("comedor.detalle", compact('instructores','js','asistencia','inicio','fin','gaf','ga','gc')) ;

        return $view;

    }


    function index (Request $request){

       // $view = view("comedor.index" ) ;

        //return $view;


        if (Shinobi::canAtLeast(['comedor'])) {
            $view = view("comedor.index" ) ;

            return $view;
        }else{



            $x="<div class=\"note note-danger\">
                                <h4 class=\"block\">Alerta! </h4>
                                <p>  Ud. no tiene permiso para ver esto  </p>
                            </div>";

            echo $x;
        }




    }

}
