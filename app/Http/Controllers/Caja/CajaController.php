<?php

namespace App\Http\Controllers\Caja;

use App\Entidad\Area;
use App\Entidad\CajaCC;
use App\Entidad\Centro;
use App\Entidad\Cuenta;
use App\Entidad\Deposito;
use App\Entidad\Estado;
use App\Entidad\Iva;
use App\Entidad\Log;
use App\Entidad\Mensaje;
use App\Entidad\Movilidad;
use App\Entidad\Proveedor;
use App\Entidad\Rendir;
use App\Entidad\RendirCC;
use App\Entidad\RqDetalle;
use App\Entidad\Solicitud;
use App\Entidad\Texto;
use App\Entidad\TextoA;
use App\Entidad\TipoComprobante;
use App\Entidad\VistaResumen;
use App\Exports\BancoExport;
use App\Imports\BancoImport;
use App\Mail\Aprobacion2Email;
use App\Mail\AprobadoEmail;
use App\Mail\EstadoEmail;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class CajaController extends Controller
{
    public $TotalAbonos;
    public $content;

    public function quitar_txt($id){


        $tt= Texto::where("id",$id)->first();




        $rq1 = Solicitud::where("id",$tt->requerimiento_id)->first();
        $rq1->estado=8;
        $rq1->save();

        Texto::find($id)->delete();

        // return response()->json(['done']);

            //'8'
    }

    public function editar_estado($id,$valor,Request $request){




    }
    public function editar_estadoP ($id,$valor,Request $request){

        try{
            $rq1 = Solicitud::where("id",$id)->first();
            $rq1->estado=$valor;
            $codigo=$rq1->area->abreviatura." ".str_pad($rq1->id, 5, "0", STR_PAD_LEFT);

            if($valor==2) {
                $date = Carbon::now();
                $rq1->fecha_aprobacion=$date;
                $usuario = User::where("id", $rq1->user_id)->first();

                if($valor==8) {
                    $date = Carbon::now();
                    $rq1->fecha_aprobacion=$date;
                    $rq1->aprobacion = 1;
                    $rq1->aprobacion_code = '';
                    Mail::to( $usuario->email)->send(new AprobadoEmail($rq1));
                }

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
    public function x(){
        $articulos[0]["clase"]="0";
        $articulos[0]["comentario"]="comentario";
        $url = "http://".env('APP_IP').":".env('APP_PORT')."/api/Asiento";

        $client = new \GuzzleHttp\Client([
            'headers' => [ 'Content-Type' => 'application/json' ]
        ]);


        $response = $client->post($url,
            ['body' => json_encode($articulos)]
        );

        $js = json_decode($response->getBody(), true);

        dd($js);

    }
    public function del_articulo($id){


        $post =RendirCC::where("rendir_id",$id)->first();



        if ($post != null) {
            RendirCC::where("rendir_id",$id)->delete();
        }

        Rendir::find($id)->delete();

    }
    public function sap($id){

        //$int=RqDetalle::where("requerimiento_id",$id)->where("articulo_id","NUEVO")->count();


        $rq=Rendir::with("cc")->where("id",$id)->first();

        $usuario=Solicitud::with("usuario")->where("id",$rq->deposito_id)->first();

        $articulos[0]["clase"]=$rq->monto;
        $articulos[0]["comentario"]= strtoupper($usuario->usuario->apellidos)." - ".$rq->concepto;
        $articulos[0]["RequesterName"]=$rq->serie;
        $articulos[0]["Indicator"]=$rq->tipo;
        $articulos[0]["Caja"]=$rq->tipo;
        $articulos[0]["RequesterDepartment"]=$rq->ruc;
        $articulos[0]["RequriedDate"]=$rq->fecha;

        $articulos[0]["Er"]=$rq->caja;


        $articulos[0]["almacen"]=$rq->fecha_contable;
        $articulos[0]["U_CET_DOCWEB"]="DOC-".str_pad($rq->id, 5, "0", STR_PAD_LEFT);
            $rqd = Rendir::with(['cc' => function($query) {
                $query->with('centro');
            }])->with("iva")->where("id",$id)->get();

             $i=0;
            foreach ($rqd  as $item){
                foreach ($item->cc  as $item2) {
                    $articulos[0]["Detalle"][$i]["ItemCode"] = $item->servicio_id;
                    $articulos[0]["Detalle"][$i]["cantidad"] = 1;
                    $articulos[0]["Detalle"][$i]["U_CET_SERPORCENTAJE"] = $item2->porcentaje;
                    $articulos[0]["Detalle"][$i]["LineaCode"] = $item2->centro->LineaCode;
                    $articulos[0]["Detalle"][$i]["SedeCode"] = $item2->centro->SedeCode;
                    $articulos[0]["Detalle"][$i]["ModalidadCode"] =$item2->centro->ModalidadCode;
                    $articulos[0]["Detalle"][$i]["EspecialidadCode"] = $item2->centro->EspecialidadCode;
                    $articulos[0]["Detalle"][$i]["AdmisionCode"] =$item2->centro->AdmisionCode;
                    $articulos[0]["Detalle"][$i]["Iva"] =$rq->iva->codigo;

                    $i++;
                }
            }

            //dd($articulos);
            $url = "http://".env('APP_IP').":".env('APP_PORT')."/api/Factura";

            //$url = "http://localhost:29398/api/Factura";

            $client = new \GuzzleHttp\Client([
                'headers' => [ 'Content-Type' => 'application/json' ]
            ]);


            $response = $client->post($url,
                ['body' => json_encode($articulos)]
            );

            $js = json_decode($response->getBody(), true);


            if($js[0]["Code"]=="Ok"){
                $porciones = explode("-", $js[0]["Mensaje"]);
                //$rq1 = Rq::with("usuario")->with("area")->with("detalle")->with("estados")->where("id", $id)->first();

                $rq1=Rendir::where("id",$id)->first();
                $rq1->sap = 2;
                $rq1->docEntry = $porciones[0];
                $rq1->docNum = $porciones[1];
                $rq1->save();
                $a["estado"]="ok";

                /*
                $log=new Log();
                $log->requerimiento_id=$id;
                $log->accion_id=5;
                $log->detalle="Solicitud ".$porciones[1];
                $log->user_id=Auth::user()->id;
                $log->save();
                 */

            }else{
                $a["estado"]="error";

            }


        return Response::json($a);
    }
    public function sap_asiento($id){

        //$int=RqDetalle::where("requerimiento_id",$id)->where("articulo_id","NUEVO")->count();


        $rq=Rendir::with("cc")->where("id",$id)->first();

        $articulos[0]["clase"]=$rq->monto;
        $articulos[0]["comentario"]=$rq->concepto;
        $articulos[0]["RequesterName"]=$rq->serie;
        $articulos[0]["Indicator"]=$rq->tipo;
        $articulos[0]["Caja"]=$rq->tipo;
        $articulos[0]["RequesterDepartment"]=$rq->ruc;
        $articulos[0]["RequriedDate"]=$rq->fecha;
        $articulos[0]["almacen"]=$rq->fecha_contable;
        $articulos[0]["U_CET_DOCWEB"]="DOC-".str_pad($rq->id, 5, "0", STR_PAD_LEFT);
        $rqd = Rendir::with(['cc' => function($query) {
            $query->with('centro');
        }])->with("iva")->where("id",$id)->get();

        $i=0;
        foreach ($rqd  as $item){
            foreach ($item->cc  as $item2) {
                $articulos[0]["Detalle"][$i]["ItemCode"] = $item->servicio_id;
                $articulos[0]["Detalle"][$i]["cantidad"] = 1;
                $articulos[0]["Detalle"][$i]["U_CET_SERPORCENTAJE"] = $item2->porcentaje;
                $articulos[0]["Detalle"][$i]["LineaCode"] = $item2->centro->LineaCode;
                $articulos[0]["Detalle"][$i]["SedeCode"] = $item2->centro->SedeCode;
                $articulos[0]["Detalle"][$i]["ModalidadCode"] =$item2->centro->ModalidadCode;
                $articulos[0]["Detalle"][$i]["EspecialidadCode"] = $item2->centro->EspecialidadCode;
                $articulos[0]["Detalle"][$i]["AdmisionCode"] =$item2->centro->AdmisionCode;
                $articulos[0]["Detalle"][$i]["Iva"] =$rq->iva->codigo;

                $i++;
            }
        }

        //dd($articulos);
        $url = "http://".env('APP_IP').":".env('APP_PORT')."/api/Factura";

       // $url = "http://localhost:29398/api/Factura";

        $client = new \GuzzleHttp\Client([
            'headers' => [ 'Content-Type' => 'application/json' ]
        ]);


        $response = $client->post($url,
            ['body' => json_encode($articulos)]
        );

        $js = json_decode($response->getBody(), true);


        if($js[0]["Code"]=="Ok"){
            $porciones = explode("-", $js[0]["Mensaje"]);
            //$rq1 = Rq::with("usuario")->with("area")->with("detalle")->with("estados")->where("id", $id)->first();

            $rq1=Rendir::where("id",$id)->first();
            $rq1->sap = 2;
            $rq1->docEntry = $porciones[0];
            $rq1->docNum = $porciones[1];
            $rq1->save();
            $a["estado"]="ok";

            /*
            $log=new Log();
            $log->requerimiento_id=$id;
            $log->accion_id=5;
            $log->detalle="Solicitud ".$porciones[1];
            $log->user_id=Auth::user()->id;
            $log->save();
             */

        }else{
            $a["estado"]="error";

        }


        return Response::json($a);
    }
    public function index()
    {

        session(['menu' => 'caja']);


         if (\Auth::user()->can("tesoreria")) {
            return redirect()->route('caja.tesoreria' );
        }



        if(\Auth::user()->can('lista.rq.usuario')){
            $rq=Solicitud::with("area")->with("estados")->with("usuario")->orWhere("email","=",\Auth::user()->email)->orWhere("user_id","=",\Auth::user()->id)->orderBy("created_at","desc")->paginate(20);
        }


        if(\Auth::user()->can('lista.rq.area')){
            $rq=Solicitud::with("area")->with("estados")->with("usuario")->orWhere("email","=",\Auth::user()->email)->orWhere("area_id","=",\Auth::user()->area)->orderBy("created_at","desc")->paginate(20);
        }
        if(\Auth::user()->tipo==2){

            $rq=Solicitud::with("area")->with("estados")->with("usuario")->orWhere("email","=",\Auth::user()->email)->orderBy("created_at","desc")->paginate(20);
        }


        if((\Auth::user()->can('contabilidad'))){

            if((\Auth::user()->can('contabilidad'))) {
                $rq=Solicitud::with("area")->with("estados")->with("usuario")->orWhere("user_id","=",\Auth::user()->id)->orWhere("estado",14)->orderBy("created_at","desc")->paginate(20);

            }
                else{
                    $rq=Solicitud::with("area")->with("estados")->with("usuario")->orWhere("user_id","=",\Auth::user()->id)->orWhere("estado",14)->orderBy("created_at","desc")->paginate(20);

                }




        }

        if((\Auth::user()->can('caja_administrador'))){

            $rq=Solicitud::with("area")->with("estados")->with("usuario")->orderBy("created_at","desc")->paginate(20);

        }




        return view ('caja.index',compact("rq"));
    }
    public function tesoreria()
    {
        if (\Auth::user()->can("tesoreria")) {
            $rq=Solicitud::with("area")->with("estados")->with("usuario")->where("tipo","=","VIA")->where("estado","=",8)->orderBy("fecha_aprobacion","desc")->get();
        }

        $cuentas=Cuenta::where("estado",1)->get();




        return view ('caja.tesoreria',compact("rq","cuentas"));
    }
    public function listado_txt($id)
    {


       // dd($request->all());
        $cuenta=Cuenta::where("id",$id)->first();


        if (\Auth::user()->can("tesoreria")) {
            $rq=Texto::with("cuenta")->with("rq")->where("cuenta_id","=",$id)->where("estado","=",0)->get();



            $texto=TextoA::with("usuario")->where("cuenta_id","=",$id)->get();



         }else{
            $rq=array();
            $texto=array();
        }
        return view ('caja.listado_txt',compact("rq","texto","cuenta"));


    }

    public function ope($id,Request $request)
    {


        // dd($request->all());
        $cuenta=TextoA::where("id",$id)->first();

        $cuenta->ope=$request->ope;
        $cuenta->estado=2;

        $cuenta->save();



    }

    public function edit_txt($id)
    {





        if (\Auth::user()->can("tesoreria")) {
            $rq=Texto::with("cuenta")->with("rq")->where("txt","=",$id)->get();


            $cuenta=TextoA::where("id","=",$id)->first();


        }else{
            $rq=array();
            $cuenta=array();
        }
        return view ('caja.edit_txt',compact("rq","cuenta","id"));


    }

    public function descargar($id){
      //  return (new BancoExport($id))->download('pagos_efectuados.xlsx');

        return Excel::download(new BancoExport($id), 'pagos_efectuados.xlsx');

    }


    public function upload(Request $request)
    {




            if($request->hasFile('file-es')) {
                $filenamewithextension = $request->file('file-es')[0]->getClientOriginalName();
                $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
                $extension = $request->file('file-es')[0]->getClientOriginalExtension();


                $filename=preg_replace('/[[:^print:]]/', '', $filename);


                $filenametostore = $filename.'.'.$extension;
                Storage::disk('ftp')->put("dinero/".$request->id."/".$filenametostore, fopen($request->file('file-es')[0],"r"));
            }
            $output = ['uploaded' => $filenametostore];


        Excel::import(new BancoImport, $request->file('file-es')[0]);
        $texto=TextoA::where("id",$request->id)->first();
        $texto->estado=1;
        $texto->fecha=$request->fecha;
        $texto->save();


            return Response::json($output);

    }

    public function create()
    {
        $area=Area::where("id",Auth::user()->area)->get();
        $cc=Centro::where("Usuario_id",Auth::user()->id)
            ->orderBy("LineaCode")
            ->orderBy("EspecialidadCode")
            ->orderBy("AdmisionCode")
            ->get();
        $length=10;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $id= $randomString;
        $date = Carbon::now();
        $endDate = $date->addDay();
        $endDate = $endDate->format('d-m-Y');

        return view ('caja.formularios.nuevo',compact("area","cc","endDate","id"));

    }
    public function aprobacion($aprobacion_code,Request $request)
    {

    /*    try{

            DB::beginTransaction();
*/
            $rq1=Solicitud::with("area")->with("estados")->with("usuario")->where('aprobacion_code', $aprobacion_code)->where("id",$request->id_e)->first();

            if($rq1){

                $usuario = User::where("id", $rq1->user_id)->first();
                $rq1->estado=$request->estado_e;
                $codigo=$rq1->area->abreviatura." ".str_pad($rq1->id, 5, "0", STR_PAD_LEFT);

                if($request->estado_e==8) {
                    $date = Carbon::now();
                    $rq1->fecha_aprobacion=$date;
                    $rq1->aprobacion = 1;
                    $rq1->aprobacion_code = '';
                    Mail::to( $usuario->email)->send(new AprobadoEmail($rq1));
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
                $mensaje->user_id=$usuario->jefe;
                $mensaje->rq_id=$request->id;
                $mensaje->log_id=$log->id;

                $mensaje->save();

                $estado=$request->estado_e;
                $id=$request->id_e;
                 return view ('caja.estado',compact("estado","id"));


            }else{

                return abort('403');
            }





    }
    public function mensaje_jefe(Request $request)
    {
        try{
            $rq1 = Solicitud::where("id",$request->id)->first();
            $rq1->mensaje_jefe=$request->mensaje;
            $rq1->save();

            $usuario = User::where("id", $rq1->user_id)->first();
            $jefe = User::where("id", $usuario->jefe)->first();

            $log=new Log();
            $log->caja_id=$rq1->id;
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
    public function rendir_listado(Request $request)
    {

        $x= Rendir::with("cc")
            ->with("tipo")->with("proveedor")
            ->where("deposito_id",$request->id)
            ->get();

        $gastosx = Rendir::groupBy('deposito_id')
            ->selectRaw('sum(monto) as monto')->
            where("deposito_id",$request->id)->first();

        $totalx =Solicitud::where("id",$request->id)->first();


        if ($gastosx != null) {
            $gastos=$gastosx->monto+0;
            $total=$totalx->monto;


            $devolucion=$total-$gastos;

            if($devolucion<0){
                $devolucion=0;
            }

        }else{
            $gastos=0;
            $total=$totalx->monto;
            $devolucion=0;
        }






        if($gastos>$total){
            $reembolso=$gastos-$total;
        }else{
            $reembolso=0;
        }

        if (!$x) {
            $this->response['error'] = true;
            $this->response['msg'] = "";
        } else {
            $this->response['error'] = false;
            $this->response['data'] = $x;


            $this->response['total'] =  "S/ ".number_format($total, 2, '.', ',');
            $this->response['gastos'] =  "S/ ".number_format($gastos, 2, '.', ',');
            $this->response['devolucion'] =  "S/ ".number_format($devolucion, 2, '.', ',');
            $this->response['reembolso'] =  "S/ ".number_format($reembolso, 2, '.', ',');

            $this->response['msg'] = "Se realizo la consulta con exito";
        }

        return Response::json($this->response);





    }
    public function rendir_fila(Request $request)
    {

        $x= new Rendir();
        $x->fecha=$request->fecha;
        $x->fecha_contable=$request->fecha;

        $x->tipo=$request->tipo;
        $x->serie=$request->serie;

        if($x->tipo=="MV"){


            $deposito=Solicitud::where("id",$request->deposito_id)->first();

            $x->ruc=$deposito->dni;

            $x->proveedor=$deposito->nombre;
            $x->concepto=substr ($deposito->descripcion,0,100);

        }else{
            $x->ruc=$request->ruc;
            $x->proveedor=$request->proveedor;
            $x->concepto=$request->concepto;

            $proveedor=Proveedor::firstOrNew(['ruc' => $request->ruc]) ;

            $proveedor->ruc=$request->ruc;




            $proveedor->razon_social=$request->proveedor;
            $proveedor->save();




        }
        $x->impuesto=1;

        $x->centro=$request->centro;
        $x->monto=$request->monto;
        $x->deposito_id=$request->deposito_id;
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
    public function movilidad_fila(Request $request)
    {

        $x= new Movilidad();
         $x->detalle_id=$request->movilidad;
        $x->fecha=$request->fecha_movilidad;
        $x->concepto=$request->motivo_movilidad;
        $x->monto=$request->monto_movilidad;
        $x->save();

        $gastosx = Movilidad::groupBy('detalle_id')
            ->selectRaw('sum(monto) as monto')->
            where("detalle_id",$request->movilidad)->first();


        $r=Rendir::where("id",$request->movilidad)->first();
        $r->monto=$gastosx->monto;
        $r->save();

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
    public function movilidad_listado(Request $request)
    {

        $x= Movilidad::where("detalle_id",$request->id)->get();
        $gastosx = Movilidad::groupBy('detalle_id')
            ->selectRaw('sum(monto) as monto')->
            where("detalle_id",$request->id)->first();

        if ($gastosx != null) {
            $gastos=$gastosx->monto+0;
        }else{
            $gastos=0;
        }

        if (!$x) {
            $this->response['error'] = true;
            $this->response['msg'] = "";
        } else {
            $this->response['error'] = false;
            $this->response['data'] = $x;
            $this->response['gastos'] =  "S/ ".number_format($gastos, 2, '.', ',');
            $this->response['msg'] = "Se realizo la consulta con exito";
        }
        return Response::json($this->response);
    }
    public function rendicion(Request $request)
    {

        try{
             $f=Rendir::where("deposito_id",$request->deposito_id)->get();
            $fx=Solicitud::where("id",$request->deposito_id)->first();
            $fx->caja=$request->codigo;
            $fx->save();

            foreach ($f as $item){

               $item->caja=$request->codigo;
               $item->save();
            }

            $this->response['error'] = false;
            $this->response['msg'] = "Se realizo la consulta con exito";
        }catch (\Exception $e){
            $this->response['error'] = true;
            $this->response['msg'] = $e->getMessage();
        }




        return Response::json($this->response);

    }
    public function aplicar_todos(Request $request)

    {

    try{
    $x=RendirCC::where('rendir_id',$request->rendir_id)->get();
    $f=Rendir::where("deposito_id",$request->deposito_id)->get();

    foreach ($f as $item){

        RendirCC::where("rendir_id",$item->id)->delete();
            foreach ($x as $item2){
                $x3=RendirCC::firstOrNew(['cc_id'=>$item2->cc_id,'rendir_id'=>$item->id]);
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
    public function rendir_fila_cc(Request $request)
    {


        $x=RendirCC::firstOrNew(['cc_id'=>$request->cc_id,'rendir_id'=>$request->rendir_id]);
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

        $x=  RendirCC::where("id",$request->id)->first();

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

        $x=  RendirCC::where("id",$request->id)->delete();


            $this->response['error'] = false;

            $this->response['msg'] = "Se realizo la consulta con exito";

        return Response::json($this->response);

    }
    public function movilidad_eliminar(Request $request)
    {


        $r1=  Movilidad::where("id",$request->id)->first();

        $x=  Movilidad::where("id",$request->id)->delete();

        $gastosx = Movilidad::groupBy('detalle_id')
            ->selectRaw('sum(monto) as monto')->
            where("detalle_id",$r1->detalle_id)->first();


        $r=Rendir::where("id",$r1->detalle_id)->first();
        $r->monto=$gastosx->monto;
        $r->save();


        $this->response['error'] = false;

        $this->response['msg'] = "Se realizo la consulta con exito";

        return Response::json($this->response);

    }
    public function rendir_listado_cc(Request $request)
    {

        $x= RendirCC::with("centro")->where("rendir_id",$request->id)->get();

        $total = RendirCC::groupBy('rendir_id')
            ->selectRaw('sum(porcentaje) as porcentaje')->
            where("rendir_id",$request->id)->first();

        if ($x->isEmpty()) {
            $this->response['error'] = true;
            $this->response['msg'] = "0";
        } else {
            $this->response['error'] = false;
            $this->response['data'] = $x;
            $this->response['total'] = $total->porcentaje;

            $this->response['msg'] = "Se realizo la consulta con exito";
        }

        return Response::json($this->response);

    }
    public function deposito(Request $request)
    {

                $x= new Deposito();
                $x->dinero_id=$request->id_e;
                $x->dni=$request->dni;
                $x->nombre=$request->nombre;
                $x->cargo=$request->cargo;
                $x->banco=$request->t_banco;
                $x->cta=$request->cta;
                $x->monto=$request->monto;
                $x->fecha_deposito=$request->fecha_deposito;
                $x->operacion=$request->operacion;
                $x->save();


                $r=Solicitud::where("id",$request->id_e)->first();
                $r->estado=9;
                $r->save();

                $u=User::where("id",$r->user_id)->first();

                Mail::to( $u->email)->send(new AprobadoEmail($r));



        return redirect()->route('caja.show', ['id' => $request->id_e]);


    }
    public function store(Request $request)
    {

        $x= new Solicitud();
        $x->fecha_necesaria=$request->fecharq;
        $x->tipo=$request->tiporq;
        $x->prioridad=$request->prioridad;
        $x->destino=$request->destino;
        $x->estadia=$request->estadia;
        $x->centro_id=$request->centro;
        $x->descripcion=$request->descripcion;
        $x->dni=$request->dni;
        $x->nombre=$request->nombre;
        $x->cargo=$request->cargo;
        $x->banco=$request->t_banco;

        $x->monto=str_replace(",","",$request->monto);


        $x->email=$request->b_email;



        $bus=User::where('email',$request->b_email)->where("tipo",0)->count();

        if($bus==0){
            $user=User::firstOrNew(['email' => $request->b_email]);
            $user->name=strtoupper($request->nombre);
            $user->password=bcrypt($request->dni);
            $user->email=$request->b_email;
            $user->tipo=2;
            $user->save();

        }



        $x->cta=str_replace(" ","",str_replace("-","",$request->cta));
        $x->area_id=$request->cboArea;
        $x->estado=1;
        $x->user_id=Auth::user()->id ;
        $x->sede_id=Auth::user()->sede_id ;

         $code = str_random(25);
        $x->aprobacion_code=$code;
        $x->save();


        $cc=CajaCC::where("rendir_id",$request->id_temp)->get();

        foreach ($cc as $it){

            $it->rendir_id=$x->id;
            $it->save();
        }






        $xx=Solicitud::with("area")->with("estados")->with("usuario")->where("id",$x->id)->first();
         $jefe=User::where("id",$xx->usuario->jefe)->first();
        Mail::to( $jefe->email)->send(new EstadoEmail($xx));


        return redirect()->route('caja.show', ['id' => $x->id]);
    }
    public function send($id)
    {

        $xx=Solicitud::with("area")->with("estados")->with("usuario")->where("id",$id)->first();

        $jefe=User::where("id",$xx->usuario->jefe)->first();

        //Mail::to( $jefe->email)->send(new Aprobacion2Email($xx));

        $xx->estado=14;
        $xx->save();

        return redirect()->route('caja.show', ['id' => $xx->id]);
    }
    public function show($id)
    {
        $area=Area::where("id",Auth::user()->area)->get();
        $total = Rendir::groupBy('deposito_id')
            ->selectRaw('FORMAT(sum(monto),2) as monto')
            ->where("deposito_id",$id)->first();





        $rq=Solicitud::with("area")->with("estados")->where("id",$id)->first();


        $contar=Centro::where("Usuario_id",Auth::user()->id)->count();


        if($contar==0){
            $cc=Centro::where("Usuario_id",$rq->user_id)->get();

        }else{

            $cc=Centro::where("Usuario_id",Auth::user()->id)->get();

        }








        $tip=TipoComprobante::all();
        $servicios=array();
        $detalle="";
        $iva="";

        if($rq->estado==14){
             $client = new \GuzzleHttp\Client();
             $url = "http://".env('APP_IP').":".env('APP_PORT')."/api/Item/i/X/x55";
             $request = $client->get($url);
             $js1=json_decode($request->getBody(),true);
             $servicios=array();
             $i=0;
             foreach ($js1 as $item1){
                 $servicios[$i]["ItemCode"] = $item1["ItemCode"];
                 $servicios[$i]["ItemName"] = $item1["ItemName"] ;
                 $i++;
             }
             $detalle= Rendir::with("tipo")->where("deposito_id",$id)->get();
             $iva= Iva::all();
        }
        return view ('caja.show',compact("rq","cc","area" ,"tip","total","servicios","detalle","iva"));
    }
    public function edit($id)
    {
        //
    }
    public function conta(Request $request)
    {

        $detalles=Rendir::where("id",$request->id)->first();

        if (!$detalles) {
            $this->response['error'] = true;
            $this->response['msg'] = "0";
        } else {
            $this->response['error'] = false;
            $this->response['data'] = $detalles;

            $this->response['msg'] = "Se realizo la consulta con exito";
        }

        return Response::json($this->response);

    }
    public function update(Request $request, $id)
    {
         $rendir=Rendir::where("id",$id)->first();
        $rendir->tipo=$request->tipo;
        $rendir->serie=$request->serie;
        $rendir->monto=$request->total;
        $rendir->concepto=$request->concepto;
        $rendir->fecha_contable=$request->fecha_contable;
        $rendir->fecha=$request->fecha;
        $rendir->proveedor=$request->proveedor;
        $rendir->ruc=$request->ruc;

        $rendir->servicio_id=$request->servicio_id;
        $rendir->impuesto=$request->impuesto;
        $rendir->sap=$request->sap;
        $rendir->save();
    }

    public function pdf($id){

        $rq=Solicitud::with("usuario")->with("area")->with("estados")->where("id",$id)->first();



        $detalle = Rendir::with("cc")
            ->with("tipo")->with("proveedor")
            ->where("deposito_id",$id)
            ->get()->toArray();


        $gastosx = Rendir::groupBy('deposito_id')
            ->selectRaw('sum(monto) as monto')->
            where("deposito_id",$id)->first();

        $totalx =Solicitud::where("id",$id)->first();


        if ($gastosx != null) {
            $gastos=$gastosx->monto+0;
            $total=$totalx->monto;


            $devolucion=$total-$gastos;

            if($devolucion<0){
                $devolucion=0;
            }

        }else{
            $gastos=0;
            $total=$totalx->monto;
            $devolucion=0;
        }






        if($gastos>$total){
            $reembolso=$gastos-$total;
        }else{
            $reembolso=0;
        }

        $total =  "S/ ".number_format($total, 2, '.', ',');
        $gastos =  "S/ ".number_format($gastos, 2, '.', ',');
        $devolucion =  "S/ ".number_format($devolucion, 2, '.', ',');
        $reembolso =  "S/ ".number_format($reembolso, 2, '.', ',');




         $view = view("caja.pdf.informe", compact('rq','detalle','total','gastos','devolucion','reembolso'))->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('informe');
    }


    public function destroy($id)
    {

        if (\Auth::user()->can("eliminar.caja")) {

            $rqq=Solicitud::where("id", $id)->first();

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

    public function banco(Request $request){
        $services = $request->input('caja');

        if(isset($services)){
            foreach($services as $service){

                $x=Texto::firstOrNew(['requerimiento_id' => $service,'cuenta_id'=>$request->cuenta]);
                $x->save();

                $s=Solicitud::where("id",$service)->first();

                $s->estado=22;

                $s->save();
            }


        }


        return redirect()->route('caja.tesoreria');



    }
    public function caja_listado_cc(Request $request)
    {

        $x= CajaCC::with("centro")->where("rendir_id",$request->id)->get();

        $total = CajaCC::groupBy('rendir_id')
            ->selectRaw('sum(porcentaje) as porcentaje')->
            where("rendir_id",$request->id)->first();

        if ($x->isEmpty()) {
            $this->response['error'] = true;
            $this->response['msg'] = "0";
        } else {
            $this->response['error'] = false;
            $this->response['data'] = $x;
            $this->response['total'] = $total->porcentaje;

            $this->response['msg'] = "Se realizo la consulta con exito";
        }

        return Response::json($this->response);

    }
    public function caja_fila_cc(Request $request)
    {


        $x=CajaCC::firstOrNew(['cc_id'=>$request->cc_id,'rendir_id'=>$request->rendir_id]);
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
    public function caja_update_cc(Request $request)
    {

        $x=  CajaCC::where("id",$request->id)->first();

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
    public function caja_eliminar_cc(Request $request)
    {

        $x=  CajaCC::where("id",$request->id)->delete();


        $this->response['error'] = false;

        $this->response['msg'] = "Se realizo la consulta con exito";

        return Response::json($this->response);

    }
    public function sanear_string($string)
    {

        $string = trim($string);

        $string = str_replace(
            array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
            array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
            $string
        );

        $string = str_replace(
            array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
            array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
            $string
        );

        $string = str_replace(
            array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
            array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
            $string
        );

        $string = str_replace(
            array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
            array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
            $string
        );

        $string = str_replace(
            array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
            array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
            $string
        );

        $string = str_replace(
            array('ñ', 'Ñ', 'ç', 'Ç'),
            array('n', 'N', 'c', 'C',),
            $string
        );

        //Esta parte se encarga de eliminar cualquier caracter extraño
        $string = str_replace(
            array("\\", "¨", "º", "-", "~",
                "#", "@", "|", "!", "\"",
                "·", "$", "%", "/",
                "(", ")", "?", "'", "¡",
                "¿", "[", "^", "`", "]",
                "+", "}", "{", "¨", "´",
                ">", "< ", ";", ",", ":",
                "."),
            '',
            $string
        );


        return $string;
    }
    public function generar_txt()
    {
            $codigo=Input::get('id');
            $LongitudCorrectaCabecera = 0;
            $LineaCabecera = "";
            $hoy = date("Ymd");
            $cantidad=Input::get("cantidad");
            $totalabonado=Input::get("suma");
            $concepto=Input::get('descripcion');
            $columnaA = "C";
            $columnaB = $cantidad;
            $columnaC = $hoy;
            $columnaD = "C";
            $columnaE = Input::get('cuenta');
            $columnaF = number_format($totalabonado,2,'.','');
            $columnaG = $concepto;
            $campo1 = 1;
            $campo2 = str_pad($columnaB, 6, "0", STR_PAD_LEFT);
            $campo3 = $columnaC;
            $campo4 = $columnaD;
            $campo5="0001";
            $campo6 = str_pad($columnaE, 20, " ");//PadRight(columnaE, Espacio, 20)
            $campo6=str_replace(" "," ",$campo6 );
            $campo7 = str_pad($columnaF, 17, "0", STR_PAD_LEFT);//PadLeft(columnaF, Cero, 17)
            $campo8 = str_pad($columnaG, 40, " ");//PadRight(columnaG, Espacio, 40)
            $campo8=str_replace(" "," ",$campo8 );
            $campo9 = "N";
            $TotalAbonos = 0;
            $NroCuentaCargo = $columnaE;
            $detalles=VistaResumen::where("cuenta_id","=",$codigo)->where("estado","=",0)->get();
            $TotalCargo = floatval(substr($NroCuentaCargo, 3, strlen($NroCuentaCargo) - 3));
            $this->ix=0;
            $detalles->each(function($registro)
            {
                if($registro->tipoc=="B"){
                    $this->TotalAbonos = $this->TotalAbonos + floatval(substr($registro->nrocuenta, 10, (strlen($registro->nrocuenta)-10)));
                }else{
                    $this->TotalAbonos= $this->TotalAbonos+floatval(substr($registro->nrocuenta, 3, (strlen($registro->nrocuenta)-3)));
                }

            });

            $TotalControl = $TotalCargo + $this->TotalAbonos ;
            $TotalControl=number_format($TotalControl ,0, "" ,"");
            $TotalControl=str_pad($TotalControl, 15, "0", STR_PAD_LEFT);
            $texto=$campo1.$campo2.$campo3.$campo4.$campo5.$campo6.$campo7.$campo8.$campo9.$TotalControl;
            $this->content= $texto.chr(13).chr(10);


            $detalles->each(function($registro)   {

                $campo1 = "2";




                $campo2 = $registro->tipoc;



                $campo3 = str_pad($registro->nrocuenta, 20, "*");
                $campo4 = "1";
                $campo5 = $registro->tipo;
                $campo6 = str_pad($registro->ruc, 12, "*");
                $campo7="***";
                $campo8 =  str_pad(trim($this->sanear_string($registro->nombre)), 75, "*");
                $campo9 = str_pad("Referencia Beneficiario ".$registro->ruc, 40,"*");
                $campo10 = str_pad("Ref Solicitud #".$registro->documento, 20,"*");
                $campo11 = $registro->abrv;
                $campo12 = str_pad(number_format($registro->monto,2,'.',''), 17,"0", STR_PAD_LEFT);
                $campo13 = "S";
                $texto=$campo1.$campo2.$campo3.$campo4.$campo5.$campo6.$campo7.$campo8.$campo9.$campo10.$campo11.$campo12.$campo13;
                $texto=str_replace("*"," ",$texto );

                $this->content= $this->content.$texto.chr(13).chr(10);

                $filas=VistaResumen::where('cuenta_id','=',$registro->cuenta_id)->where('documento','=',$registro->documento)->where('ruc','=',$registro->ruc)->where('estado','=',0)->get();
                 $filas->each(function($registro1)   {
                    $campo1x = "3";
                    $campo2x = "D";
                    $campo3x = str_pad($registro1->documento, 15, "0", STR_PAD_LEFT);
                    $campo4x = str_pad(number_format($registro1->monto,2,'.',''), 17, "0", STR_PAD_LEFT);
                    $texto=$campo1x.$campo2x.$campo3x.$campo4x;
                    $texto=str_replace("*"," ",$texto );
                    $texto=str_replace("-","0",$texto );
                     $this->content= $this->content.$texto.chr(13).chr(10);
                });
            });




            // file name that will be used in the download

        $now = Carbon::now();


        $fileName = $concepto." ".$now.".txt";

        // use headers in order to generate the download


        $archivo = new TextoA;
        $archivo->nombre = $fileName;
        $archivo->user_id = Auth::id();
        $archivo->cuenta_id = $codigo;
        $archivo->save();




        $detalles->each(function($registro) use ($archivo) {

            $x=Texto::where("id",$registro->id)->first();
            $x->estado=1;
            $x->txt=$archivo->id;
            $x->save();

        });
        $headers = [
            'Content-type' => 'text/plain',
            'Content-Disposition' => sprintf('attachment; filename="%s"', $fileName)
        ];

        // make a response, with the content, a 200 response code and the headers
        return Response::make($this->content, 200, $headers);





    }

}
