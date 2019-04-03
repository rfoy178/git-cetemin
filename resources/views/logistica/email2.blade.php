<table class="x_wrapper" width="100%" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif; background-color:#f5f8fa; margin:0; padding:0; width:100%">
    <tbody>
    <tr>
        <td align="center" style="font-family:Avenir,Helvetica,sans-serif">
            <table class="x_content" width="100%" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif; margin:0; padding:0; width:100%">
                <tbody>
                <tr>
                    <td class="x_header" style="font-family:Avenir,Helvetica,sans-serif; padding:25px 0; text-align:center">
                        <a href="http://localhost" target="_blank" rel="noopener noreferrer" style="font-family:Avenir,Helvetica,sans-serif; color:#bbbfc3; font-size:19px; font-weight:bold; text-decoration:none">Requerimientos {{$area["abreviatura"]}}-{{str_pad($id, 5, "0", STR_PAD_LEFT)}}</a></td>
                </tr>
                <tr>
                    <td class="x_body" width="100%" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif; background-color:#FFFFFF; border-bottom:1px solid #EDEFF2; border-top:1px solid #EDEFF2; margin:0; padding:0; width:100%">
                        <table class="x_inner-body" align="center" width="570" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif; background-color:#FFFFFF; margin:0 auto; padding:0; width:570px">
                            <tbody>
                            <tr>
                                <td class="x_content-cell" style="font-family:Avenir,Helvetica,sans-serif; padding:35px">
                                    <h1 style="font-family:Avenir,Helvetica,sans-serif; color:#2F3133; font-size:19px; font-weight:bold; margin-top:0; text-align:left">
                                        ¡Hola!</h1>
                                    <p style="font-family: Avenir, Helvetica, sans-serif, serif, EmojiFont; color: rgb(116, 120, 126); font-size: 16px; line-height: 1.5em; margin-top: 0px; text-align: left;">

                                        @switch($estado)
                                            @case(1)
                                            Usted está recibiendo este correo electrónico porque hemos recibido una solicitud para aprobar un requerimiento.
                                            @break

                                            @case(2)
                                            Usted está recibiendo este correo electrónico porque su requerimiento fue APROBADO por su jefe directo.
                                            @break
                                            @case(3)
                                            Usted está recibiendo este correo electrónico porque su requerimiento fue DENEGADO por su jefe directo.
                                            @break
                                            @case(4)
                                            Usted está recibiendo este correo electrónico porque su requerimiento fue DENEGADO por su jefe directo.
                                            @break
                                            @default
                                            <span> </span>
                                        @endswitch

                                    </p>

                                    <table class="x_content" width="100%" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif; margin:0; padding:0; width:100%">
                                        <tbody>





                                             <tr>
                                                 <td class="x_header" style="font-size:14px;font-family:Avenir,Helvetica,sans-serif; padding:5px 0;min-width: 15px">
                                                     Area
                                                 </td>
                                                 <td class="x_header" style="font-size:14px;font-family:Avenir,Helvetica,sans-serif; padding:5px 0;">
                                                     {{$area["area"]}}
                                                 </td>

                                             </tr>
                                             <tr>
                                                 <td class="x_header" style="font-size:14px;font-family:Avenir,Helvetica,sans-serif; padding:5px 0;min-width: 15px">
                                                     Solicitante
                                                 </td>
                                                 <td class="x_header" style="font-size:14px;font-family:Avenir,Helvetica,sans-serif; padding:5px 0;">
                                                     {{$usuario["name"]}} {{$usuario["apellidos"]}}

                                                 </td>

                                             </tr>

                                             <tr>
                                                 <td class="x_header" style="font-size:14px;font-family:Avenir,Helvetica,sans-serif; padding:5px 0;min-width: 15px">
                                                     Fecha creacion
                                                 </td>
                                                 <td class="x_header" style="font-size:14px;font-family:Avenir,Helvetica,sans-serif; padding:5px 0;">
                                                     {{$created_at}}

                                                 </td>

                                             </tr>

                                             <tr>
                                                 <td class="x_header" colspan="2" style="font-size:14px;font-family:Avenir,Helvetica,sans-serif; padding:5px 0;min-width: 15px">
{{$comentario}}                                                 </td>


                                             </tr>
                                        </tbody>
                                    </table>


                                    <table class="x_content" width="100%" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif; margin:0; padding:0; width:100%">
                                        <tbody>


                                        <tr>
                                            <td class="x_header" style="font-size:14px;background-color:#f5f8fa;font-family:Avenir,Helvetica,sans-serif; padding:5px 0; text-align:center">
                                                #
                                            </td>
                                            <td class="x_header" style="font-size:14px;background-color:#f5f8fa;font-family:Avenir,Helvetica,sans-serif; padding:5px 0; text-align:left">
                                                Articulo
                                            </td>
                                            <td class="x_header" style="font-size:14px;background-color:#f5f8fa;font-family:Avenir,Helvetica,sans-serif; padding:5px 0; text-align:center">
                                                    Cantidad
                                            </td>
                                        </tr><?php $i=1?>

                                        @foreach($detalle as $item)
                                        <tr>
                                            <td class="x_header" style="font-size:14px;font-family:Avenir,Helvetica,sans-serif; padding:5px 0;min-width: 15px">
                                                {{$i}}
                                            </td>
                                            <td class="x_header" style="font-size:14px;font-family:Avenir,Helvetica,sans-serif; padding:5px 0;">
                                                {{$item["articulo_nombre"]}}
                                            </td>
                                            <td class="x_header" style="font-size:14px;font-family:Avenir,Helvetica,sans-serif; padding:5px 0; text-align:right; ">
                                                {{$item["cantidad"]}}
                                            </td>
                                        </tr>
                                            <?php $i++; ?>
                                        @endforeach


                                        </tbody>
                                    </table>

