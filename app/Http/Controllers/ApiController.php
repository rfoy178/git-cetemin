<?php

namespace App\Http\Controllers;

use App\Entidad\Log;
use App\Entidad\MarcasComedor;
use App\Entidad\Proveedor;
use App\Entidad\Rendir;
use App\Entidad\Rq;
use App\Entidad\RqDetalle;
use App\Entidad\Solicitud;
use App\Entidad\Texto;
use App\Entidad\VistaPagosEfectuados;
use App\Mail\AprobadoEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Peru\Http\ContextClient;
use Peru\Sunat\Ruc;
use Tecactus\Reniec\DNI;

class ApiController extends Controller
{

    function empleado (Request $request){



        $client = new \GuzzleHttp\Client();
        $url = "http://200.60.114.138:802/api/Asiento/" .$request->term;
        $request = $client->get($url);
        $js = json_decode($request->getBody(), true);

        $i = 0;
        $doc = array();
        foreach ($js as $item) {
            $doc[$i]["CardCode"] = $item["CardCode"];
            $doc[$i]["CardName"] = $item["CardName"];
            $doc[$i]["LicTradNum"] = $item["LicTradNum"];
            $i++;
        }

        return $doc;

    }
    function item ($id,$id2,Request $request){


        $rq = Rq::with("area")->where("id", $id2)->firstOrFail();

        $client = new \GuzzleHttp\Client();


//        $url = "http://200.60.114.138:802/api/Item/". strtoupper(Input::get("query"))."/".$id."/".$rq->area->gerencia;

            $url = "http://200.60.114.138:802/api/Item/". strtoupper(Input::get("query")).strtoupper(Input::get("term"))."/".$id."/".$rq->area->gerencia;

         $request = $client->get($url);
        $js = json_decode($request->getBody(), true);

        $i = 0;
        $doc = array();
        foreach ($js as $item) {
            $doc[$i]["ItemCode"] = $item["ItemCode"];
            $doc[$i]["ItemName"] = $item["ItemName"];
            $doc[$i]["Stock"] = $item["Stock"];
            $doc[$i]["precio_referencial"] = $item["Precio"];
            $doc[$i]["Unidad"] = $item["Unidad"];
            $doc[$i]["FullName"] = $item["FullName"];

            $i++;
        }

        return $doc;

    }
    function dni ($dni){
        $solicitud=Solicitud::where("dni",$dni)->firstOrFail();
        if($solicitud){
            $doc["Tipo"]=0;
            $doc["dni"]=$solicitud["dni"];
            $doc["nombre"]=$solicitud["nombre"];
            $doc["cargo"]=$solicitud["cargo"];
            $doc["banco"]=$solicitud["banco"];
            $doc["cta"]=$solicitud["cta"];
            $doc["email"]=$solicitud["email"];

        }else{
            $client = new \GuzzleHttp\Client();
            $url = "http://200.60.114.138:802/api/RedCaja/". $dni ."/dni";
            $request = $client->get($url);
            $js = json_decode($request->getBody(), true);

            $doc = array();
            foreach ($js as $item) {
                $doc["Code"] = $item["Code"];
                $doc["Datos"] = $item["Mensaje"];
            }
            $doc["Tipo"]=1;
            $porciones = explode("|", $doc["Datos"]);
            $doc["nombre"]=$porciones[0] . " ".$porciones[1] ." " .$porciones[2];

        }


        return Response::json($doc);

    }
    function ruc ($ruc){


        $proveedor=Proveedor::firstOrNew(['ruc' => $ruc]) ;

        if ($proveedor->exists) {


            $doc["ruc"]=$proveedor["ruc"];
            $doc["razon_social"]=$proveedor["razon_social"];


        }else{


            $client = new \GuzzleHttp\Client();
            $url = "http://200.60.114.138:802/api/RedCaja/". $ruc;
            $request = $client->get($url);
            $js = json_decode($request->getBody(), true);

            $doc = array();
            foreach ($js as $item) {
                $doc["Code"] = $item["Code"];
                $doc["Datos"] = $item["Mensaje"];
            }

            $porciones = explode("|", $doc["Datos"]);
            $doc["razon_social"]=$porciones[1] ;


            $x= new Proveedor();
            $x->ruc=$porciones[0];
            $x->razon_social=$porciones[1];
            $x->save();

        }


        return Response::json($doc);

    }
    function ruc2(){

        $cs = new Ruc();
        $cs->setClient(new ContextClient());

        $company = $cs->get("10451035253");
        if ($company === false) {
            echo $cs->getError();
            exit();
        }
          dd($company);

    }
    /*function migrar_socios(){
        ini_set('max_execution_time', 180);



        try{
            $r=Proveedor::where("estado",0)->get();
            foreach ($r as $item){

                if((strlen ($item->ruc)==11)){


                    $cs = new Ruc();

                    try{
                        $cs->setClient(new ContextClient());
                        $company = $cs->get($item->ruc);
                        if ($company === false) {
                            echo $cs->getError();
                            echo "xxxxx";
                        }

                        $articulos[0]["cardcode"]=$company->ruc;
                        $articulos[0]["cardname"]=$company->razonSocial;
                        $articulos[0]["C_DIRN"]=$company->direccion."-".$company->distrito."-".$company->provincia."-".$company->departamento;

                        $url = "http://200.60.114.138:802/api/Empresa";

                        $client = new \GuzzleHttp\Client([
                            'headers' => [ 'Content-Type' => 'application/json' ]
                        ]);


                        $response = $client->post($url,
                            ['body' => json_encode($articulos)]
                        );

                        $js = json_decode($response->getBody(), true);


                        $estado="";
                        foreach ($js as $item2) {
                            $estado = $item2["Code"];

                        }

                        if($estado==1){
                            $item->estado=1;
                            $item->save();

                        }else{

                        }


                    }catch (\Exception $e){
                        echo $e->getMessage();
                    }

                }else{
                    if((strlen ($item->ruc)==11)){
                        echo "x";
                    }
                }



            }

        }catch (\Exception $e){
            echo $e->getMessage();

        }


    }

*/
    function migrar_socios_json(){
        ini_set('max_execution_time', 180);

        try{
            $r=Proveedor::where("estado",0)->get();
            $i=0;
            foreach ($r as $item){

                if(strlen ($item->ruc)==11){


                    $cs = new Ruc();

                    try{
                        $cs->setClient(new ContextClient());
                        $company = $cs->get($item->ruc);
                        if ($company === false) {

                        }
                        $articulos[$i]["CardCode"]=$company->ruc;
                        $articulos[$i]["CardName"]=$company->razonSocial;
                        $articulos[$i]["C_DIRN"]=$company->direccion."-".$company->distrito."-".$company->provincia."-".$company->departamento;

                        if(substr($item->ruc,0,2)=="10"){

                            $reniecDni=new DNI("FnBCKqzPTAhPULclerj9EG81JjEtfyuIa8FnEykU");
                            $xxxx= $reniecDni->get(substr($item->ruc,2,8), true);
                            $nn=explode(" ", $xxxx["nombres"]);
                            if(count($nn)==2){
                                $item->primer_nombre=$nn[0];
                                $item->segundo_nombre=$nn[1];
                            }else{
                                $item->primer_nombre=$xxxx["nombres"];
                                $item->segundo_nombre="";
                            }

                            $item->apellido_paterno=$xxxx["apellido_paterno"];
                            $item->apellido_materno=$xxxx["apellido_materno"];
                            $item->tipo="TPN";
                            $item->save();
                            $articulos[$i]["Tipo"]="TPN";

                            $articulos[$i]["Nombre1"]=$item->primer_nombre;
                            $articulos[$i]["Nombre2"]=$item->segundo_nombre;
                            $articulos[$i]["Apepat"]=$item->apellido_paterno;
                            $articulos[$i]["Apemat"]=$item->apellido_materno;

                        }

                    }catch (\Exception $e){


                        // echo ;
                        $item->estado="1000";
                        $item->mensaje=$e->getMessage();

                        $item->save();
                    }








                }else{
                    $item->estado="1001";
                    $item->mensaje="RUC INVALIDO";

                    $item->save();

                }
                $i++;
                return Response::json($articulos);

            }

        }catch (\Exception $e){

            $item->estado="1003";
            $item->mensaje=$e->getMessage();;

            $item->save();

        }


    }
    function migrar_socios_json_post(Request $request){


        $js3=json_decode($request->getContent(),true);



            $error=$js3["error"];
            $mensaje=$js3["mensaje"];
            $proveedor=$js3["proveedor"];
            $r=Proveedor::where("ruc",$proveedor)->firstOrFail();
            $codigo=explode("-",$mensaje);

            if(($error==0)||(trim($codigo[0])=="1320000140")||(trim($codigo[0])=="-10")){

                $r->estado=1;
                $r->mensaje="";

            }else{

                $r->estado=$error;
                $r->mensaje=$mensaje;

            }


            $r->save();


        return Response::json($r);



    }
    function migrar_rq_json(Request $request){

        //$id=553;
            $rq=Rq::with("area")->with("detalle")->with("usuario")->with("estados")->where("estado",13)->firstOrFail();
         $articulos[0]["Id"]=$rq->id;

         $articulos[0]["RequesterName"]=$rq->usuario->nombres ."  ".$rq->usuario->apellidos;
            $articulos[0]["RequesterDepartment"]=$rq->usuario->area;

            if(($rq->usuario->sede_id=="1")&&($rq->clase=="I")){
                $articulos[0]["Series"]=177;
                $str4 = "ALM_CENT";
            }
            if(($rq->usuario->sede_id=="1")&&($rq->clase=="S")){
                $articulos[0]["Series"]=178;
                $str4 = "ALM_CENT";
            }
            if(($rq->usuario->sede_id=="2")&&($rq->clase=="I")){
                $articulos[0]["Series"]=180;
                $str4 = "ALM_AREQ";
            }
            if(($rq->usuario->sede_id=="2")&&($rq->clase=="S")){
                $articulos[0]["Series"]=181;
                $str4 = "ALM_AREQ";
            }
            $articulos[0]["RequriedDate"]=$rq->fecha2;
            $articulos[0]["clase"]=$rq->clase;
            $articulos[0]["comentario"]=$rq->comentario;
            $articulos[0]["almacen"]=$str4;
            $articulos[0]["U_CET_DOCWEB"]=$rq->area->abreviatura."-".str_pad($rq->id, 5, "0", STR_PAD_LEFT);
            $rqd = RqDetalle::with(['cc' => function($query) {
                $query->with('centro');
            }])->where("requerimiento_id",$rq->id)->get();

            $i=0;
            foreach ($rqd  as $item){
                foreach ($item->cc  as $item2) {
                    $articulos[0]["Detalle"][$i]["ItemCode"] = $item->articulo_id;
                    $articulos[0]["Detalle"][$i]["U_CET_SERDESCRIPCION"] = $item->servicio;
                    $articulos[0]["Detalle"][$i]["cantidad"] = $item->cantidad;
                    $articulos[0]["Detalle"][$i]["U_CET_SERPORCENTAJE"] = $item2->porcentaje+0;
                    $articulos[0]["Detalle"][$i]["LineaCode"] = $item2->centro->LineaCode;
                    $articulos[0]["Detalle"][$i]["SedeCode"] = $item2->centro->SedeCode;
                    $articulos[0]["Detalle"][$i]["ModalidadCode"] =$item2->centro->ModalidadCode;
                    $articulos[0]["Detalle"][$i]["EspecialidadCode"] = $item2->centro->EspecialidadCode;
                    $articulos[0]["Detalle"][$i]["AdmisionCode"] =$item2->centro->AdmisionCode;
                    $i++;
                }
            }

        return Response::json($articulos);

    }
    function migrar_rq_json_post(Request $request){

        $js3=json_decode($request->getContent(),true);

        $error=$js3["error"];
        $mensaje=$js3["mensaje"];
        $codigo=$js3["codigo"];
        $id=$js3["id"];

        $rq1 = Rq::where("id", $id)->firstOrFail();
        $porciones=explode("-",$codigo);
        if($error!="35") {

            if($mensaje!="(123) YA EXISTE UN DOCUMENTO CON ESTE CODIGO") {
                if (($error == 0)) {
                    $rq1->estado = 4;
                    $rq1->docEntry = $porciones[0];
                    $rq1->docNum = $porciones[1];
                    $log = new Log();
                    $log->requerimiento_id = $id;
                    $log->accion_id = 5;
                    $log->detalle = "Solicitud " . $porciones[1];
                    $log->save();

                } else {


                    $rq1->estado = 21;
                    $rq1->mensaje_sap = $mensaje;


                }
                $rq1->save();
            }
        }else{

            $rq1->estado = 4;
            $rq1->docEntry = $porciones[0];
            $rq1->docNum = $porciones[1];
            $rq1->mensaje_sap = "";

            $rq1->save();

        }


        return Response::json($rq1);
    }
    function migrar_pago_efectuados_json(Request $request){
    $rq=VistaPagosEfectuados::firstOrFail();

    $articulos[0]["Id"]=$rq->id;

    $articulos[0]["CardCode"]=$rq->CardCode;
    $articulos[0]["DocDate"]=$rq->DocDate;

    $articulos[0]["TransferAccount"]=$rq->TransferAccount;
    $articulos[0]["TransferReference"]=$rq->TransferReference;
    $articulos[0]["TransferSum"]=$rq->TransferSum;
    $articulos[0]["Remarks"]=$rq->Remarks;
    $articulos[0]["ControlAccount"]=$rq->ControlAccount;
    return Response::json($articulos);
}
    function migrar_pago_efectuados_json_post(Request $request){

        $js3=json_decode($request->getContent(),true);

        $error=$js3["error"];
        $mensaje=$js3["mensaje"];
        $codigo=$js3["codigo"];
        $id=$js3["id"];

        $rq1 = Texto::where("id", $id)->firstOrFail();

        if($error!="35") {


            if (($error == 0)) {
                $rq1->estado = 4;
                $rq1->docEntry = $codigo;

                $log = new Log();
                $log->requerimiento_id = $id;
                $log->accion_id = 5;
                $log->detalle = "Solicitud " . $codigo;
                $log->save();



                $mail = Solicitud::where("id", $rq1->requerimiento_id)->firstOrFail();
                $mail->estado=9;
                $mail->save();
                Mail::to( $mail->email)->send(new AprobadoEmail($mail));


            } else {
                $rq1->estado = 21;
                $rq1->mensaje_sap = $error . " - " . $mensaje;

            }
            $rq1->save();
        }else{
            $rq1->estado = 4;

            $rq1->docEntry = $codigo;
            $rq1->mensaje_sap ="";

            $rq1->save();

            $mail = Solicitud::where("id", $rq1->requerimiento_id)->firstOrFail();
            $mail->estado=9;
            $mail->save();
            Mail::to( $mail->email)->send(new AprobadoEmail($mail));


        }

        return Response::json($rq1);
    }

