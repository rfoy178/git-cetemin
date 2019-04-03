<?php
/**
 * Created by PhpStorm.
 * User: jdani
 * Date: 09/04/2018
 * Time: 03:07 PM
 */

namespace App\Http\Controllers {


    use App\Entidad\Gyp;
    use App\Entidad\Presupuesto;
    use App\Entidad\Rq;
    use App\Entidad\RqDetalle;
    use Caffeinated\Shinobi\Facades\Shinobi;
    use http\Env\Response;
    use Illuminate\Support\Facades\Input;

    class PreController
    {

        public function ingresos( $pLinea,$pEspecialidad,$pMes,$pTipo)
        {


            $client = new \GuzzleHttp\Client();
            $url = "http://".env('APP_IP').":".env('APP_PORT')."/api/Presupuesto/".$pLinea."/".$pEspecialidad."/".$pMes."/".$pTipo."/2";


            $request = $client->get($url);
            $js=json_decode($request->getBody(),true);

            $i=0;
            $presupuesto = array();

            $ingresos = array();
            $ingresos["AQP_EXC_REAL"] =0;
            $ingresos["AQP_EXC_MONTO"] =0;
            $ingresos["CIT_EXC_REAL"] =0;
            $ingresos["CIT_EXC_MONTO"] =0;
            $ingresos["LIM_EXC_REAL"] =0;
            $ingresos["LIM_EXC_MONTO"] =0;
            $ingresos["EXC_REAL_F"] =0;
            $ingresos["EXC_REAL"] =0;
            $ingresos["U_EXC_MONTO"] =0;
            $ingresos["EXC_DESVIACION"]=0;
            foreach ($js as $item){
                $presupuesto[$i]["EXC_CUECON_F"]=$item["EXC_CUECON_F"];
                $presupuesto[$i]["AcctName"]=$item["AcctName"];
                $presupuesto[$i]["AQP_EXC_REAL"]=$item["AQP_EXC_REAL"];
                $presupuesto[$i]["AQP_EXC_MONTO"]=$item["AQP_EXC_MONTO"];
                $presupuesto[$i]["CIT_EXC_REAL"]=$item["CIT_EXC_REAL"];
                $presupuesto[$i]["CIT_EXC_MONTO"]=$item["CIT_EXC_MONTO"];
                $presupuesto[$i]["LIM_EXC_REAL"]=$item["LIM_EXC_REAL"];
                $presupuesto[$i]["LIM_EXC_MONTO"]=$item["LIM_EXC_MONTO"];
                $presupuesto[$i]["EXC_REAL_F"]=$item["EXC_REAL_F"];
                $presupuesto[$i]["EXC_REAL"]=$item["EXC_REAL"];
                $presupuesto[$i]["U_EXC_MONTO"]=$item["U_EXC_MONTO"];
                $presupuesto[$i]["EXC_DESVIACION"]=$item["EXC_DESVIACION"];


                $ingresos["AQP_EXC_REAL"] =$ingresos["AQP_EXC_REAL"] + $item["AQP_EXC_REAL"];
                $ingresos["AQP_EXC_MONTO"] =$ingresos["AQP_EXC_MONTO"] + $item["AQP_EXC_MONTO"];
                $ingresos["CIT_EXC_REAL"] =$ingresos["CIT_EXC_REAL"] + $item["CIT_EXC_REAL"];
                $ingresos["CIT_EXC_MONTO"] =$ingresos["CIT_EXC_MONTO"] + $item["CIT_EXC_MONTO"];
                $ingresos["LIM_EXC_REAL"] =$ingresos["LIM_EXC_REAL"] + $item["LIM_EXC_REAL"];
                $ingresos["LIM_EXC_MONTO"] =$ingresos["LIM_EXC_MONTO"] + $item["LIM_EXC_MONTO"];
                $ingresos["EXC_REAL_F"] =$ingresos["EXC_REAL_F"] + $item["EXC_REAL_F"];
                $ingresos["EXC_REAL"] =$ingresos["EXC_REAL"] + $item["EXC_REAL"];
                $ingresos["U_EXC_MONTO"] =$ingresos["U_EXC_MONTO"] + $item["U_EXC_MONTO"];
                $ingresos["EXC_DESVIACION"] =$ingresos["EXC_DESVIACION"] + $item["EXC_DESVIACION"];




                $i++;
            }


            $return = array();

            $return["presupuesto"]=$presupuesto;
            $return["ingresos"]=$ingresos;

            return $return;
        }

