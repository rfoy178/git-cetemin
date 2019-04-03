<?php

namespace App\Http\Controllers\Logistica;

use App\Entidad\Area;
use App\Entidad\Centro;
use App\Entidad\Estado;
use App\Entidad\Log;
use App\Entidad\Mensaje;
use App\Entidad\Movimiento;
use App\Entidad\Rendir;
use App\Entidad\Rq;
use App\Entidad\RqCC;
use App\Entidad\RqDetalle;
use App\Entidad\RqValidacion;
use App\Entidad\Unidad;
use App\Entidad\VistaValidacion;
use App\Http\Controllers\PresupuestoController;
use App\Mail\rq\AprobacionEmail;
use App\Mail\rq\AprobadoEmail;
use App\User;
use Caffeinated\Shinobi\Facades\Shinobi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Shivella\Bitly\Facade\Bitly;

class RequerimientoController extends Controller
{
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function comentario(Request $request)
    {
        try{

            //dd($request->all());
            $rq1 = Rq::where("id",$request->rq_id)->first();
            $rq1->comentario=$request->comentario;
            $rq1->save();

            $this->response['error'] = false;
        }catch (\Exception $e){
            $this->response['error'] = true;
            $this->response['mensaje'] = $e->getMessage();
        }
        return Response::json($this->response);



    }
    public function dias($dias,$fecha){

        $holidays = ["2018-12-08", "2018-12-25", "2019-01-01"];

        $date = Carbon::parse($fecha);

        $MyDateCarbon = Carbon::parse($date);

        $MyDateCarbon->addDay( $dias);

        for ($i = 1; $i <=  $dias; $i++) {
            $date->addDay();
            if ((in_array(Carbon::parse($date)->toDateString(), $holidays))||($date->isWeekend())) {
                $MyDateCarbon->addDay();

            }
        }

        $endDate = $MyDateCarbon->format('d-m-Y');
        return $endDate;
    }
    public function aprobacion($aprobacion_code,Request $request)
    {

        /*    try{

                DB::beginTransaction();
    */
        $rq1=Rq::with("area")->with("estados")->with("usuario")->where('aprobacion_code', $aprobacion_code)->where("id",$request->id_e)->first();

        if($rq1){
            $usuario = User::where("id", $rq1->user_id)->first();
            $rq1->estado=$request->estado_e;
            $codigo=$rq1->area->abreviatura." ".str_pad($rq1->id, 5, "0", STR_PAD_LEFT);

            if($request->estado_e==2) {
                $date = Carbon::now();
                $rq1->fecha_aprobacion=$date;
                $rq1->aprobacion = 1;
                $rq1->aprobacion_code = '';
                Mail::to( $usuario->email)->send(new AprobadoEmail($rq1,$codigo));
            }

            $rq1->save();


            $estado=Estado::where("id",$request->estado_e)->first();
            $log=new Log();
            $log->requerimiento_id=$rq1->id;
            $log->detalle=$estado->name;
            $log->user_id=$usuario->jefe;
            $log->accion_id=7;
            $log->tipo=1;
            $log->save();


            $mensaje=new Mensaje();
            $mensaje->mensaje=$request->txtmensaje;
            $mensaje->leido=0;
            $mensaje->user_id=$usuario->id;
            $mensaje->rq_id=$usuario->jefe;
            $mensaje->log_id=$log->id;
            $mensaje->save();
$estado=$request->estado_e;
$id=$request->id_e;

            return view ('logistica.estado',compact("estado","id"));


        }else{

            return abort('403');
        }





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
    public function cotizacion(){
         $cotizacion = Rq::with("usuario")->with("area")->with("detalle")->with("estados")->where("estado",4)->get();

        foreach ($cotizacion as $rq ){

            $client = new \GuzzleHttp\Client();
            $url = "http://".env('APP_IP').":".env('APP_PORT')."/api/Cotizacion/".$rq->docEntry;
            $request = $client->get($url);
            $js=json_decode($request->getBody(),true);


              foreach ($js as $item2){
                 if($item2["Code"]=="0"){
                        if($rq->cotizacion<$item2["Mensaje"]){
                            $rq->cotizacion=$item2["Mensaje"];
                            $rq->save();
                            $codigo = $rq->area->abreviatura . " " . str_pad($rq->id, 5, "0", STR_PAD_LEFT);
                            $log=new Log();
                            $log->requerimiento_id=$rq->id;
                            $log->accion_id=8;
                            $log->detalle="Logistica";
                            $log->user_id=5;
                            $log->save();
                            Mail::send('logistica.email', $rq->toArray(), function ($message) use ($codigo,$rq) {
                                $message->from('noresponder@cetemin.edu.pe', 'CETEMIN RQ');
                                $message->to($rq->usuario->email);
                                $message->subject("CETEMIN RQ " . $codigo ."[Nueva Cotizacion]");

                            });
                        }
                 }
              }

            $client = new \GuzzleHttp\Client();
            $url = "http://".env('APP_IP').":".env('APP_PORT')."/api/Cotizacion/".$rq->docEntry."/2/3";
            $request = $client->get($url);
            $js=json_decode($request->getBody(),true);

            foreach ($js as $item2){
                if($item2["DocEntry"]!="0"){
                        $rq->estado=10;
                        $rq->save();
                        $codigo = $rq->area->abreviatura . " " . str_pad($rq->id, 5, "0", STR_PAD_LEFT);
                        $log=new Log();
                        $log->requerimiento_id=$rq->id;
                        $log->accion_id=8;
                        $log->detalle="Logistica";
                        $log->user_id=5;
                        $log->save();
                        Mail::send('logistica.email', $rq->toArray(), function ($message) use ($codigo,$rq) {
                            $message->from('noresponder@cetemin.edu.pe', 'CETEMIN RQ');
                            $message->to($rq->usuario->email);
                            $message->subject("CETEMIN RQ " . $codigo ."ORDEN DE COMPRA");
                        });
                }
            }



        }

    }
    public function comparativo($id){

        $rq=Rq::with("area")->with("detalle")->with("estados")->where("id",$id)->first();
         $client = new \GuzzleHttp\Client();
        $url = "http://".env('APP_IP').":808/api/Cotizacion/".$rq->docEntry."/i";
        $request = $client->get($url);
        $js=json_decode($request->getBody(),true);


        $i=0;
        $xx = array();
        foreach ($js as $item){
            $xx[$i]["Codigo"]=$item["CardCode"];
            $xx[$i]["Nombre"]=$item["CardName"];
            $xx[$i]["Pago"]=$item["PymntGroup"];
            $xx[$i]["Total"]=$item["LineTotal"];
            $i++;
        }


        $client = new \GuzzleHttp\Client();
        $url = "http://".env('APP_IP').":808/api/Cotizacion/".$rq->docEntry;
        $request = $client->get($url);
        $js2=json_decode($request->getBody(),true);
        $client = new \GuzzleHttp\Client();
        $url = "http://".env('APP_IP').":808/api/Cotizacion/".$rq->docEntry."/i/l";
        $request = $client->get($url);
        $linea=json_decode($request->getBody(),true);
        $i=0;
        foreach ($linea as $item){
            $l[$i]=$item["BaseLine"];
            $i++;
        }


        foreach ($js2 as $item) {


            $conta[$item["LineNum"]]["CurSource"]=$item["CurSource"];
            $conta[$item["LineNum"]]["Codigo"]=$item["ItemCodeR"];
            $conta[$item["LineNum"]]["Descripcion"]=$item["DscriptionR"];
            $conta[$item["LineNum"]]["Cantidad"]=$item["QuantityR"];
            $conta[$item["LineNum"]][$item["CardCode"]]["Cantidad"]=$item["Quantity"];
            $conta[$item["LineNum"]][$item["CardCode"]]["Price"]=$item["Price"];
            $conta[$item["LineNum"]][$item["CardCode"]]["Dscription"]=$item["Dscription"];
            $conta[$item["LineNum"]][$item["CardCode"]]["LineTotal"]=$item["LineTotal"];
        }


        $cot=$this->carga($rq->docEntry );

//                return view ('logistica.comparativo')->with('rq', $rq)->with('linea', json_encode($linea,true))->with('js', $js)->with('conta', $conta);

        return view ('logistica.comparativo',['rq' => $rq,'linea' => $l,'js' => $xx,'conta' => $conta,'cot'=>$cot]);



    }
    public function send($id)
    {
        $rqX = Rq::where("id", $id)->first();

        /*Sin aprobación  - Caso Maribel*/
        if(Auth::user()->aprobacion==1) {
            $date = Carbon::now();
            $rqX->fecha_aprobacion=$date;
            $rqX->estado = 2;
            $rqX->save();
            return redirect()->route('rq.show', ['id' => $id]);
        }else{

            if(Auth::user()->jefe>0) {

                $detalle=RqDetalle::where("requerimiento_id",$id)->count();
                if($detalle==0) {
                    $e="Debe de agregar articulos/servicios a su requerimiento";
                    return redirect()->route('rq.show', ['id' => $id])->withErrors(['error'=>$e]);
                }else{
                    $e = "";
                    $usuario = User::where("id", Auth::user()->jefe)->first();
                    $rq1 = Rq::with("usuario")->with("area")->with("detalle")->with("estados")->where("id", $id)->first();
                    $rq1->estado = 1;
                    $code = str_random(25);
                    $rq1->aprobacion_code=$code;
                    $rq1->save();
                    $codigo = $rq1->area->abreviatura . " " . str_pad($rq1->id, 5, "0", STR_PAD_LEFT);
                    $rq = $rq1->toArray();


                    Mail::to( $usuario->email)->send(new AprobacionEmail($rq1,$codigo));


                    /*   Mail::send('logistica.email', $rq, function ($message) use ($codigo, $usuario) {
                           $message->from('noresponder@cetemin.edu.pe', 'CETEMIN RQ');
                           $message->to($usuario->email);
                           $message->subject("CETEMIN RQ " . $codigo);
                       });
                   */

                    $log = new Log();
                    $log->requerimiento_id = $rq1->id;
                    $log->accion_id = 2;
                    $log->detalle = $usuario->nombres . " " . $usuario->apellidos;
                    $log->user_id = Auth::user()->id;
                    $log->save();
                    return redirect()->route('rq.show', ['id' => $id]);
                }

            }else{

                $e="No tiene asignado un aprobador";
                return redirect()->route('rq.show', ['id' => $id])->withErrors(['error'=>$e]);

            }

        }
    }

    public function sendPreview($id)
    {
        $rqX = Rq::where("id", $id)->first();

        /*Sin aprobación  - Caso Maribel*/
        if(Auth::user()->aprobacion==1) {
            $date = Carbon::now();
            $rqX->fecha_aprobacion=$date;
            $rqX->estado = 2;
            $rqX->save();
            return redirect()->route('rq.show', ['id' => $id]);
        }else{

            if(Auth::user()->jefe>0) {

                $detalle=RqDetalle::where("requerimiento_id",$id)->count();
                if($detalle==0) {
                    $e="Debe de agregar articulos/servicios a su requerimiento";
                    return redirect()->route('rq.show', ['id' => $id])->withErrors(['error'=>$e]);
                }else{
                    $e = "";
                    $usuario = User::where("id", Auth::user()->jefe)->first();
                    $rq1 = Rq::with("usuario")->with("area")->with("detalle")->with("estados")->where("id", $id)->first();
                    $code = str_random(25);
                    $rq1->aprobacion_code=$code;
                    $codigo = $rq1->area->abreviatura . " " . str_pad($rq1->id, 5, "0", STR_PAD_LEFT);
                    $rq = $rq1->toArray();


                    ini_set('max_execution_time', 0); // for infinite time of execution
                    $rq=VistaValidacion::select('OcrCode1','OcrCode2','OcrCode3','OcrCode4','OcrCode5','gasto as Monto')
                        ->where("id",$id)
                        ->orderBy('OcrCode1')
                        ->orderBy('OcrCode2')
                        ->orderBy('OcrCode3')
                        ->orderBy('OcrCode4')
                        ->orderBy('OcrCode5')
                        ->get();
                    $url = "http://localhost:59272/api/Validacion";

                    $client = new \GuzzleHttp\Client([
                        'headers' => [ 'Content-Type' => 'application/json' ]
                    ]);
                    $response = $client->post($url,
                        ['body' => json_encode($rq->toArray())]
                    );
                    $js = json_decode($response->getBody(), true);

                    $x=RqValidacion::where("rq_id",$id)->delete();

                    $pre=0;
                    foreach ($js as $item1){
                        $x2 = new RqValidacion();
                        $x2->rq_id=$id;
                        $x2->OcrCode1=$item1["OcrCode1"];
                        $x2->OcrCode2=$item1["OcrCode2"];
                        $x2->OcrCode3=$item1["OcrCode3"];
                        $x2->OcrCode4=$item1["OcrCode4"];
                        $x2->OcrCode5=$item1["OcrCode5"];
                        $x2->U_EXC_MONTO = $item1["U_EXC_MONTO"];
                        $x2->EXC_REAL_F =$item1["EXC_REAL_F"];
                        $x2->monto =$item1["Monto"];
                        if(($item1["U_EXC_MONTO"]-$item1["EXC_REAL_F"])<$item1["Monto"]){
                            $pre=1;
                        }
                        $x2->save();
                    }

                    $presupuesto=RqValidacion::where("rq_id",$id)->where("estado",0)->get();
                    $requerimiento=$rq1;

                    // $this->subject("CETEMIN RQ [".$codigo."]");
                    //enviar email a JD
                    // view('logistica.email.aprobacion',compact("presupuesto","requerimiento","codigo"));

                    if($pre==1){
                        $rq1->estado = 15;

                    }else{
                        $rq1->estado = 1;
                    }

                    $rq1->presupuesto=$pre;
                    $rq1->save();

                }

            }else{

                $e="No tiene asignado un aprobador";
                return redirect()->route('rq.show', ['id' => $id])->withErrors(['error'=>$e]);

            }

        }
    }


    public function sap($id){
        $a["estado"]="ok";
        $log=new Log();
        $rq1 = Rq::where("id", $id)->first();
        $rq1->estado = 13;

        $rq1->save();

        return Response::json($a);

    }
    public function create(){
        $area=Area::where("id",Auth::user()->area)->get();
        $sum=11;
        $holidays = ["2018-12-08", "2018-12-25", "2019-01-01"];

        $date = Carbon::now();

        $MyDateCarbon = Carbon::parse($date);

        $MyDateCarbon->addDay( $sum);

        for ($i = 1; $i <=  $sum; $i++) {
            $date->addDay();
            if ((in_array(Carbon::parse($date)->toDateString(), $holidays))||($date->isWeekend())) {
                $MyDateCarbon->addDay();

            }
        }

        $endDate = $MyDateCarbon->format('d-m-Y');

        return view ('logistica.formularios.nuevo',compact("area","date","endDate"));

    }
    public function estado_rq($id){

        $rq=Rq::select("estado")->where("id",$id)->first();

        return Response::json($rq->estado);

    }
    public function mensaje_jefe(Request $request)
    {
        try{
                $rq1 = Rq::where("id",$request->id)->first();
                $rq1->mensaje_jefe=$request->mensaje;
                $rq1->save();

                $usuario = User::where("id", $rq1->user_id)->first();
                $jefe = User::where("id", $usuario->jefe)->first();

                $log=new Log();
                $log->requerimiento_id=$rq1->id;
                $log->detalle=$jefe->nombres." ".$jefe->apellidos;
                $log->user_id=$jefe->id;
                $log->accion_id=6;

                $log->save();
            $mensaje=new Mensaje();
            $mensaje->mensaje=$request->mensaje;
            $mensaje->leido=0;
            $mensaje->user_id=$rq1->user_id;
            $mensaje->rq_id=$request->id;
            $mensaje->log_id=$log->id;

            $mensaje->save();

                $this->response['error'] = false;
        }catch (\Exception $e){
           $this->response['error'] = true;
           $this->response['mensaje'] = $e->getMessage();
        }
        return Response::json($this->response);



    }
    public function editar_estado($id,$valor,Request $request){

         try{
            $rq1 = Rq::where("id",$id)->first();
            $rq1->estado=$valor;

             $codigo=$rq1->area->abreviatura." ".str_pad($rq1->id, 5, "0", STR_PAD_LEFT);



             if($valor==2) {
                $date = Carbon::now();
                $rq1->fecha_aprobacion=$date;



            }


            $rq1->save();

            $usuario = User::where("id", $rq1->user_id)->first();

            $estado=Estado::where("id",$valor)->first();
            $log=new Log();
            $log->requerimiento_id=$rq1->id;
            $log->detalle=$estado->name;
            $log->user_id=$usuario->id;
            $log->accion_id=7;
            $log->save();


            $this->response['error'] = false;
        }catch (\Exception $e){
            $this->response['error'] = true;
           $this->response['mensaje'] = $e->getMessage();
        }

        return redirect()->route('rq.show', ['id' => $id]);



    }
    public function editar_estadoP ($id,$valor,Request $request){

         try{
            $rq1 = Rq::where("id",$id)->first();
             $rq1->estado=$valor;
             $codigo=$rq1->area->abreviatura." ".str_pad($rq1->id, 5, "0", STR_PAD_LEFT);
             $correo=$rq1->usuario->email;
            if($valor==2) {
                $date = Carbon::now();
                $rq1->fecha_aprobacion=$date;
                Mail::send('logistica.email', $rq1->toArray(), function ($message) use ($codigo,$rq1,$valor,$correo) {
                    $message->from('noresponder@cetemin.edu.pe', 'CETEMIN RQ');
                    $message->to($correo );

                    $cc=array("auxiliar.logistica@cetemin.edu.pe","manuel.aguilar@cetemin.edu.pe","jdanielzr@gmail.com");
                    if($valor==2){
                        $message->cc($cc);
                    }

                    $message->subject("CETEMIN RQ ".$codigo." Aprobado");

                });


            }

            $rq1->save();

            $usuario = User::where("id", $rq1->user_id)->first();

            $estado=Estado::where("id",$valor)->first();
            $log=new Log();
            $log->requerimiento_id=$rq1->id;
            $log->detalle=$estado->name;
            $log->user_id=$usuario->id;
            $log->accion_id=7;
            $log->save();


             $mensaje=new Mensaje();
             $mensaje->mensaje=$request->mensaje;
             $mensaje->leido=0;
             $mensaje->user_id=Auth::user()->id;
             $mensaje->rq_id=$request->id;
             $mensaje->log_id=$log->id;

             $mensaje->save();





            $this->response['error'] = false;
        }catch (\Exception $e){
            $this->response['error'] = true;
            $this->response['mensaje'] = $e->getMessage();
        }

        return Response::json($this->response);



    }
    public function estado($id,$estado)
    {
        $rq1 = Rq::with("usuario")->with("area")->with("detalle")->with("estados")->where("id", $id)->first();

        if($estado==2) {
            $date = Carbon::now();
            $rq1->fecha_aprobacion=$date ;
        }

        $rq1->estado=$estado;
        $rq1->save();

        $usuario = User::where("id", $rq1->usuario->jefe)->first();
        $codigo=$rq1->area->abreviatura." ".str_pad($rq1->id, 5, "0", STR_PAD_LEFT);
        $rq=$rq1->toArray();

        $log=new Log();
        $log->requerimiento_id=$rq1->id;
        $log->detalle=$usuario->nombres." ".$usuario->apellidos;
        $log->user_id=Auth::user()->id;

        if($estado==2){
            $codigo=$codigo ." [APROBADO]";
            $log->accion_id=3;

        }
        if($estado==3){
            $codigo=$codigo ." [DENEGADO]";
            $log->accion_id=4;

        }
        $log->save();
        $cc=array("auxiliar.logistica@cetemin.edu.pe","manuel.aguilar@cetemin.edu.pe","jdanielzr@gmail.com");
        Mail::send('logistica.email', $rq, function ($message) use ($cc,$codigo,$rq1,$estado) {
            $message->from('noresponder@cetemin.edu.pe', 'CETEMIN RQ');
            $message->to($rq1->usuario->email);

            if($estado==2){
                $message->cc($cc);
            }

            $message->subject("CETEMIN RQ ".$codigo);

        });

        return view ('logistica.estado',compact("estado","id"));
    }
    public function show($id)
    {
        $area=Area::all();
        $rq=Rq::with("area")->with("detalle")->with("estados")->where("id",$id)->first();
         $log=Log::with("accion")
            ->leftJoin('mensajes', 'log.id', '=', 'mensajes.log_id')
            ->where("requerimiento_id",$id)
            ->orderBy("log.id","desc")
            ->select(DB::raw('log.*,mensajes.mensaje,mensajes.leido'))
            ->get();

        $mensajeC=Mensaje::where("rq_id",$id)
            ->where("leido",0)
                ->count();

        $mensaje=Mensaje::where("rq_id",$id)
            ->get();


        $doc = array();
        $orden = array();

        //dd($rq->docEntry);
        if(isset($rq->docEntry)) {

            $rq = Rq::with("area")->with("detalle")->with("estados")->where("id", $id)->first();
            $client = new \GuzzleHttp\Client();
            $url = "http://".env('APP_IP').":".env('APP_PORT')."/api/Cotizacion/" . $rq->docEntry."/2";

            $request = $client->get($url);
            $js = json_decode($request->getBody(), true);
             $i = 0;
            $doc = array();
            foreach ($js as $item) {
                $doc[$i]["Code"] = $item["Code"];
                $doc[$i]["Mensaje"] = $item["Mensaje"];
                $i++;
            }


            $client = new \GuzzleHttp\Client();
            $url = "http://".env('APP_IP').":".env('APP_PORT')."/api/Cotizacion/".$rq->docEntry."/2/3";
            $request = $client->get($url);
            $js=json_decode($request->getBody(),true);


            $i=0;

            foreach ($js as $item){
                $orden[$i]["DocEntry"]=$item["DocEntry"];
                $orden[$i]["DocNum"]=$item["DocNum"];
                $orden[$i]["CardName"]=$item["CardName"];
                $orden[$i]["DocDate"]=substr($item["DocDate"],0,10);
                $orden[$i]["Comments"]=$item["Comments"];
                $orden[$i]["DocCur"]=$item["DocCur"];
                $orden[$i]["DocTotal"]=$item["DocTotal"];
                $orden[$i]["TaxDate"]=$item["TaxDate"];
                $orden[$i]["U_EXC_AUTPRE"]=$item["U_EXC_AUTPRE"];
                $orden[$i]["U_EXC_COMPRE"]=$item["U_EXC_COMPRE"];
                $orden[$i]["U_EXC_AUTCOM"]=$item["U_EXC_AUTCOM"];
                $orden[$i]["U_EXC_COMCOM"]=$item["U_EXC_COMCOM"];
                $orden[$i]["U_EXC_AUTGER"]=$item["U_EXC_AUTGER"];
                $orden[$i]["U_EXC_COMGER"]=$item["U_EXC_COMGER"];
                $orden[$i]["U_EXC_AUTGGF"]=$item["U_EXC_AUTGGF"];
                $orden[$i]["U_EXC_COMGGF"]=$item["U_EXC_COMGGF"];
                $i++;
            }
        }

        $cc=Centro::where("Usuario_id",Auth::user()->id)
            ->orderBy("LineaCode")
            ->orderBy("EspecialidadCode")
            ->orderBy("AdmisionCode")
            ->get();

        //$cc=Centro::where("Usuario_id",Auth::user()->id)->get();
        //$files = Storage::allFiles($rq->area->abreviatura."-".str_pad($rq->id, 5, "0", STR_PAD_LEFT));
        $files=array();

        $unidad=Unidad::where("estado",0)->get();

        if($rq->estado>0) {
            $presupuesto = RqValidacion::where("rq_id", $id)->where("estado", 0)->get();
        }else{
            $presupuesto=null;
        }



        return view ('logistica.requerimiento',compact("area","rq","log","doc","js","cc","files","i","orden","mensaje","mensajeC","unidad","id","presupuesto"));
    }
    public function imprimir($id)
    {
        $area=Area::all();
        $rq=Rq::with("area")->with("detalle")->with("estados")->where("id",$id)->first();
        $log=Log::with("accion")
            ->leftJoin('mensajes', 'log.id', '=', 'mensajes.log_id')
            ->where("requerimiento_id",$id)
            ->orderBy("log.id","desc")
            ->get();

        $mensajeC=Mensaje::where("rq_id",$id)
            ->where("leido",0)
            ->count();

        $mensaje=Mensaje::where("rq_id",$id)
            ->get();


        $doc = array();
        $orden = array();

        //dd($rq->docEntry);
        if(isset($rq->docEntry)) {

            $rq = Rq::with("area")->with("detalle")->with("estados")->where("id", $id)->first();
            $client = new \GuzzleHttp\Client();
            $url = "http://".env('APP_IP').":".env('APP_PORT')."/api/Cotizacion/" . $rq->docEntry."/2";

            $request = $client->get($url);
            $js = json_decode($request->getBody(), true);
            $i = 0;
            $doc = array();
            foreach ($js as $item) {
                $doc[$i]["Code"] = $item["Code"];
                $doc[$i]["Mensaje"] = $item["Mensaje"];
                $i++;
            }
            $client = new \GuzzleHttp\Client();
            $url = "http://".env('APP_IP').":".env('APP_PORT')."/api/Cotizacion/".$rq->docEntry."/2/3";
            $request = $client->get($url);
            $js=json_decode($request->getBody(),true);
            $i=0;

            foreach ($js as $item){
                $orden[$i]["DocEntry"]=$item["DocEntry"];
                $orden[$i]["DocNum"]=$item["DocNum"];
                $orden[$i]["CardName"]=$item["CardName"];
                $orden[$i]["DocDate"]=substr($item["DocDate"],0,10);
                $orden[$i]["Comments"]=$item["Comments"];
                $orden[$i]["DocCur"]=$item["DocCur"];
                $orden[$i]["DocTotal"]=$item["DocTotal"];
                $orden[$i]["TaxDate"]=$item["TaxDate"];
                $orden[$i]["U_EXC_AUTPRE"]=$item["U_EXC_AUTPRE"];
                $orden[$i]["U_EXC_COMPRE"]=$item["U_EXC_COMPRE"];
                $orden[$i]["U_EXC_AUTCOM"]=$item["U_EXC_AUTCOM"];
                $orden[$i]["U_EXC_COMCOM"]=$item["U_EXC_COMCOM"];
                $orden[$i]["U_EXC_AUTGER"]=$item["U_EXC_AUTGER"];
                $orden[$i]["U_EXC_COMGER"]=$item["U_EXC_COMGER"];
                $orden[$i]["U_EXC_AUTGGF"]=$item["U_EXC_AUTGGF"];
                $orden[$i]["U_EXC_COMGGF"]=$item["U_EXC_COMGGF"];
                $i++;
            }
        }
        $cc=Centro::where("Usuario_id",Auth::user()->id)->get();
        $files = Storage::allFiles($rq->area->abreviatura."-".str_pad($rq->id, 5, "0", STR_PAD_LEFT));
        return view ('logistica.impresion',compact("area","rq","log","doc","js","cc","files","i","orden","mensaje","mensajeC"));
    }
    public function index()
    {




            session(['menu' => 'rq']);

            if (\Auth::user()->can("lista.rq.todos")) {
                $rq = Rq::with("area")->with("estados")->with("usuario")->where("estado", ">=", 2)->orderBy("id", "desc")->paginate(25);
            }

            if (\Auth::user()->can('lista.rq.usuario')) {
                $rq = Rq::with("area")->with("estados")->with("usuario")->where("user_id", "=", \Auth::user()->id)->orderBy("id", "desc")->paginate(25);
            }

            if (\Auth::user()->can('lista.rq.area')) {
                $rq = Rq::with("area")->with("estados")->with("usuario")->where("area_id", "=", \Auth::user()->area)->orderBy("id", "desc")->paginate(25);
            }
            if (\Auth::user()->can("lista.rq.todos")) {

                //$area=Area::all();
                if ((Input::get("gerencia") == null)) {
                    $gerencia = "";
                } else {
                    $gerencia = Input::get("gerencia");

                }

                if ($gerencia == "GAC") {


                    if (Auth::user()->sede_id == 2) {

                        $rq = Rq::with("area")
                            ->whereHas('area', function ($query) {
                                $query->where("id", 16);
                            })
                            ->with("estados")
                            ->with("usuario")
                            ->where("estado", ">=", 2)
                            ->orderBy("fecha_aprobacion", "desc")
                            ->paginate(25);
                    } else {
                        $rq = Rq::with("area")
                            ->whereHas('area', function ($query) {
                                $query->where("gerencia", 10)->where("id", "<>", 16);
                            })
                            ->with("estados")
                            ->with("usuario")
                            ->where("estado", ">=", 2)
                            ->orderBy("fecha_aprobacion", "desc")
                            ->paginate(25);


                    }


                } else {
                    if (Auth::user()->sede_id == 2) {


                        $rq = Rq::with("area")
                            ->whereHas('area', function ($query) {
                                $query->where("id", 16);
                            })
                            ->with("estados")
                            ->with("usuario")
                            ->where("estado", ">=", 2)
                            ->orderBy("fecha_aprobacion", "desc")
                            ->paginate(25, ['*'], 1);
                    } else {

                        $rq = Rq::with("area")
                            ->whereHas('area', function ($query) {
                                $query->where("gerencia", 10)->where("id", "<>", 16);
                            })
                            ->with("estados")
                            ->with("usuario")
                            ->where("estado", ">=", 2)
                            ->orderBy("fecha_aprobacion", "desc")
                            ->paginate(25, ['*'], 1);

                    }

                }
                if (Auth::user()->sede_id == 2) {

                    $rq2 = null;
                    $rq3 = null;
                    $rq4 = null;

                } else {
                    if ($gerencia == "GAF") {

                        $rq2 = Rq::with("area")
                            ->whereHas('area', function ($query) {
                                $query->where("gerencia", 20);
                            })
                            ->with("estados")
                            ->with("usuario")
                            ->where("estado", ">=", 2)
                            ->orderBy("fecha_aprobacion", "desc")
                            ->paginate(25);
                    } else {

                        $rq2 = Rq::with("area")
                            ->whereHas('area', function ($query) {
                                $query->where("gerencia", 20);
                            })
                            ->with("estados")
                            ->with("usuario")
                            ->where("estado", ">=", 2)
                            ->orderBy("fecha_aprobacion", "desc")
                            ->paginate(25, ['*'], 1);
                    }


                    if ($gerencia == "GCO") {
                        $rq3 = Rq::with("area")
                            ->whereHas('area', function ($query) {
                                $query->where("gerencia", 30);
                            })
                            ->with("estados")
                            ->with("usuario")
                            ->where("estado", ">=", 2)
                            ->orderBy("fecha_aprobacion", "desc")
                            ->paginate(25);

                    } else {
                        $rq3 = Rq::with("area")
                            ->whereHas('area', function ($query) {
                                $query->where("gerencia", 30);
                            })
                            ->with("estados")
                            ->with("usuario")
                            ->where("estado", ">=", 2)
                            ->orderBy("fecha_aprobacion", "desc")
                            ->paginate(25, ['*'], 1);
                    }


                    if ($gerencia == "CIT") {
                        $rq4 = Rq::with("area")
                            ->whereHas('area', function ($query) {
                                $query->where("gerencia", 99);
                            })
                            ->with("estados")
                            ->with("usuario")
                            ->where("estado", ">=", 2)
                            ->orderBy("fecha_aprobacion", "desc")
                            ->paginate(25);
                    } else {
                        $rq4 = Rq::with("area")
                            ->whereHas('area', function ($query) {
                                $query->where("gerencia", 99);
                            })
                            ->with("estados")
                            ->with("usuario")
                            ->where("estado", ">=", 2)
                            ->orderBy("fecha_aprobacion", "desc")
                            ->paginate(25, ['*'], 1);

                    }
                }


                /* $rq=Rq::with(['area' => function($query) {
                     $query->where('gerencia',20);
                 }])->with("estados")->with("usuario")->where("estado",">=",2)->orderBy("id","desc")->paginate(25);

     */


                if (Auth::user()->sede_id == 2) {

                    $ultimo = Rq::whereIn('estado', array(2, 4, 6, 10, 12))->whereMonth(
                        'fecha_aprobacion', '=', Carbon::now()->month
                    )->whereHas('area', function ($query) {
                        $query->where("id", 16);
                    })->count();

                    $atendidos = Rq::whereIn('estado', array(6, 10, 11, 12))->whereMonth(
                        'fecha_aprobacion', '=', Carbon::now()->month
                    )->whereHas('area', function ($query) {
                        $query->where("id", 16);
                    })->count();

                } else {
                    $ultimo = Rq::whereIn('estado', array(2, 4, 6, 10, 12))->whereMonth(
                        'fecha_aprobacion', '=', Carbon::now()->month
                    )->whereHas('area', function ($query) {
                        $query->where("gerencia", 10)->where("id", "<>", 16);
                    })->count();

                    $atendidos = Rq::whereIn('estado', array(6, 10, 11, 12))->whereMonth(
                        'fecha_aprobacion', '=', Carbon::now()->month
                    )->whereHas('area', function ($query) {
                        $query->where("gerencia", 10)->where("id", "<>", 16);
                    })->count();
                }


                return view('logistica.index2', compact("rq", "rq2", "rq3", "rq4", "area", "ultimo", "atendidos", "gerencia"));

            } else {
                return view('logistica.index', compact("rq"));
            }

    }

    public function lista_articulo(){

        $rq=Input::get("rq");
         if ($rq!="")   {
             $rq = RqDetalle::with("cc")->where("requerimiento_id",$rq)
                 ->get();
            if (!$rq) {
                $this->response['error'] = true;
                $this->response['msg'] = "";
            } else {

                $gastosx = RqDetalle::groupBy('requerimiento_id')
                    ->selectRaw('sum(total_referencial) as monto')->
                    where("requerimiento_id",Input::get("rq"))->first();
                 if ($gastosx != null) {
                    $gastos=$gastosx->monto+0;
                }else{
                    $gastos=0;
                }

                $this->response['error'] = false;
                $this->response['data'] = $rq;
                $this->response['gastos'] ="S/ ".number_format($gastos, 2, '.', ',');
                $this->response['msg'] = "Se realizo la consulta con exito";
            }
            return Response::json($this->response);
        }

    }
    public function show_nuevo_articulo($id){

        $rq=Rq::where("id",$id)->first();
        $detalle=RqDetalle::where("requerimiento_id",$id)->first();
        $tipo=$rq->clase;
        $centro=Centro::where("Usuario_id",Auth::user()->id)->get();
        return view ('logistica.formularios.form_nuevo_articulo',compact("id","tipo","detalle","centro"));

    }
    public function show_edit_articulo($id){
        $detalle=RqDetalle::where("id",$id)->first();

        $rq=Rq::with("area")->where("id",$detalle->requerimiento_id)->first();

        $tipo=$rq->clase;
        $centro=Centro::where("Usuario_id",Auth::user()->id)->get();

        return view ('logistica.formularios.form_edit_articulo',compact("detalle","tipo","centro"));

    }
    public function edit_nuevo_articulo(Request $request)
    {

        $detalle = RqDetalle::where("id", $request->id)->first();


        if ($request->tipo == "I") {

        $detalle->articulo_id = $request->cboArticuloE;
        $detalle->articulo_nombre = $request->nameArticuloX;
        }


        if($request->cantidad) {
            $detalle->requerimiento_id = $request->requerimiento_id;
            $detalle->cantidad = $request->cantidad;
            if ($request->web == "") {
                $detalle->referencia = $url = "";
            } else {
                $detalle->referencia = $url = $request->web;
            }
        }
        $detalle->save();

    }
    public function add_nuevo_articulo(Request $request){


        if($request->cboArticulo<>""){


            $x=explode(" ",$request->cboArticulo);
            if($request->clase=="I"){
                if($x[0]!=$request->idArticulo){
                    $detalle = new RqDetalle();
                    $detalle->articulo_id="NUEVO";
                    $detalle->articulo_nombre="[SIN CODIGO] ".$request->cboArticulo;
                    $detalle->cantidad=$request->cantidad;
                    $detalle->requerimiento_id=$request->requerimiento_id;
                }else{
                    $detalle=RqDetalle::firstOrNew(['articulo_id'=>$request->idArticulo,'requerimiento_id'=>$request->requerimiento_id]);
                    $detalle->articulo_id=$request->idArticulo;
                    $detalle->articulo_nombre=$request->nameArticulo;
                    $detalle->servicio=$request->servicio;
                    $detalle->cantidad= $detalle->cantidad + $request->cantidad;
                }

            }else{

                $detalle = new RqDetalle();
                $detalle->articulo_id=$request->idArticulo;
                $detalle->articulo_nombre=$request->nameArticulo;
                $detalle->servicio=$request->servicio;
                $detalle->cantidad=  $request->cantidad;
                $detalle->requerimiento_id=$request->requerimiento_id;
            }


            $detalle->precio_referencial=$request->precio_referencial;

            if($request->web==""){
                $detalle->referencia=$url = "";
            }else{
                $detalle->referencia=$url = file_get_contents('http://tinyurl.com/api-create.php?url='.$request->web);
            }

            $detalle->unidad=$request->unidad;

            $detalle->save();
            $detalle->total_referencial=$detalle->precio_referencial*$detalle->cantidad;
            $detalle->save();




            $this->response['error'] = false;
            $this->response['msg'] = "Se   registro con exito";
        }else{
            $this->response['error'] = true;
            $this->response['msg'] = "Debe seleccionar un articulo/tipo de servicio";
        }



        return Response::json($this->response);



    }
    public function del_articulo($id){
        RqDetalle::find($id)->delete();
    }
    public function store(Request $request){

        $rq = new Rq();
        $rq->area_id=$request->cboArea;
        $rq->user_id=Auth::user()->id ;
        $rq->sede_id=Auth::user()->sede_id ;
        $rq->fecha=$request->fecharq;
        $rq->clase=$request->tiporq;
        $rq->comentario=$request->comentario;
        $rq->prioridad=$request->prioridad;

        if($request->urgente=="1"){
            $urgente=1;
        }else{
            $urgente=0;
        }

        $rq->urgente=$urgente;

        $rq->mensaje_sap=1;
        $rq->save();
        $log=new Log();
        $log->requerimiento_id=$rq->id;
        $log->accion_id=1;
        $log->user_id=Auth::user()->id;
        $log->save();
        return redirect()->route('rq.show', ['id' => $rq->id]);
    }
    public function upload(Request $request)
    {
          if($request->hasFile('file-es')) {
             $filenamewithextension = $request->file('file-es')[0]->getClientOriginalName();
             $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
             $extension = $request->file('file-es')[0]->getClientOriginalExtension();


              $filename=preg_replace('/[[:^print:]]/', '', $filename);


             $filenametostore = $filename.'.'.$extension;
             Storage::disk('ftp')->put($request->id."/".$filenametostore, fopen($request->file('file-es')[0], 'r+'));
         }
         $output = ['uploaded' => $filenametostore];
         return Response::json($output);

    }
    public function destroy($id)
    {
        if (\Auth::user()->can("eliminar.rq")) {

            $rqq=Rq::where("id", $id)->first();

            $rqq->estado=20;

            $rqq->save();




            //RqDetalle::where("requerimiento_id", $id)->delete();
            $this->response['error'] = false;
             $this->response['msg'] = "Se elimino registro con exito";
        }else{
            $this->response['error'] = true;
            $this->response['msg'] = "No tienes permiso para realizar esta acción";
        }

        return Response::json($this->response);



    }
    public function delete_file(Request $request){

        try{
            Storage::delete($request->file);

            $this->response['error'] = false;

        }catch (\Exception $e){
            $this->response['error'] = true;

        }
        return Response::json($this->response);

    }
    public function download_file(Request $request){

        return Storage::download($request->file);



    }
    public function api_centro(Request $request){

        return Response::json($request);


    }
    public function centro($id){


        $client = new \GuzzleHttp\Client();
        $url = "http://".env('APP_IP').":".env('APP_PORT')."/api/Centro/";
        $request = $client->get($url);
        $js1=json_decode($request->getBody(),true);
        $linea=array();
        $i=0;



         foreach ($js1 as $item1){
            $linea[$i]["Linea"] = $item1["Linea"];
            $linea[$i]["LineaCode"] = $item1["LineaCode"] ;
             $linea[$i]["Sede"] = $item1["Sede"];
             $linea[$i]["SedeCode"] = $item1["SedeCode"] ;
             $linea[$i]["ModalidadCode"] = $item1["ModalidadCode"];
              $linea[$i]["Especialidad"] = $item1["Especialidad"];
             $linea[$i]["EspecialidadCode"] = $item1["EspecialidadCode"] ;
             $linea[$i]["Admision"] = $item1["Admision"];
             $linea[$i]["AdmisionCode"] = $item1["AdmisionCode"] ;
             $linea[$i]["Code"] = $item1["Code"] ;

             $i++;
        }

$centro=Centro::where("Usuario_id",$id)->get();

$usuario=User::where("id",$id)->first();

        return view ('logistica.centro',compact("linea","centro","id","usuario"));

    }
    public function add_centro(Request $request2){




        try{
            $client = new \GuzzleHttp\Client();
            $url = "http://".env('APP_IP').":".env('APP_PORT')."/api/Centro/".$request2->id;
            $request = $client->get($url);
            $js1=json_decode($request->getBody(),true);
            $linea=array();
            $i=0;
            $user=$request2->user;


            foreach ($js1 as $item1){
                $linea["Linea"] = $item1["Linea"];
                $linea["LineaCode"] = $item1["LineaCode"] ;
                $linea["Sede"] = $item1["Sede"];
                $linea["SedeCode"] = $item1["SedeCode"] ;
                $linea["ModalidadCode"] = $item1["ModalidadCode"];
                $linea["Especialidad"] = $item1["Especialidad"];
                $linea["EspecialidadCode"] = $item1["EspecialidadCode"] ;
                $linea["Admision"] = $item1["Admision"];
                $linea["AdmisionCode"] = $item1["AdmisionCode"] ;
                $linea["Usuario_id"] =$user ;

                $i++;
            }


            $centro=Centro::firstOrNew ($linea);

            $centro->save();

            $this->response['error'] = false;

        }catch (\Exception $e){
            $this->response['error'] = true;
            $this->response['mensaje'] = $e->getMessage();

        }
        return Response::json($this->response);


    }
    public function delete_centro(Request $request){

        try{
            Centro::find($request->id)->delete();
            $this->response['error'] = false;

        }catch (\Exception $e){
            $this->response['error'] = true;
            $this->response['mensaje'] = $e->getMessage();

        }
        return Response::json($this->response);
    }
    public function rendir_fila_cc(Request $request)
    {



        $x=RqCC::firstOrNew(['cc_id'=>$request->cc_id,'detalle_id'=>$request->detalle_id]);

        if ($request->tipo=="I"){
            $x->porcentaje=1;
        }else{
            $x->porcentaje=100;
        }
        $x->save();



        if (!$x) {
            $this->response['error'] = true;
            $this->response['msg'] = "";
        } else {
            $this->response['error'] = false;
            $this->response['data'] = $x;
            $this->response['msg'] = "Se realizo la consulta con exito";
        }

        return Response::json($this->response);

    }
    public function update_cc(Request $request)
    {

        $x=  RqCC::where("id",$request->id)->first();

        $x->porcentaje=$request->porcentaje;

        $x->save();
        if (!$x) {
            $this->response['error'] = true;
            $this->response['msg'] = "";
        } else {
            $this->response['error'] = false;
            $this->response['data'] = $x;
            $this->response['msg'] = "Se realizo la consulta con exito";
        }

        return Response::json($this->response);

    }
    public function eliminar_cc(Request $request)
    {

        $x=  RqCC::where("id",$request->id)->delete();


        $this->response['error'] = false;

        $this->response['msg'] = "Se realizo la consulta con exito";

        return Response::json($this->response);

    }
    public function rendir_listado_cc(Request $request)
    {

        $x= RqCC::with("centro")->where("detalle_id",$request->id)->get();
        $cant= RqDetalle::where("id",$request->id)->first();

        $total = RqCC::groupBy('detalle_id')
            ->selectRaw('sum(porcentaje) as porcentaje')->
            where("detalle_id",$request->id)->first();
        //$mov=Movimiento::orderBy("Code")->get();

        if ($x->isEmpty()) {
            $this->response['error'] = true;
            $this->response['msg'] = "0";
        } else {
            $this->response['error'] = false;
            $this->response['data'] = $x;
            $this->response['total'] = $total->porcentaje;
            $this->response['cantidad'] = $cant->cantidad;
          //  $this->response['mov'] = $mov;

            $this->response['msg'] = "Se realizo la consulta con exito";
        }

        return Response::json($this->response);

    }
    public function aplicar_todos(Request $request)
    {

        try{
            $x=RqCC::where('detalle_id',$request->detalle_id)->get();

            $f=RqDetalle::where("requerimiento_id",$request->rq_id)->get();

            foreach ($f as $item){

                RqCC::where("detalle_id",$item->id)->delete();
                foreach ($x as $item2){

                    $x3=RqCC::firstOrNew(['cc_id'=>$item2->cc_id,'detalle_id'=>$item->id]);
                    $x3->porcentaje=$item2->porcentaje;
                    $x3->save();
                }
            }

            $this->response['error'] = false;
            $this->response['msg'] = "Se realizo la consulta con exito";
        }catch (\Exception $e){
            $this->response['error'] = true;
            $this->response['msg'] = $e->getMessage();
        }




        return Response::json($this->response);

    }

}
