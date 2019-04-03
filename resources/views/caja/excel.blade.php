
                    <table class="table table-hover table-light">
                            <thead>
                            <tr>
                                <td> # </td>
                                <th> Codigo </th>

                                <th> Fecha Aprobación </th>
                                <th> Beneficiario </th>
                                <th>   </th>
                                <th>   </th>

                                <th> Monto S/ </th>

                                <th> Area </th>
                                <th>   </th>



                                <th> Asunto </th>
                                <th> Fecha Necesaria </th>
                                <th> Solicitante </th>

                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php  $ii=1;
                            $i=1;
                            $suma=0;
                            ?>
                            @foreach($rq as $item)
                                <tr>
                                    <td> {{$i}}</td>

                                    <td>

<span class="visible-print">{{$item->abreviatura}}-{{str_pad($item->id, 5, "0", STR_PAD_LEFT)}}</span>


                                    </td>


                                    <td style="font-size: smaller"> {{$item->fecha_aprobacion}} </td>



                                    <td style="font-size: smaller"> <strong>{{$item->dni}} </strong></td>

                                    <td style="font-size: smaller">{{$item->nombre}}  </td>

                                    <td style="font-size: smaller">S/</td>


                                    <td style="text-align: right;font-size: smaller">
                                        {{number_format($item->monto,2,".","")}}
                                    </td>

                                    <td style="font-size: smaller">
                                        <strong>
                                            @if($item->sede_id==1)
                                                LIM
                                            @else
                                                AQP
                                            @endif</strong>
                                    </td>
                                    <td style="font-size: smaller">


                                        {{$item->area}} </td>





                                    <td  style="font-size: smaller"> {{$item->descripcion}} </td>
                                    <td style="font-size: smaller"> {{$item->fecha_necesaria}} </td>
                                    <td style="font-size: smaller"> {{$item->usuario}}   </td>





                                </tr>
                                <?php $i++;
                                $suma=$suma+ $item->monto;
                                ?>
                            @endforeach
                            <input type="hidden" id="cantidad" name="cantidad" value="{{$i}}">

                            <input type="hidden" id="suma" name="suma" value="{{$suma}}">


                            <tr>
                                <td colspan="6"> TOTAL </td>
                                <td style="text-align: right;font-size: smaller">{{number_format($suma,2,".","")}}
                                </td>


                            </tr>



                            </tbody>
                        </table>
