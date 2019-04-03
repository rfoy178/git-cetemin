@extends('layout.app4')
@section('cabecera')

    <style type='text/css'>
        td{
            font-family:sans-serif;
            font-size:11px !important;
        }
    </style>
    @endsection
@section('main-content')
    <script language="javascript">
        function remplazar(x){

            var res = x.replace(/\s/g, "");
            var res2 = res.replace("+", "");
            return res2;
        }

        function redondear(num){
            return Math.round(num * 100) / 100
        }
        function cargar(nivel,id1="",id2="",id3="",id4="",id5="",id6="",id7=""){
            var url;


            switch(nivel) {
                case 2:
                    url="http://localhost:29398/api/Linea/" +remplazar(id1);
                    $.get(url)
                        .done(function (data) {

                            var i = 0;
                            var tr = "";
                            var cc=[];

                            $.each(data, function (key, item) {
                                i++;
                                tr += '<tr class="N2' + remplazar(item.Margen_M) + '">';
                                tr += '<td>  </td>';
                                tr += '<td style="min-width: 30px"> </td>';
                                tr += '<td colspan="7"> ' + item.Margen_M + ' </td>';
                                tr += '<td>' + redondear(item.LIM_EXC_REAL_M) + '</td>';
                                tr += '<td>' + redondear(item.LIM_EXC_MONTO_M) + '</td>';
                                tr += '<td>--- </td>';
                                tr += '<td>' + redondear(item.AQP_EXC_REAL_M) + '</td>';
                                tr += '<td>' + redondear(item.AQP_EXC_MONTO_M) + '</td>';
                                tr += '<td>--- </td>';
                                tr += '<td>' + redondear(item.EXC_REAL_M) + '</td>';
                                tr += '<td>' + redondear(item.U_EXC_MONTO_M) + '</td>';
                                tr += '<td>--- </td>';
                                tr += '<td>';
                                tr += '<button data-title2="' + remplazar(item.Margen_M) + '" data-nivel="3" data-title="' + remplazar(id1) + '">[+]</button> </td>';
                                tr += '</tr>';
                                cc[i] = remplazar(item.Margen_M);
                            });

                            $("." + remplazar(id1)).after(tr);

                            for (i = 0; i < cc.length; i++) {
                                 cargar(3, remplazar(id1), cc[i]);
                            }



                        });

                    break;
                case 3:
                    url="http://localhost:29398/api/Linea/" +remplazar(id1) + "/" + remplazar(id2) ;
                    $.get(url)
                        .done(function (data) {

                            var i = 0;
                            var tr = "";
                            var cc3=[];

                            $.each(data, function (key, item) {
                                i++;
                                tr += '<tr class="N3' + item.Margen_M + ' ">';
                                tr += '<td>  </td>';
                                tr += '<td style="min-width: 30px"> </td>';
                                tr += '<td style="min-width: 30px"> </td>';

                                tr += '<td colspan="6"> ' + item.Margen_M + ' </td>';
                                tr += '<td>' + redondear(item.LIM_EXC_REAL_M) + '</td>';
                                tr += '<td>' + redondear(item.LIM_EXC_MONTO_M) + '</td>';
                                tr += '<td>--- </td>';
                                tr += '<td>' + redondear(item.AQP_EXC_REAL_M) + '</td>';
                                tr += '<td>' + redondear(item.AQP_EXC_MONTO_M) + '</td>';
                                tr += '<td>--- </td>';
                                tr += '<td>' + redondear(item.EXC_REAL_M) + '</td>';
                                tr += '<td>' + redondear(item.U_EXC_MONTO_M) + '</td>';
                                tr += '<td>--- </td>';
                                tr += '<td>';
                                tr += '<button  data-title2="' + remplazar(id2) +'"  data-title3="'  + remplazar(item.Margen_M ) +'" data-nivel="4" data-title="' + remplazar(id1) +'">[+]</button> </td>';
                                tr += '</tr>';
                                cc3[i] = remplazar(item.Margen_M);

                            });


                            $(".N2" + remplazar(id2)).after(tr);

                            for (i = 0; i < cc3.length; i++) {
                                cargar(4, remplazar(id1),remplazar(id2) ,cc3[i]);
                             }



                        });
                    break;
                case 4:
                    url="http://localhost:29398/api/Linea/" + remplazar(id1) + "/" + remplazar(id2) + "/" + remplazar(id3) ;
                    $.get(url)
                        .done(function (data) {

                            var i = 0;
                            var tr = "";
                            var cc4=[];

                            $.each(data, function (key, item) {
                                i++;
                                tr += '<tr class="N4' + item.Margen_M + ' ">';
                                tr += '<td>  </td>';
                                tr += '<td style="min-width: 30px"> </td>';
                                tr += '<td style="min-width: 30px"> </td>';
                                tr += '<td style="min-width: 30px"> </td>';

                                tr += '<td colspan="5"> ' + item.Margen_M + ' </td>';
                                tr += '<td>' + redondear(item.LIM_EXC_REAL_M) + '</td>';
                                tr += '<td>' + redondear(item.LIM_EXC_MONTO_M) + '</td>';
                                tr += '<td>--- </td>';
                                tr += '<td>' + redondear(item.AQP_EXC_REAL_M) + '</td>';
                                tr += '<td>' + redondear(item.AQP_EXC_MONTO_M) + '</td>';
                                tr += '<td>--- </td>';
                                tr += '<td>' + redondear(item.EXC_REAL_M) + '</td>';
                                tr += '<td>' + redondear(item.U_EXC_MONTO_M) + '</td>';
                                tr += '<td>--- </td>';
                                tr += '<td>';
                                tr += '<button  data-title2="' + remplazar(id2) +'" data-title3="' + remplazar(id3) +'"  data-title4="'  + remplazar(item.Margen_M ) +'" data-nivel="5" data-title="' + remplazar(id1) +'">[+]</button> </td>';
                                tr += '</tr>';
                                cc4[i] = remplazar(item.Margen_M);

                            });

                            $(".N3" + remplazar(id3)).after(tr);

                            for (i = 0; i < cc4.length; i++) {
                                cargar(5, remplazar(id1),remplazar(id2) ,remplazar(id3) ,cc4[i]);
                            }


                        });
                    break;
                case 5:
                    url="http://localhost:29398/api/Linea/" +id1+ "/" + id2 + "/" + id3+ "/" + id4 ;
                    $.get(url)
                        .done(function (data) {

                            var i = 0;
                            var tr = "";
                            var cc5=[];
                            $.each(data, function (key, item) {
                                i++;
                                tr += '<tr>';
                                tr += '<tr class="N5' + item.Margen_M + ' ">';
                                tr += '<td style="min-width: 30px"> </td>';
                                tr += '<td style="min-width: 30px"> </td>';
                                tr += '<td style="min-width: 30px"> </td>';
                                tr += '<td style="min-width: 30px"> </td>';

                                tr += '<td style="min-width: 230px" colspan="4" > ' + item.Id_M + "-" + item.Margen_M + ' </td>';
                                tr += '<td>' + redondear(item.LIM_EXC_REAL_M) + '</td>';
                                tr += '<td>' + redondear(item.LIM_EXC_MONTO_M) + '</td>';
                                tr += '<td>--- </td>';
                                tr += '<td>' + redondear(item.AQP_EXC_REAL_M) + '</td>';
                                tr += '<td>' + redondear(item.AQP_EXC_MONTO_M) + '</td>';
                                tr += '<td>--- </td>';
                                tr += '<td>' + redondear(item.EXC_REAL_M) + '</td>';
                                tr += '<td>' + redondear(item.U_EXC_MONTO_M) + '</td>';
                                tr += '<td>--- </td>';
                                tr += '<td>';
                                tr += '<button data-title4="' + remplazar(id4) +'"   data-title3="' + remplazar(id3) +'"  data-title2="' + remplazar(id2) +'"  data-title5="'  + remplazar(item.Id_M ) +'" data-nivel="6" data-title="' + remplazar(id1) +'">[+]</button> </td>';
                                tr += '</tr>';
                                cc5[i] = remplazar(item.Margen_M);

                            });

                            $(".N4" + remplazar(id4)).after(tr);

                            for (i = 0; i < cc5.length; i++) {
                                cargar(6, remplazar(id1),remplazar(id2) ,remplazar(id3) ,remplazar(id4) ,cc5[i]);
                            }

                        });
                    break;

                case 6:
                    url="http://localhost:29398/api/Linea/" + id1 + "/" + id2 + "/" + id3+ "/" + id4+ "/" + id5 ;
                    $.get(url)
                        .done(function (data) {

                            var i = 0;
                            var tr = "";
                            var cc6=[];
                            $.each(data, function (key, item) {
                                i++;
                                tr += '<tr>';
                                tr += '<tr class="N6' + item.Margen_M + ' ">';
                                tr += '<td style="min-width: 30px"> </td>';
                                tr += '<td style="min-width: 30px"> </td>';
                                tr += '<td style="min-width: 30px"> </td>';
                                tr += '<td style="min-width: 30px"> </td>';
                                tr += '<td style="min-width: 30px"> </td>';

                                tr += '<td colspan="3" style="min-width: 230px" > ' + item.Id_M + "-" + item.Margen_M + ' </td>';
                                tr += '<td>' + redondear(item.LIM_EXC_REAL_M) + '</td>';
                                tr += '<td>' + redondear(item.LIM_EXC_MONTO_M) + '</td>';
                                tr += '<td>--- </td>';
                                tr += '<td>' + redondear(item.AQP_EXC_REAL_M) + '</td>';
                                tr += '<td>' + redondear(item.AQP_EXC_MONTO_M) + '</td>';
                                tr += '<td>--- </td>';
                                tr += '<td>' + redondear(item.EXC_REAL_M) + '</td>';
                                tr += '<td>' + redondear(item.U_EXC_MONTO_M) + '</td>';
                                tr += '<td>--- </td>';
                                tr += '<td>';
                                tr += '<button  data-title5="' + remplazar(id5) + '" data-title4="' + remplazar(id4) +'"   data-title3="' + remplazar(id3) +'"  data-title2="' + remplazar(id2) +'"  data-title6="'  + remplazar(item.Id_M ) +'" data-nivel="7" data-title="' + remplazar(id1) +'">[+]</button> </td>';
                                tr += '</tr>';
                                cc6[i] = remplazar(item.Margen_M);

                            });

                            $(".N5" + remplazar(id5)).after(tr);

                            for (i = 0; i < cc6.length; i++) {
                                cargar(7, remplazar(id1),remplazar(id2) ,remplazar(id3) ,remplazar(id4),remplazar(id5) ,cc6[i]);
                            }

                        });
                    break;
                case 7:
                    url="http://localhost:29398/api/Linea/" + id1+ "/" + id2 + "/" + id3+ "/" + id4+ "/" + id5 + "/" + id6 ;
                    $.get(url)
                        .done(function (data) {

                            var i = 0;
                            var tr = "";
                            var cc7=[];

                            $.each(data, function (key, item) {
                                i++;
                                tr += '<tr>';
                                tr += '<tr class="N7' + item.Margen_M + ' ">';
                                tr += '<td style="min-width: 30px"> </td>';
                                tr += '<td style="min-width: 30px"> </td>';
                                tr += '<td style="min-width: 30px"> </td>';
                                tr += '<td style="min-width: 30px"> </td>';
                                tr += '<td style="min-width: 30px"> </td>';
                                tr += '<td style="min-width: 30px"> </td>';

                                tr += '<td colspan="2" style="min-width: 80px" > '  + item.Margen_M + ' </td>';
                                tr += '<td>' + redondear(item.LIM_EXC_REAL_M) + '</td>';
                                tr += '<td>' + redondear(item.LIM_EXC_MONTO_M) + '</td>';
                                tr += '<td>--- </td>';
                                tr += '<td>' + redondear(item.AQP_EXC_REAL_M) + '</td>';
                                tr += '<td>' + redondear(item.AQP_EXC_MONTO_M) + '</td>';
                                tr += '<td>--- </td>';
                                tr += '<td>' + redondear(item.EXC_REAL_M) + '</td>';
                                tr += '<td>' + redondear(item.U_EXC_MONTO_M) + '</td>';
                                tr += '<td>--- </td>';
                                tr += '<td>';
                                tr += '<button  data-title5="' + remplazar(id5) + '" data-title4="' + remplazar(id4) +'"   data-title3="' + remplazar(id3) +'"  data-title2="' + remplazar(id2)+'"  data-title6="' + remplazar(id6) +'"  data-title7="'  + remplazar(item.Id_M ) +'" data-nivel="8" data-title="' + remplazar(id1) +'">[+]</button> </td>';
                                tr += '</tr>';
                                cc7[i] = remplazar(item.Margen_M);

                            });

                            $(".N6" + remplazar(id6)).after(tr);

                            for (i = 0; i < cc7.length; i++) {
                                cargar(8, remplazar(id1),remplazar(id2) ,remplazar(id3) ,remplazar(id4),remplazar(id5),remplazar(id6) ,cc7[i]);
                            }


                        });
                    break;
                case 8:
                    url="http://localhost:29398/api/Linea/" +$(this).data("title") + "/" + $(this).data("title2") + "/" + $(this).data("title3")+ "/" + $(this).data("title4")+ "/" + $(this).data("title5") + "/" + $(this).data("title6") + "/" + $(this).data("title7") ;
                    $.get(url)
                        .done(function (data) {

                            var i = 0;
                            var tr = "";
                            $.each(data, function (key, item) {
                                i++;
                                tr += '<tr>';
                                tr += '<td>  </td>';
                                tr += '<td style="min-width: 30px"> </td>';
                                tr += '<td style="min-width: 30px"> </td>';
                                tr += '<td style="min-width: 30px"> </td>';
                                tr += '<td style="min-width: 30px"> </td>';
                                tr += '<td style="min-width: 30px"> </td>';
                                tr += '<td style="min-width: 30px"> </td>';
                                tr += '<td style="min-width: 30px"> </td>';

                                tr += '<td  style="min-width: 330px" style="min-width: 80px" > '  + item.Id_M + ' '+ item.Margen_M + ' </td>';
                                tr += '<td>' + redondear(item.LIM_EXC_REAL_M) + '</td>';
                                tr += '<td>' + redondear(item.LIM_EXC_MONTO_M) + '</td>';
                                tr += '<td>--- </td>';
                                tr += '<td>' + redondear(item.AQP_EXC_REAL_M) + '</td>';
                                tr += '<td>' + redondear(item.AQP_EXC_MONTO_M) + '</td>';
                                tr += '<td>--- </td>';
                                tr += '<td>' + redondear(item.EXC_REAL_M) + '</td>';
                                tr += '<td>' + redondear(item.U_EXC_MONTO_M) + '</td>';
                                tr += '<td>--- </td>';
                                tr += '<td>';
                                tr += '</tr>';
                            });



                        });
                    break;


            }
        }
    </script>

    <div class="row">
    <div class="col-md-12">
        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-social-dribbble font-green"></i>
                    <span class="caption-subject font-green bold uppercase">Simple Table</span>
                </div>
                <div class="actions">
                    <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                        <i class="icon-cloud-upload"></i>
                    </a>
                    <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                        <i class="icon-wrench"></i>
                    </a>
                    <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                        <i class="icon-trash"></i>
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table">
                    <table class="table table-hover" id="table1">
                        <thead>
                        <tr>
                            <th> # </th>
                            <th > </th>
                            <th > </th>

                            <th>Ejecutado </th>
                            <th>Presupuestado </th>
                            <th>--- </th>



                        </tr>
                        </thead>
                        <tbody>
                        @foreach($x3 as $item)

                            <tr class="{{str_replace("+","",str_replace (" ","",$item["Margen_M"]))}}">
                            <td> # </td>
                            <td  colspan="8"> {{$item["Margen_M"]}} </td>

                             <td>{{$item["LIM_EXC_REAL_M"]}} </td>
                             <td>{{$item["LIM_EXC_MONTO_M"]}} </td>
                             <td>--- </td>


                         </tr>
                        <t{{str_replace (" ","",$item["Margen_M"])}}>
                        </t{{str_replace (" ","",$item["Margen_M"])}}>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- END SAMPLE TABLE PORTLET-->
    </div>
</div>
<table border="1"

@endsection

@section('script')

@endsection