@if($estado==1)
                                        <table class="x_action" align="center" width="100%" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif; margin:30px auto; padding:0; text-align:center; width:100%">
                                        <tbody>
                                        <tr>
                                            <td align="center" style="font-family:Avenir,Helvetica,sans-serif">
                                                <table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif">
                                                    <tbody>
                                                    <tr>
                                                        <td align="center" style="font-family:Avenir,Helvetica,sans-serif">
                                                            <table border="0" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif">
                                                                <tbody>
                                                                <tr>
                                                                    <td style="font-family:Avenir,Helvetica,sans-serif"><a href="{{route("requerimiento.estado",['id' => $id,'estado'=>2])}}" target="_blank" rel="noopener noreferrer" class="x_button x_button-blue" style="font-family:Avenir,Helvetica,sans-serif; border-radius:3px; color:#FFF; display:inline-block; text-decoration:none; background-color:#3097D1; border-top:10px solid #3097D1; border-right:18px solid #3097D1; border-bottom:10px solid #3097D1; border-left:18px solid #3097D1">Aprobar</a> </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>

                                                        <td align="center" style="font-family:Avenir,Helvetica,sans-serif">
                                                            <table border="0" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif">
                                                                <tbody>
                                                                <tr>
                                                                    <td style="font-family:Avenir,Helvetica,sans-serif"><a  href="{{route("requerimiento.estado",['id' => $id,'estado'=>3])}}"  target="_blank" rel="noopener noreferrer" class="x_button x_button-blue" style="font-family:Avenir,Helvetica,sans-serif; border-radius:3px; color:#FFF; display:inline-block; text-decoration:none; background-color:red; border-top:10px solid red; border-right:18px solid red; border-bottom:10px solid red; border-left:18px solid red">Denegar</a> </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <p style="font-family: Avenir, Helvetica, sans-serif, serif, EmojiFont; color: rgb(116, 120, 126); font-size: 16px; line-height: 1.5em; margin-top: 0px; text-align: left;">
                                        Clic en uno de los botones para aprobar o denegar.</p>

             @endif

                                    <p style="font-family: Avenir, Helvetica, sans-serif, serif, EmojiFont; color: rgb(116, 120, 126); font-size: 16px; line-height: 1.5em; margin-top: 0px; text-align: left;">
                                        Saludos,<br>
                                        CETEMIN</p>
                                    <table class="x_subcopy" width="100%" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif; border-top:1px solid #EDEFF2; margin-top:25px; padding-top:25px">
                                        <tbody>
                                        <tr>
                                            <td style="font-family:Avenir,Helvetica,sans-serif">
                                                <p style="font-family: Avenir, Helvetica, sans-serif, serif, EmojiFont; color: rgb(116, 120, 126); line-height: 1.5em; margin-top: 0px; text-align: left; font-size: 12px;">

                                                   <!-- Si tiene problemas para hacer clic en el botón "Restablecer contraseña", copie y pegue la siguiente URL en su navegador web: http: // localhost / password / reset / 19329aee879d6e874b51f1510cb61dc8ee353be19f6ab3f873acdc13873695eb-->
                                                </p>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="font-family:Avenir,Helvetica,sans-serif">
                        <table class="x_footer" align="center" width="570" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif; margin:0 auto; padding:0; text-align:center; width:570px">
                            <tbody>
                            <tr>
                                <td class="x_content-cell" align="center" style="font-family:Avenir,Helvetica,sans-serif; padding:35px">
                                    <p style="font-family: Avenir, Helvetica, sans-serif, serif, EmojiFont; line-height: 1.5em; margin-top: 0px; color: rgb(174, 174, 174); font-size: 12px; text-align: center;">
                                        © 2018 CETEMIN. All rights reserved.</p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>