    function migrar_caja_json(Request $request){


        $rq=Rendir::with("cc")->where("sap",1)->whereNotNull("caja")->where("tipo","!=","MV")->firstOrFail();



        $usuario=Solicitud::with("usuario")->where("id",$rq->deposito_id)->firstOrFail();
        $articulos[0]["clase"]=$rq->monto;
        $articulos[0]["comentario"]= strtoupper($usuario->usuario->apellidos)." - ".$rq->concepto;
        $articulos[0]["RequesterName"]=$rq->serie;
        $articulos[0]["Indicator"]=$rq->tipo;
        $articulos[0]["Caja"]=$rq->tipo;
        $articulos[0]["RequesterDepartment"]=$rq->ruc;
        $articulos[0]["RequriedDate"]=$rq->fecha_contable;
        $articulos[0]["Er"]=$rq->caja;
        $articulos[0]["almacen"]=$rq->fecha;
        $articulos[0]["U_CET_DOCWEB"]="DOC-".str_pad($rq->id, 5, "0", STR_PAD_LEFT);
        $articulos[0]["Id"]=$rq->id;
        $rqd = Rendir::with(['cc' => function($query) {
            $query->with('centro');
        }])->with("iva")->where("id",$rq->id)->get();

        $i=0;
        foreach ($rqd  as $item){
            foreach ($item->cc  as $item2) {
                $articulos[0]["Detalle"][$i]["ItemCode"] = $item->servicio_id;
                $articulos[0]["Detalle"][$i]["cantidad"] = 1;
                $articulos[0]["Detalle"][$i]["U_CET_SERPORCENTAJE"] =  $item2->porcentaje + 0;
                $articulos[0]["Detalle"][$i]["LineaCode"] = $item2->centro->LineaCode;
                $articulos[0]["Detalle"][$i]["SedeCode"] = $item2->centro->SedeCode;
                $articulos[0]["Detalle"][$i]["ModalidadCode"] =$item2->centro->ModalidadCode;
                $articulos[0]["Detalle"][$i]["EspecialidadCode"] = $item2->centro->EspecialidadCode;
                $articulos[0]["Detalle"][$i]["AdmisionCode"] =$item2->centro->AdmisionCode;
                $articulos[0]["Detalle"][$i]["Iva"] =$rq->iva->codigo;
                $i++;
            }
        }

        return Response::json($articulos);
    }

