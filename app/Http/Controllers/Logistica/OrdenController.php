<?php

namespace App\Http\Controllers\Logistica;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrdenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

         $client = new \GuzzleHttp\Client();
        $url = "http://200.60.114.138:802/api/Order/1";
        $request = $client->get($url);
        $js=json_decode($request->getBody(),true);


        $i=0;
        $orden = array();

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


        return view ('orden.index',compact("orden"));

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
        $client = new \GuzzleHttp\Client();
        $url = "http://200.60.114.138:802/api/Order";
        $request = $client->post($url,  [
                'query' => [
                    'id' => $request->DocEntry,
                    'id2' => $request->valor,
                    'id3' => $request->tipo
                ]
            ]
        );


        $js=json_decode($request->getBody(),true);
        if($js[0]["Code"]=="ok"){



        }else{
            $a["estado"]="error";

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
