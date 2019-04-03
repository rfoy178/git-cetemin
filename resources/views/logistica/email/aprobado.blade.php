<!DOCTYPE html><html><head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style type="text/css">
        table.gridtable {
            font-family: verdana,arial,sans-serif;
            font-size:11px;
            color:#333333;
            border-width: 1px;
            border-color: #666666;
            border-collapse: collapse;
        }
        table.gridtable th {
            border-width: 1px;
            padding: 8px;
            border-style: solid;
            border-color: #666666;
            background-color: #dedede;
        }
        table.gridtable td {
            border-width: 1px;
            padding: 8px;
            border-style: solid;
            border-color: #666666;
            background-color: #ffffff;
        }
    </style>

    <style>


        a {text-decoration:none;}
        a:hover {text-decoration:underline;}
        .afooter {color:#0044cc !important;}
        body {
            background:#fff;
            margin:0;
            padding:0;
            -ms-text-size-adjust:100%;
        }
        .bodywrap{
            max-width:640px !important;
            margin:auto;
            overflow-x:hidden;
        }
        table {max-width:640px;}
        table td {border-collapse:collapse;margin:0;padding:0;}
        img {border:none;}
        p {margin-bottom:1em;} /* Yahoo! Mail fix. */
        @media only screen and (max-width: 480px) {
            .block{
                display:block;
                width:100%;
                padding: 5px 0px 5px 0px;
                box-sizing:border-box;
            }
            .mobileAdjust {
                font-size:24px !important;
                line-height:28px !important;
            }
            .mobileBlock {
                display:block !important;
                width:100% !important;
                box-sizing:border-box;
            }
            .mobileHidden {
                display:none !important;
            }
            .autoSize {
                width:100% !important;
                height:auto !important;
            }
            h1.h1Header {
                font-size:28px !important;
                line-height:28px !important;
            }
        }

        .btn {
            display: inline-block;
            font-weight: 400;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            border: 1px solid transparent;

            transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
            text-transform: none;
            overflow: visible;
            padding: .25rem .5rem;
            font-size: .875rem;
            line-height: 1.5;
            border-radius: .2rem;

            color: #fff;
            background-color: #ff342c;
            border-color: #ff3522;
        }


    </style>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body leftmargin="0" topmargin="0"><style type="text/css">
    div.preheader
    { display: none !important; }
</style>
<div class="preheader" style="font-size: 1px; display: none !important;"><strong>Atención:</strong>
    @switch($requerimiento->estado)

        @case(2)
        Su requerimiento fue <B>APROBADO</B> por su jefe directo.
        @break
        @case(3)
        Su requerimiento fue <B>DENEGADO</B> por su jefe directo.
        @break

        @default

    @endswitch </div>

<!--  -->

<table cellpadding="0" cellspacing="0" border="0" align="center">
    <tr>
        <td align="center" valign="top" width="640" class="bodywrap">

            <table width="100%" cellpadding="0" cellspacing="0" border="0" align="center">
                <tr>
                    <td width="640" align="right" valign="middle" style="color:#3d3d3d; font-family:'Segoe UI',Arial,sans-serif; font-size:12px; font-weight:bold; padding:12px 0;">

                        <p>
                            <span class="mobileBlock"><strong>Atención:</strong>   @switch($requerimiento->estado)

                                    @case(2)
                                    Su requerimiento fue <B>APROBADO</B> por su jefe directo.
                                    @break
                                    @case(3)
                                    Su requerimiento fue <B>DENEGADO</B> por su jefe directo.
                                    @break

                                    @default

                                @endswitch.</span><span class="mobileHidden">&nbsp;|&nbsp;</span><span class="mobileBlock"><a style="color:#0044cc; text-decoration:underline;" href="https://adm.cetemin.com" title="Consulta este correo electrónico en el explorador.">Ingresar.</a></span>
                        </p>

                    </td>
                </tr>
            </table>
            <table width="100%" cellpadding="0" cellspacing="0" border="0" align="center">
                <tr>
                    <td width="20" valign="middle" style="color:#000000; font-family:'Segoe UI',Arial,sans-serif; font-size:12px; font-weight:bold; padding:20px 0;">&nbsp;</td>
                    <td width="600" valign="middle" style="color:#000000; font-family:'Segoe UI',Arial,sans-serif; font-size:12px; font-weight:bold; padding:20px 0;">

                        <img src="{{asset("logo2.png")}}" width="160"  alt="CETEMIN" border="0">

                        <h1 style="color:#000000; font-family:'Segoe UI Light','Segoe UI',Arial,sans-serif; font-size:38px; font-weight:100; line-height:38px; margin-bottom:12px; padding:0;" class="h1Header">
                            Requerimiento <b>{{$codigo}}</b>.
                        </h1>

                    </td>
                    <td width="20" valign="middle" style="color:#000000; font-family:'Segoe UI',Arial,sans-serif; font-size:12px; font-weight:bold; padding:20px 0;">&nbsp;</td>
                </tr>
            </table>
            <table width="100%" cellpadding="0" cellspacing="0" border="0" align="center">
                <tr>
                    <td width="20" valign="middle" style="color:#000000; font-family:'Segoe UI',Arial,sans-serif; font-size:12px; padding:0 0 30px;">&nbsp;</td>
                    <td width="600" align="left" valign="top" style="font-family:'Segoe UI',Arial,sans-serif; font-size:13px; line-height:16px; padding:0 0 30px;">

                        <p>
                            @switch($requerimiento->estado)

                                @case(2)
                                Su requerimiento fue <B>APROBADO</B> por su jefe directo.
                                @break
                                @case(3)
                                Su requerimiento fue <B>DENEGADO</B> por su jefe directo.
                                @break

                                @default

                            @endswitch
                            @if($requerimiento->clase=="I")
                                solicita los siguientes  <b>Articulos</b>.
                            @else
                                solicita el siguiente  <b>Servicio/b>.
                            @endif
                        </p>

                        <!-- <ul>
                             <li>Al distribuir id. y contraseñas a usuarios individuales, asegúrate de hacerlo de modo seguro.</li>
                             <li>Las contraseñas temporales son válidas durante 90 días.</li>
                         </ul>
                     <!-- START AMPSCRIPT
                         -->

                        <!---->
                        <p>
                            AREA <strong>{{$requerimiento->area->area}}  </strong> <br>
                            Fecha de RQ <strong>{{$requerimiento->created_at}}</strong>  <br>


                        </p>
                        <p>
                            <strong>Motivo</strong> <br>
                            {{$requerimiento->comentario}}

                        </p>


                        <p>
                        <table class="gridtable" style=" font-family: verdana,arial,sans-serif;
            font-size:11px;
            color:#333333;
            border-width: 1px;
            border-color: #666666;
            border-collapse: collapse;">
                            <tr>
                                <td style="border-width: 1px;
            padding: 8px;
            border-style: solid;
            border-color: #666666;
            background-color: #dedede;">Producto</td>
                                <td style="border-width: 1px;
            padding: 8px;
            border-style: solid;
            border-color: #666666;
            background-color: #dedede;">Cantidad</td>
                                <td style="border-width: 1px;
            padding: 8px;
            border-style: solid;
            border-color: #666666;
            background-color: #dedede;">Precio</td>
                                <td style="border-width: 1px;
            padding: 8px;
            border-style: solid;
            border-color: #666666;
            background-color: #dedede;">Total <BR>Referencia</td>

                            </tr>
                            <?php
                            $p=0;
                            ?>
                            @foreach($requerimiento->detalle as $item)
                                <tr>
                                    <td>{{$item->articulo_nombre}}</td>
                                    <td style="text-align: right">{{$item->cantidad}}</td>
                                    <td style="text-align: right">{{$item->precio_referencial}}</td>
                                    <td style="text-align: right">{{$item->total_referencial}}</td>
                                    <?php
                                    $p=$p+$item->total_referencial;
                                    ?>
                                </tr>
                            @endforeach
                            <tr>

                                <td colspan="3"  style="text-align: right">Total Referencial</td>
                                <td style="text-align: right">{{$p}}</td>

                            </tr>

                        </table>
                        </p>




                        <p>
                            Gracias.
                        </p>
                        <p>
                            Atentamente, <br>IES CETEMIN
                        </p>

                    </td>
                    <td width="20" valign="middle" style="color:#000000; font-family:'Segoe UI',Arial,sans-serif; font-size:12px; padding:0 0 30px;">&nbsp;</td>
                </tr>
            </table>

            <table width="100%" cellpadding="0" cellspacing="0" border="0" align="center">
                <tr>
                    <td width="640" valign="middle" bgcolor="#f2f2f2" style="color:#000000; font-family:'Segoe UI',Arial,sans-serif; font-size:12px; padding:20px 0;">
                        <table width="100%" cellpadding="0" cellspacing="0" border="0" align="center">
                            <tr>
                                <td width="20" valign="middle" bgcolor="#f2f2f2" style="color:#000000; font-family:'Segoe UI',Arial,sans-serif; font-size:12px; padding:0;">&nbsp;</td>
                                <td width="460" colspan="2" align="left" valign="bottom" bgcolor="#f2f2f2" style="color:#000000; font-family:'Segoe UI',Arial,sans-serif; font-size:12px; line-height:16px; padding:0;" class="mobileBlock">



                                    <p>
                                        Este mensaje se ha enviado desde una dirección de correo electrónico no supervisada. No responda a este mensaje.<a href="https://click.email.microsoftonline.com/?qs=a03980c618cbb05603275539551f3b59c706a3d4717cd8d77603094ebc3fac53a88534b6ad53eb9aae6350052a4bcf5ba38f9f7a60d5f57f" title="" style="color:#0072c6; text-decoration:underline;"></a><br>

                                    </p>
                                    <p>
                                        <span dir="ltr">Centro Tecnológico Minero<br>CETEMIN<br>www.cetemin.edu.pe</span>
                                    </p>

                                </td>
                                <td width="40" valign="middle" bgcolor="#f2f2f2" style="color:#000000; font-family:'Segoe UI',Arial,sans-serif; font-size:12px; padding:0;" class="mobileHidden">&nbsp;</td>
                                <td width="100" align="left" valign="bottom" bgcolor="#f2f2f2" style="color:#000000; font-family:'Segoe UI',Arial,sans-serif; font-size:12px; line-height:16px; padding:0;" class="mobileBlock">
                                    <p>
                                        <img src="{{asset("logo2.png")}}" width="100" alt="Microsoft" border="0">
                                    </p>
                                </td>
                                <td width="20" valign="middle" bgcolor="#f2f2f2" style="color:#000000; font-family:'Segoe UI',Arial,sans-serif; font-size:12px; padding:0;">&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>



        </td>
    </tr>
</table>

</body>
</html>