        public function gastos( $pLinea,$pEspecialidad,$pMes,$pTipo)
        {


            $client = new \GuzzleHttp\Client();
            $url = "http://".env('APP_IP').":".env('APP_PORT')."/api/Presupuesto/".$pLinea."/".$pEspecialidad."/".$pMes."/".$pTipo."/0";

            $request = $client->get($url);
            $js=json_decode($request->getBody(),true);

            $i=0;
            $presupuesto = array();

            $sueldo = array();
            $sueldo["AQP_EXC_REAL"] =0;
            $sueldo["AQP_EXC_MONTO"] =0;
            $sueldo["CIT_EXC_REAL"] =0;
            $sueldo["CIT_EXC_MONTO"] =0;
            $sueldo["LIM_EXC_REAL"] =0;
            $sueldo["LIM_EXC_MONTO"] =0;
            $sueldo["EXC_REAL_F"] =0;
            $sueldo["EXC_REAL"] =0;
            $sueldo["U_EXC_MONTO"] =0;
            $sueldo["EXC_DESVIACION"]=0;
            foreach ($js as $item){
                $presupuesto[$i]["EXC_CUECON_F"]=$item["EXC_CUECON_F"];
                $presupuesto[$i]["AcctName"]=$item["AcctName"];
                $presupuesto[$i]["AQP_EXC_REAL"]=$item["AQP_EXC_REAL"];
                $presupuesto[$i]["AQP_EXC_MONTO"]=$item["AQP_EXC_MONTO"];
                $presupuesto[$i]["CIT_EXC_REAL"]=$item["CIT_EXC_REAL"];
                $presupuesto[$i]["CIT_EXC_MONTO"]=$item["CIT_EXC_MONTO"];
                $presupuesto[$i]["LIM_EXC_REAL"]=$item["LIM_EXC_REAL"];
                $presupuesto[$i]["LIM_EXC_MONTO"]=$item["LIM_EXC_MONTO"];
                $presupuesto[$i]["EXC_REAL_F"]=$item["EXC_REAL_F"];
                $presupuesto[$i]["EXC_REAL"]=$item["EXC_REAL"];
                $presupuesto[$i]["U_EXC_MONTO"]=$item["U_EXC_MONTO"];
                $presupuesto[$i]["EXC_DESVIACION"]=$item["EXC_DESVIACION"];


                $sueldo["AQP_EXC_REAL"] =$sueldo["AQP_EXC_REAL"] + $item["AQP_EXC_REAL"];
                $sueldo["AQP_EXC_MONTO"] =$sueldo["AQP_EXC_MONTO"] + $item["AQP_EXC_MONTO"];
                $sueldo["CIT_EXC_REAL"] =$sueldo["CIT_EXC_REAL"] + $item["CIT_EXC_REAL"];
                $sueldo["CIT_EXC_MONTO"] =$sueldo["CIT_EXC_MONTO"] + $item["CIT_EXC_MONTO"];
                $sueldo["LIM_EXC_REAL"] =$sueldo["LIM_EXC_REAL"] + $item["LIM_EXC_REAL"];
                $sueldo["LIM_EXC_MONTO"] =$sueldo["LIM_EXC_MONTO"] + $item["LIM_EXC_MONTO"];
                $sueldo["EXC_REAL_F"] =$sueldo["EXC_REAL_F"] + $item["EXC_REAL_F"];
                $sueldo["EXC_REAL"] =$sueldo["EXC_REAL"] + $item["EXC_REAL"];
                $sueldo["U_EXC_MONTO"] =$sueldo["U_EXC_MONTO"] + $item["U_EXC_MONTO"];
                $sueldo["EXC_DESVIACION"] =$sueldo["EXC_DESVIACION"] + $item["EXC_DESVIACION"];




                $i++;
            }



            $client = new \GuzzleHttp\Client();
            $url = "http://".env('APP_IP').":".env('APP_PORT')."/api/Presupuesto/".$pLinea."/".$pEspecialidad."/".$pMes."/".$pTipo."/1";
            $request = $client->get($url);
            $js=json_decode($request->getBody(),true);

            $i=0;
            $presupuesto2 = array();
            $gastos = array();
            $gastos["AQP_EXC_REAL"] =0;
            $gastos["AQP_EXC_MONTO"] =0;
            $gastos["CIT_EXC_REAL"] =0;
            $gastos["CIT_EXC_MONTO"] =0;
            $gastos["LIM_EXC_REAL"] =0;
            $gastos["LIM_EXC_MONTO"] =0;
            $gastos["EXC_REAL_F"] =0;
            $gastos["EXC_REAL"] =0;
            $gastos["U_EXC_MONTO"] =0;
            $gastos["EXC_DESVIACION"]=0;
            foreach ($js as $item){
                $presupuesto2[$i]["EXC_CUECON_F"]=$item["EXC_CUECON_F"];
                $presupuesto2[$i]["AcctName"]=$item["AcctName"];
                $presupuesto2[$i]["AQP_EXC_REAL"]=$item["AQP_EXC_REAL"];
                $presupuesto2[$i]["AQP_EXC_MONTO"]=$item["AQP_EXC_MONTO"];
                $presupuesto2[$i]["CIT_EXC_REAL"]=$item["CIT_EXC_REAL"];
                $presupuesto2[$i]["CIT_EXC_MONTO"]=$item["CIT_EXC_MONTO"];
                $presupuesto2[$i]["LIM_EXC_REAL"]=$item["LIM_EXC_REAL"];
                $presupuesto2[$i]["LIM_EXC_MONTO"]=$item["LIM_EXC_MONTO"];
                $presupuesto2[$i]["EXC_REAL_F"]=$item["EXC_REAL_F"];
                $presupuesto2[$i]["EXC_REAL"]=$item["EXC_REAL"];
                $presupuesto2[$i]["U_EXC_MONTO"]=$item["U_EXC_MONTO"];
                $presupuesto2[$i]["EXC_DESVIACION"]=$item["EXC_DESVIACION"];
                $i++;

                $gastos["AQP_EXC_REAL"] =$gastos["AQP_EXC_REAL"] + $item["AQP_EXC_REAL"];
                $gastos["AQP_EXC_MONTO"] =$gastos["AQP_EXC_MONTO"] + $item["AQP_EXC_MONTO"];
                $gastos["CIT_EXC_REAL"] =$gastos["CIT_EXC_REAL"] + $item["CIT_EXC_REAL"];
                $gastos["CIT_EXC_MONTO"] =$gastos["CIT_EXC_MONTO"] + $item["CIT_EXC_MONTO"];
                $gastos["LIM_EXC_REAL"] =$gastos["LIM_EXC_REAL"] + $item["LIM_EXC_REAL"];
                $gastos["LIM_EXC_MONTO"] =$gastos["LIM_EXC_MONTO"] + $item["LIM_EXC_MONTO"];
                $gastos["EXC_REAL_F"] =$gastos["EXC_REAL_F"] + $item["EXC_REAL_F"];
                $gastos["EXC_REAL"] =$gastos["EXC_REAL"] + $item["EXC_REAL"];
                $gastos["U_EXC_MONTO"] =$gastos["U_EXC_MONTO"] + $item["U_EXC_MONTO"];
                $gastos["EXC_DESVIACION"] =$gastos["EXC_DESVIACION"] + $item["EXC_DESVIACION"];


            }



            $client = new \GuzzleHttp\Client();
            $url = "http://".env('APP_IP').":".env('APP_PORT')."/api/Presupuesto/".$pLinea."/".$pEspecialidad."/".$pMes;
            $request = $client->get($url);
            $js=json_decode($request->getBody(),true);
            $i=0;
            $char1 = array();
            foreach ($js as $item){
                $char1[$i]["mes"]=$item["AcctName"];
                $char1[$i]["AQP_EXC_REAL"]=$item["AQP_EXC_REAL"]*-1;
                $char1[$i]["AQP_EXC_MONTO"]=$item["AQP_EXC_MONTO"]*-1;
                $char1[$i]["CIT_EXC_REAL"]=$item["CIT_EXC_REAL"]*-1;
                $char1[$i]["CIT_EXC_MONTO"]=$item["CIT_EXC_MONTO"]*-1;
                $char1[$i]["LIM_EXC_REAL"]=$item["LIM_EXC_REAL"]*-1;
                $char1[$i]["LIM_EXC_MONTO"]=$item["LIM_EXC_MONTO"]*-1;
                $char1[$i]["EXC_REAL_F"]=$item["EXC_REAL_F"]*-1;
                $char1[$i]["EXC_REAL"]=$item["EXC_REAL"]*-1;
                $char1[$i]["U_EXC_MONTO"]=$item["U_EXC_MONTO"]*-1;
                $char1[$i]["EXC_DESVIACION"]=$item["EXC_DESVIACION"]*-1;

                $i++;
            }

            $client = new \GuzzleHttp\Client();
            $url = "http://".env('APP_IP').":".env('APP_PORT')."/api/Presupuesto/".$pLinea."/".$pEspecialidad."/".$pMes."/x";
            $request = $client->get($url);
            $js=json_decode($request->getBody(),true);
            $i=0;
            $char1p = array();
            foreach ($js as $itemp){
                $char1[$i]["p"]["mes"]=$itemp["AcctName"];
                $char1[$i]["p"]["AQP_EXC_REAL"]=$itemp["AQP_EXC_REAL"];
                $char1[$i]["p"]["AQP_EXC_MONTO"]=$itemp["AQP_EXC_MONTO"];
                $char1[$i]["p"]["CIT_EXC_REAL"]=$itemp["CIT_EXC_REAL"];
                $char1[$i]["p"]["CIT_EXC_MONTO"]=$itemp["CIT_EXC_MONTO"];
                $char1[$i]["p"]["LIM_EXC_REAL"]=$itemp["LIM_EXC_REAL"];
                $char1[$i]["p"]["LIM_EXC_MONTO"]=$itemp["LIM_EXC_MONTO"];
                $char1[$i]["p"]["EXC_REAL_F"]=$itemp["EXC_REAL_F"];
                $char1[$i]["p"]["EXC_REAL"]=$itemp["EXC_REAL"];
                $char1[$i]["p"]["U_EXC_MONTO"]=$itemp["U_EXC_MONTO"];
                $char1[$i]["p"]["EXC_DESVIACION"]=$itemp["EXC_DESVIACION"];

                $i++;
            }

            $client = new \GuzzleHttp\Client();

            $url = "http://".env('APP_IP').":".env('APP_PORT')."/api/Presupuesto/".$pLinea."/".$pEspecialidad."/".$pMes;
            $request = $client->get($url);
            $js=json_decode($request->getBody(),true);

            $i=0;
            $char2 = array();

            foreach ($js as $item){
                if($i==0) {
                    $char2[$i]["mes"] = $item["AcctName"];
                    $char2[$i]["AQP_EXC_REAL"] = $item["AQP_EXC_REAL"] * -1;
                    $char2[$i]["AQP_EXC_MONTO"] = $item["AQP_EXC_MONTO"] * -1;
                    $char2[$i]["CIT_EXC_REAL"] = $item["CIT_EXC_REAL"] * -1;
                    $char2[$i]["CIT_EXC_MONTO"] = $item["CIT_EXC_MONTO"] * -1;
                    $char2[$i]["LIM_EXC_REAL"] = $item["LIM_EXC_REAL"] * -1;
                    $char2[$i]["LIM_EXC_MONTO"] = $item["LIM_EXC_MONTO"] * -1;
                    $char2[$i]["EXC_REAL_F"] = $item["EXC_REAL_F"] * -1;
                    $char2[$i]["EXC_REAL"] = $item["EXC_REAL"] * -1;
                    $char2[$i]["U_EXC_MONTO"] = $item["U_EXC_MONTO"] * -1;
                    $char2[$i]["EXC_DESVIACION"] = $item["EXC_DESVIACION"] * -1;
                }else{
                    $char2[$i]["mes"] = $item["AcctName"];
                    $char2[$i]["AQP_EXC_REAL"] = $char2[$i-1]["AQP_EXC_REAL"]+( $item["AQP_EXC_REAL"] * -1);
                    $char2[$i]["AQP_EXC_MONTO"] =$char2[$i-1]["AQP_EXC_MONTO"]+(  $item["AQP_EXC_MONTO"] * -1);
                    $char2[$i]["CIT_EXC_REAL"] =$char2[$i-1]["CIT_EXC_REAL"]+(  $item["CIT_EXC_REAL"] * -1);
                    $char2[$i]["CIT_EXC_MONTO"] =$char2[$i-1]["CIT_EXC_MONTO"]+(  $item["CIT_EXC_MONTO"] * -1);
                    $char2[$i]["LIM_EXC_REAL"] =$char2[$i-1]["LIM_EXC_REAL"]+(  $item["LIM_EXC_REAL"] * -1);
                    $char2[$i]["LIM_EXC_MONTO"] =$char2[$i-1]["LIM_EXC_MONTO"]+(  $item["LIM_EXC_MONTO"] * -1);
                    $char2[$i]["EXC_REAL_F"] =$char2[$i-1]["EXC_REAL_F"]+(  $item["EXC_REAL_F"] * -1);
                    $char2[$i]["EXC_REAL"] =$char2[$i-1]["EXC_REAL"]+(  $item["EXC_REAL"] * -1);
                    $char2[$i]["U_EXC_MONTO"] =$char2[$i-1]["U_EXC_MONTO"]+(  $item["U_EXC_MONTO"] * -1);
                    $char2[$i]["EXC_DESVIACION"] =$char2[$i-1]["EXC_DESVIACION"]+(  $item["EXC_DESVIACION"] * -1);

                }
                $i++;
            }
            $return = array();
            $return["char1"]=$char1;
            $return["char1p"]=$char1p;
            $return["char2"]=$char2;
            $return["presupuesto"]=$presupuesto;
            $return["presupuesto2"]=$presupuesto2;
            $return["sueldo"]=$sueldo;
            $return["gastos"]=$gastos;

            return $return;
        }


