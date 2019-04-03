<?php
/**
 * Created by PhpStorm.
 * User: jdani
 * Date: 09/04/2018
 * Time: 03:07 PM
 */

namespace App\Http\Controllers {


    use App\Entidad\Rq;
    use App\Entidad\RqCC;
    use App\Entidad\RqValidacion;
    use App\Entidad\VistaValidacion;
    use Illuminate\Support\Facades\Request;

    class PresupuestoController extends BaseSoapController
    {

        private $service;

        public function margen1(){
            try {
                self::setWsdl('http://localhost:50027/Service1.svc?wsdl');
                $this->service = InstanceSoapClient::init();
                $countryCode = 'DK';
                $vatNumber = '47458714';
                $params = [
                    '   countryCode' => request()->input('countryCode') ? request()->input('countryCode') : $countryCode,
                    'vatNumber'   => request()->input('vatNumber') ? request()->input('vatNumber') : $vatNumber
                ];

                $x=$this->service->margen1($params);

                $response = json_encode($x,true);
                    $x2= json_decode($response,true);


                foreach($x2 as $obj){
                    $id_fruta = $obj;

                }


                $x3= json_decode($id_fruta,true);

                return view ('admin.tabla', compact('x3'));
            }
            catch(\Exception $e) {
                return $e->getMessage();
            }
        }
        public function margen2(){
            try {
                self::setWsdl('http://localhost:50027/Service1.svc?wsdl');
                $this->service = InstanceSoapClient::init();
                $countryCode = 'DK';
                $vatNumber = '47458714';
                $params = [
                    'margen1' => request()->input('margen1') ? request()->input('margen1') : $countryCode,
                    'vatNumber'   => request()->input('vatNumber') ? request()->input('vatNumber') : $vatNumber
                ];

                $x=$this->service->margen2($params);

                $response = json_encode($x,true);
                $x2= json_decode($response,true);


                foreach($x2 as $obj){
                    $id_fruta = $obj;

                }


                $x3= json_decode($id_fruta,true);

                return response()->json($x3);
            }
            catch(\Exception $e) {
                return $e->getMessage();
            }
        }
        public function clima(){
            try {
                self::setWsdl('http://localhost:50027/Service1.svc?wsdl');
                $this->service = InstanceSoapClient::init();

                $cities = $this->service->margen1(['CountryName' => 'Peru']);
                $ciudades = $this->loadXmlStringAsArray($cities->margen1Result);
                dd(json_decode($cities->margen1Result,true));

            }
            catch(\Exception $e) {
                return $e->getMessage();
            }
        }

        public function validar($id){
            //$url = "http://".env('APP_IP').":".env('APP_PORT')."/api/Validacion";
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


            //$x3= json_decode($x3,true);

//            return response()->json($x3);
            $rq=Rq::with("area")->with("detalle")->with("estados")->where("id",$id)->first();
            $rq->presupuesto=$pre;
            $rq->save();


            return view ('logistica.presupuesto2',compact("presupuesto","id","rq"));
        }



    }
}