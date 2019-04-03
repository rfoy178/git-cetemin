<!doctype html><html><head>

    <meta charset="utf-8">

    <title>Rendición de gastos</title>

    <style type="text/css">

        body,td,th {
            font-size: 9px;
            font-family: Gotham, "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        table {
            border-collapse: collapse;
        }

        .table, .table th, .table td {
            border: 0.5px solid black;
            padding-left: 5px;
            padding-right: 5px;
            font-size: 8px;
        }

    </style>
</head><body>

<div class="header">
  <table width="100%" border="0">
            <tbody>
            <tr>
                <td width="34%"  ><img src="https://adm.cetemin.com/logo.png" width="200"  >&nbsp;</td>
              <td width="30%" style="text-align: center"><h1><strong> RENDICIÓN DE GASTOS</strong></h1></td>
                <td width="36%" style="text-align: right" ><strong>{{date("d-m-Y")}}</strong></td>
            </tr>
            </tbody>
    </table>

    <table width="100%" border="0" >
        <tbody>
          <tr>
              <td width="5%" nowrap="nowrap"><strong>CODIGO</strong></td>
              <td width="45%">{{$rq->area->abreviatura}}-{{str_pad($rq->id, 5, "0", STR_PAD_LEFT)}}</td>
              <td  colspan="2"><strong>DATOS BENEFICIARIO</strong> </td>
          </tr>
          <tr>
              <td nowrap="nowrap"><strong>SOLICITANTE</strong></td>
              <td>{{$rq->usuario->name}}</td>
              <td nowrap="nowrap"><strong>DNI</strong></td>
              <td>{{$rq->dni}}</td>
          </tr>
          <tr>
              <td nowrap="nowrap"><strong>AREA</strong></td>
              <td>{{$rq->area->nombre}}</td>
              <td nowrap="nowrap"><strong>BENEFICIARIO</strong></td>
              <td>{{$rq->nombre}}</td>
          </tr>
        </tbody>
    </table>

  </div>
<br>
<br>
    <table width="100%" border="0" cellspacing="0"    class="table">
        <tbody>
        <tr bgcolor="#D6D6D6">
            <td width="2%" ><strong>#</strong></td>
            <td width="9%" ><strong>FECHA</strong></td>
            <td width="10%" ><strong>DOCUMENTO</strong></td>
            <td width="29%" ><strong>PROVEEDOR</strong></td>
            <td width="37%" ><strong>CONCEPTO</strong></td>
            <td width="11%" style="text-align: right" ><strong>TOTAL</strong></td>
        </tr>
        <?php $i=0;?>
    @foreach($detalle as $item2)
         <tr><?php $i++;?>
             <td height="25px">{{$i}}</td>
             <td>{{$item2["fecha"]}}</td>
             <td>{{$item2["tipo"]["nombre"]}}<br><strong>{{$item2["serie"]}}</strong></td>
             <td>{{$item2["proveedor"]["ruc"]}}<br><strong>{{$item2["proveedor"]["razon_social"]}}</strong></td>
             <td>{{strtoupper($item2["concepto"])}}</td>
             <td style="text-align: right">{{$item2["monto"]}}</td>
         </tr>
     @endforeach
        </tbody>
    </table>

<br>
<br>

<table width="100%" border="0" cellspacing="0"    class="table">
    <tbody>
    <tr bgcolor="#D6D6D6">
        <td width="25%" ><strong>TOTAL RECIBIDO</strong></td>
        <td width="25%" ><strong>TOTAL GASTADO</strong></td>
        <td width="25%" ><strong>TOTAL DEVUELTO</strong></td>
        <td width="25%" ><strong>TOTAL A REEMBOLSAR</strong></td>

    </tr>
    <tr  >
        <td width="25%" STYLE="text-align: right" ><strong>{{$total}} </strong></td>
        <td width="25%"  STYLE="text-align: right" ><strong> {{$gastos}}</strong></td>
        <td width="25%"  STYLE="text-align: right" ><strong>{{$devolucion}} </strong></td>
        <td width="25%"  STYLE="text-align: right" ><strong>{{$reembolso}}</strong></td>

    </tr>
     </tbody>
</table>





<table width="100%" border="0" cellspacing="0"    >
    <tbody>
    <tr >
        <td width="25%" style="height: 200px" > </td>
        <td width="25%" > </td>
        <td width="25%" > </td>
        <td width="25%" style="text-align: right"><strong>{{$rq->nombre}}</strong><br>{{$rq->cargo}}</td>

    </tr>

    </tbody>
</table>





</body>
</html>