        public function carga($id){
            $client = new \GuzzleHttp\Client();
            $url = "http://".env('APP_IP').":".env('APP_PORT')."/api/Presupuesto/".$id;
            $request = $client->get($url);
            $js=json_decode($request->getBody(),true);
            $i=0;
            $doc = array();
            foreach ($js as $item){
                $doc[$i]["Cotizacion"]=$item["Rq"];
                $doc[$i]["TargetType"]=$item["TargetType"];
                $doc[$i]["TrgetEntry"]=$item["TrgetEntry"];
                $doc[$i]["CardCode"]=$item["CardCode"];
                $doc[$i]["CardName"]=$item["CardName"];
                $doc[$i]["DocDate"]=$item["DocDate"];
                $i++;
            }
            return $doc;
        }

        public function prueba(){



             return view ('logistica.prueba',compact("cot"));

        }
        public function gyp()
        {
            $n1=Gyp::where("seccion",1)->orderBy("id")->get();
            $n2=Gyp::where("seccion",2)->orderBy("id")->get();

            return view ('logistica.detalle_presupuesto3',compact("n1","n2"));
        }

        public function gyp_detalle()
        {
            $r=Input::get("linea");
            $i=Input::get("tipo");
            $s=Input::get("seccion");

            $return = array();
            $n1=Gyp::where("seccion",$s)->where("linea",$r)->get();

            foreach ($n1 as $item){
               if($i=="I"){
                   $return["1"][$item->linea][$item->especialidad]["ingresos"]=$this->ingresos($item->linea,$item->especialidad,"201805","0");


               }else{
                   $return["1"][$item->linea][$item->especialidad]["gastos"]=$this->gastos($item->linea,$item->especialidad,"201805","0");;
               }


            }
            return view ('logistica.detalle_presupuesto4',compact("return","n1","i"));
        }