    function migrar_caja_json_post(Request $request){
        $js3=json_decode($request->getContent(),true);


        $error=$js3["error"];
        $mensaje=$js3["mensaje"];
        $codigo=$js3["codigo"];
        $id=$js3["id"];

        $rq1 = Rendir::where("id", $id)->firstOrFail();
        $porciones=explode("-",$codigo);
        if($error!=35) {
                if (($error == 0)) {
                    $rq1->sap = 2;
                    $rq1->docEntry = $porciones[0];
                    $rq1->docNum = $porciones[1];
                    $log = new Log();
                    $log->requerimiento_id = $id;
                    $log->accion_id = 5;
                    $log->detalle = "Datos" . $porciones[1];
                    $log->save();
                } else {
                    $rq1->sap = 21;
                    $rq1->mensaje_sap = $mensaje;
                }
        }else{
            $rq1->sap = 2;
            $rq1->docEntry = $porciones[0];
            $rq1->docNum = $porciones[1];
            $rq1->mensaje_sap = "";
        }

        $rq1->save();

        return Response::json($rq1);

    }

    function siga_marcas($inicio,$fin){


        $finicio=str_replace ("_","-",$inicio);
        $ffin=str_replace ("_","-",$fin);

        $marcas=MarcasComedor::select("dni")->whereBetween('sTime', [$finicio, $ffin])->distinct("dni")->get();

        return Response::json($marcas);

    }

}