        public function gyp_1( )
        {
            $return = array();
            $n1=Gyp::where("seccion",1)->get();
            foreach ($n1 as $item){
                $return["1"][$item->linea][$item->especialidad]["ingresos"]=$this->ingresos($item->linea,$item->especialidad,"201805","0");
                $return["1"][$item->linea][$item->especialidad]["gastos"]=$this->gastos($item->linea,$item->especialidad,"201805","0");;
            }
            return view ('logistica.detalle_presupuesto2',compact("return","n1"));
        }

        public function margen2( )
        {
            $request= Input::all();
            $datos=Presupuesto::where("id",$request["presupuesto"])->first();
            $client = new \GuzzleHttp\Client();
            $url = "http://".env('APP_IP').":".env('APP_PORT')."/api/Presupuesto/".$datos->linea."/".$datos->especialidad."/".$request["mes"]."/".$request["tipo"]."/0";

            $request = $client->get($url);
            $js=json_decode($request->getBody(),true);

            $i=0;
            $presupuesto = array();

            $sueldo = array();
            $sueldo["AQP_EXC_REAL"] =0;
            $sueldo["AQP_EXC_MONTO"] =0;
            $sueldo["CIT_EXC_REAL"] =0;
            $sueldo["CIT_EXC_MONTO"] =0;
            $sueldo["LIM_EXC_REAL"] =0;
            $sueldo["LIM_EXC_MONTO"] =0;
            $sueldo["EXC_REAL_F"] =0;
            $sueldo["EXC_REAL"] =0;
            $sueldo["U_EXC_MONTO"] =0;
            $sueldo["EXC_DESVIACION"]=0;
            foreach ($js as $item){
                $presupuesto[$i]["EXC_CUECON_F"]=$item["EXC_CUECON_F"];
                $presupuesto[$i]["AcctName"]=$item["AcctName"];
                $presupuesto[$i]["AQP_EXC_REAL"]=$item["AQP_EXC_REAL"];
                $presupuesto[$i]["AQP_EXC_MONTO"]=$item["AQP_EXC_MONTO"];
                $presupuesto[$i]["CIT_EXC_REAL"]=$item["CIT_EXC_REAL"];
                $presupuesto[$i]["CIT_EXC_MONTO"]=$item["CIT_EXC_MONTO"];
                $presupuesto[$i]["LIM_EXC_REAL"]=$item["LIM_EXC_REAL"];
                $presupuesto[$i]["LIM_EXC_MONTO"]=$item["LIM_EXC_MONTO"];
                $presupuesto[$i]["EXC_REAL_F"]=$item["EXC_REAL_F"];
                $presupuesto[$i]["EXC_REAL"]=$item["EXC_REAL"];
                $presupuesto[$i]["U_EXC_MONTO"]=$item["U_EXC_MONTO"];
                $presupuesto[$i]["EXC_DESVIACION"]=$item["EXC_DESVIACION"];


                $sueldo["AQP_EXC_REAL"] =$sueldo["AQP_EXC_REAL"] + $item["AQP_EXC_REAL"];
                $sueldo["AQP_EXC_MONTO"] =$sueldo["AQP_EXC_MONTO"] + $item["AQP_EXC_MONTO"];
                $sueldo["CIT_EXC_REAL"] =$sueldo["CIT_EXC_REAL"] + $item["CIT_EXC_REAL"];
                $sueldo["CIT_EXC_MONTO"] =$sueldo["CIT_EXC_MONTO"] + $item["CIT_EXC_MONTO"];
                $sueldo["LIM_EXC_REAL"] =$sueldo["LIM_EXC_REAL"] + $item["LIM_EXC_REAL"];
                $sueldo["LIM_EXC_MONTO"] =$sueldo["LIM_EXC_MONTO"] + $item["LIM_EXC_MONTO"];
                $sueldo["EXC_REAL_F"] =$sueldo["EXC_REAL_F"] + $item["EXC_REAL_F"];
                $sueldo["EXC_REAL"] =$sueldo["EXC_REAL"] + $item["EXC_REAL"];
                $sueldo["U_EXC_MONTO"] =$sueldo["U_EXC_MONTO"] + $item["U_EXC_MONTO"];
                $sueldo["EXC_DESVIACION"] =$sueldo["EXC_DESVIACION"] + $item["EXC_DESVIACION"];




                $i++;
            }

             $request= Input::all();
            $datos=Presupuesto::where("id",$request["presupuesto"])->first();

            $client = new \GuzzleHttp\Client();
            $url = "http://".env('APP_IP').":".env('APP_PORT')."/api/Presupuesto/".$datos->linea."/".$datos->especialidad."/".$request["mes"]."/".$request["tipo"]."/1";
            $request = $client->get($url);
            $js=json_decode($request->getBody(),true);

            $i=0;
            $presupuesto2 = array();
            $gastos = array();
            $gastos["AQP_EXC_REAL"] =0;
            $gastos["AQP_EXC_MONTO"] =0;
            $gastos["CIT_EXC_REAL"] =0;
            $gastos["CIT_EXC_MONTO"] =0;
            $gastos["LIM_EXC_REAL"] =0;
            $gastos["LIM_EXC_MONTO"] =0;
            $gastos["EXC_REAL_F"] =0;
            $gastos["EXC_REAL"] =0;
            $gastos["U_EXC_MONTO"] =0;
            $gastos["EXC_DESVIACION"]=0;
            foreach ($js as $item){
                $presupuesto2[$i]["EXC_CUECON_F"]=$item["EXC_CUECON_F"];
                $presupuesto2[$i]["AcctName"]=$item["AcctName"];
                $presupuesto2[$i]["AQP_EXC_REAL"]=$item["AQP_EXC_REAL"];
                $presupuesto2[$i]["AQP_EXC_MONTO"]=$item["AQP_EXC_MONTO"];
                $presupuesto2[$i]["CIT_EXC_REAL"]=$item["CIT_EXC_REAL"];
                $presupuesto2[$i]["CIT_EXC_MONTO"]=$item["CIT_EXC_MONTO"];
                $presupuesto2[$i]["LIM_EXC_REAL"]=$item["LIM_EXC_REAL"];
                $presupuesto2[$i]["LIM_EXC_MONTO"]=$item["LIM_EXC_MONTO"];
                $presupuesto2[$i]["EXC_REAL_F"]=$item["EXC_REAL_F"];
                $presupuesto2[$i]["EXC_REAL"]=$item["EXC_REAL"];
                $presupuesto2[$i]["U_EXC_MONTO"]=$item["U_EXC_MONTO"];
                $presupuesto2[$i]["EXC_DESVIACION"]=$item["EXC_DESVIACION"];
                $i++;

                $gastos["AQP_EXC_REAL"] =$gastos["AQP_EXC_REAL"] + $item["AQP_EXC_REAL"];
                $gastos["AQP_EXC_MONTO"] =$gastos["AQP_EXC_MONTO"] + $item["AQP_EXC_MONTO"];
                $gastos["CIT_EXC_REAL"] =$gastos["CIT_EXC_REAL"] + $item["CIT_EXC_REAL"];
                $gastos["CIT_EXC_MONTO"] =$gastos["CIT_EXC_MONTO"] + $item["CIT_EXC_MONTO"];
                $gastos["LIM_EXC_REAL"] =$gastos["LIM_EXC_REAL"] + $item["LIM_EXC_REAL"];
                $gastos["LIM_EXC_MONTO"] =$gastos["LIM_EXC_MONTO"] + $item["LIM_EXC_MONTO"];
                $gastos["EXC_REAL_F"] =$gastos["EXC_REAL_F"] + $item["EXC_REAL_F"];
                $gastos["EXC_REAL"] =$gastos["EXC_REAL"] + $item["EXC_REAL"];
                $gastos["U_EXC_MONTO"] =$gastos["U_EXC_MONTO"] + $item["U_EXC_MONTO"];
                $gastos["EXC_DESVIACION"] =$gastos["EXC_DESVIACION"] + $item["EXC_DESVIACION"];


            }


            $request= Input::all();

            $client = new \GuzzleHttp\Client();
            $url = "http://".env('APP_IP').":".env('APP_PORT')."/api/Presupuesto/".$datos->linea."/".$datos->especialidad."/".$request["mes"];

            $request = $client->get($url);
            $js=json_decode($request->getBody(),true);
            $i=0;
            $char1 = array();
            foreach ($js as $item){
                 $char1[$i]["mes"]=$item["AcctName"];
                $char1[$i]["AQP_EXC_REAL"]=$item["AQP_EXC_REAL"]*-1;
                $char1[$i]["AQP_EXC_MONTO"]=$item["AQP_EXC_MONTO"]*-1;
                $char1[$i]["CIT_EXC_REAL"]=$item["CIT_EXC_REAL"]*-1;
                $char1[$i]["CIT_EXC_MONTO"]=$item["CIT_EXC_MONTO"]*-1;
                $char1[$i]["LIM_EXC_REAL"]=$item["LIM_EXC_REAL"]*-1;
                $char1[$i]["LIM_EXC_MONTO"]=$item["LIM_EXC_MONTO"]*-1;
                $char1[$i]["EXC_REAL_F"]=$item["EXC_REAL_F"]*-1;
                $char1[$i]["EXC_REAL"]=$item["EXC_REAL"]*-1;
                $char1[$i]["U_EXC_MONTO"]=$item["U_EXC_MONTO"]*-1;
                $char1[$i]["EXC_DESVIACION"]=$item["EXC_DESVIACION"]*-1;

                $i++;
            }



            $request= Input::all();
            $client = new \GuzzleHttp\Client();
            $url = "http://".env('APP_IP').":".env('APP_PORT')."/api/Presupuesto/".$datos->linea."/".$datos->especialidad."/".$request["mes"]."/".$datos->ingresos;
             $request = $client->get($url);
            $js=json_decode($request->getBody(),true);
            $i=0;
            $char1p = array();
            foreach ($js as $itemp){
                $char1[$i]["p"]["mes"]=$itemp["AcctName"];
                $char1[$i]["p"]["AQP_EXC_REAL"]=$itemp["AQP_EXC_REAL"];
                $char1[$i]["p"]["AQP_EXC_MONTO"]=$itemp["AQP_EXC_MONTO"];
                $char1[$i]["p"]["CIT_EXC_REAL"]=$itemp["CIT_EXC_REAL"];
                $char1[$i]["p"]["CIT_EXC_MONTO"]=$itemp["CIT_EXC_MONTO"];
                $char1[$i]["p"]["LIM_EXC_REAL"]=$itemp["LIM_EXC_REAL"];
                $char1[$i]["p"]["LIM_EXC_MONTO"]=$itemp["LIM_EXC_MONTO"];
                $char1[$i]["p"]["EXC_REAL_F"]=$itemp["EXC_REAL_F"];
                $char1[$i]["p"]["EXC_REAL"]=$itemp["EXC_REAL"];
                $char1[$i]["p"]["U_EXC_MONTO"]=$itemp["U_EXC_MONTO"];
                $char1[$i]["p"]["EXC_DESVIACION"]=$itemp["EXC_DESVIACION"];

                $i++;
            }

            $client = new \GuzzleHttp\Client();
            $request= Input::all();
            $url = "http://".env('APP_IP').":".env('APP_PORT')."/api/Presupuesto/".$datos->linea."/".$datos->especialidad."/".$request["mes"];
            $request = $client->get($url);
            $js=json_decode($request->getBody(),true);
            $i=0;
            $char2 = array();

            foreach ($js as $item){
                if($i==0) {
                    $char2[$i]["mes"] = $item["AcctName"];
                    $char2[$i]["AQP_EXC_REAL"] = $item["AQP_EXC_REAL"] * -1;
                    $char2[$i]["AQP_EXC_MONTO"] = $item["AQP_EXC_MONTO"] * -1;
                    $char2[$i]["CIT_EXC_REAL"] = $item["CIT_EXC_REAL"] * -1;
                    $char2[$i]["CIT_EXC_MONTO"] = $item["CIT_EXC_MONTO"] * -1;
                    $char2[$i]["LIM_EXC_REAL"] = $item["LIM_EXC_REAL"] * -1;
                    $char2[$i]["LIM_EXC_MONTO"] = $item["LIM_EXC_MONTO"] * -1;
                    $char2[$i]["EXC_REAL_F"] = $item["EXC_REAL_F"] * -1;
                    $char2[$i]["EXC_REAL"] = $item["EXC_REAL"] * -1;
                    $char2[$i]["U_EXC_MONTO"] = $item["U_EXC_MONTO"] * -1;
                    $char2[$i]["EXC_DESVIACION"] = $item["EXC_DESVIACION"] * -1;
                }else{
                    $char2[$i]["mes"] = $item["AcctName"];
                    $char2[$i]["AQP_EXC_REAL"] = $char2[$i-1]["AQP_EXC_REAL"]+( $item["AQP_EXC_REAL"] * -1);
                    $char2[$i]["AQP_EXC_MONTO"] =$char2[$i-1]["AQP_EXC_MONTO"]+(  $item["AQP_EXC_MONTO"] * -1);
                    $char2[$i]["CIT_EXC_REAL"] =$char2[$i-1]["CIT_EXC_REAL"]+(  $item["CIT_EXC_REAL"] * -1);
                    $char2[$i]["CIT_EXC_MONTO"] =$char2[$i-1]["CIT_EXC_MONTO"]+(  $item["CIT_EXC_MONTO"] * -1);
                    $char2[$i]["LIM_EXC_REAL"] =$char2[$i-1]["LIM_EXC_REAL"]+(  $item["LIM_EXC_REAL"] * -1);
                    $char2[$i]["LIM_EXC_MONTO"] =$char2[$i-1]["LIM_EXC_MONTO"]+(  $item["LIM_EXC_MONTO"] * -1);
                    $char2[$i]["EXC_REAL_F"] =$char2[$i-1]["EXC_REAL_F"]+(  $item["EXC_REAL_F"] * -1);
                    $char2[$i]["EXC_REAL"] =$char2[$i-1]["EXC_REAL"]+(  $item["EXC_REAL"] * -1);
                    $char2[$i]["U_EXC_MONTO"] =$char2[$i-1]["U_EXC_MONTO"]+(  $item["U_EXC_MONTO"] * -1);
                    $char2[$i]["EXC_DESVIACION"] =$char2[$i-1]["EXC_DESVIACION"]+(  $item["EXC_DESVIACION"] * -1);

                }
                $i++;
            }


            $request= Input::all();
            $client = new \GuzzleHttp\Client();
            $url = "http://".env('APP_IP').":".env('APP_PORT')."/api/Presupuesto/".$datos->linea."/".$datos->especialidad."/".$request["mes"]."/".$datos->ingresos;
            $request = $client->get($url);
            $js=json_decode($request->getBody(),true);
            $i=0;
            $char1p = array();
            foreach ($js as $itemp){
                if($i==0) {
                    $char2[$i]["p"]["mes"] = $itemp["AcctName"];
                    $char2[$i]["p"]["AQP_EXC_REAL"] = $itemp["AQP_EXC_REAL"] ;
                    $char2[$i]["p"]["AQP_EXC_MONTO"] = $itemp["AQP_EXC_MONTO"] ;
                    $char2[$i]["p"]["CIT_EXC_REAL"] = $itemp["CIT_EXC_REAL"] ;
                    $char2[$i]["p"]["CIT_EXC_MONTO"] = $itemp["CIT_EXC_MONTO"] ;
                    $char2[$i]["p"]["LIM_EXC_REAL"] = $itemp["LIM_EXC_REAL"] ;
                    $char2[$i]["p"]["LIM_EXC_MONTO"] = $itemp["LIM_EXC_MONTO"] ;
                    $char2[$i]["p"]["EXC_REAL_F"] = $itemp["EXC_REAL_F"] ;
                    $char2[$i]["p"]["EXC_REAL"] = $itemp["EXC_REAL"];
                    $char2[$i]["p"]["U_EXC_MONTO"] = $itemp["U_EXC_MONTO"] ;
                    $char2[$i]["p"]["EXC_DESVIACION"] = $itemp["EXC_DESVIACION"] ;
                }else{
                    $char2[$i]["p"]["mes"] = $itemp["AcctName"];
                    $char2[$i]["p"]["AQP_EXC_REAL"] = $char2[$i-1]["p"]["AQP_EXC_REAL"]+( $itemp["AQP_EXC_REAL"]);
                    $char2[$i]["p"]["AQP_EXC_MONTO"] =$char2[$i-1]["p"]["AQP_EXC_MONTO"]+(  $itemp["AQP_EXC_MONTO"] );
                    $char2[$i]["p"]["CIT_EXC_REAL"] =$char2[$i-1]["p"]["CIT_EXC_REAL"]+(  $itemp["CIT_EXC_REAL"] );
                    $char2[$i]["p"]["CIT_EXC_MONTO"] =$char2[$i-1]["p"]["CIT_EXC_MONTO"]+(  $itemp["CIT_EXC_MONTO"] );
                    $char2[$i]["p"]["LIM_EXC_REAL"] =$char2[$i-1]["p"]["LIM_EXC_REAL"]+(  $itemp["LIM_EXC_REAL"] );
                    $char2[$i]["p"]["LIM_EXC_MONTO"] =$char2[$i-1]["p"]["LIM_EXC_MONTO"]+(  $itemp["LIM_EXC_MONTO"] );
                    $char2[$i]["p"]["EXC_REAL_F"] =$char2[$i-1]["p"]["EXC_REAL_F"]+(  $itemp["EXC_REAL_F"] );
                    $char2[$i]["p"]["EXC_REAL"] =$char2[$i-1]["p"]["EXC_REAL"]+(  $itemp["EXC_REAL"] );
                    $char2[$i]["p"]["U_EXC_MONTO"] =$char2[$i-1]["p"]["U_EXC_MONTO"]+(  $itemp["U_EXC_MONTO"]);
                    $char2[$i]["p"]["EXC_DESVIACION"] =$char2[$i-1]["p"]["EXC_DESVIACION"]+(  $itemp["EXC_DESVIACION"]);

                }
                $i++;
            }








            return view ('logistica.detalle_presupuesto',compact("char1","char1p","char2","presupuesto","presupuesto2","sueldo","gastos"));

        }

        public function margen1()
        {


            if (Shinobi::canAtLeast(['presupuesto.ver'])) {
                $presupuesto = Presupuesto::orderBy("id")->get();

                return view('logistica.presupuesto', compact("presupuesto"));
            }else{



                $x="<div class=\"note note-danger\">
                                <h4 class=\"block\">Alerta! </h4>
                                <p>  Ud. no tiene permiso para ver esto  </p>
                            </div>";

                echo $x;
            }





        }
    }
}