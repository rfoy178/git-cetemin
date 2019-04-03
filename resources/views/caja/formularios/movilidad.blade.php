<div class="row">
    <div class="form-group">
        <label class="col-md-3 control-label">Fecha Documento </label>
        <div class="col-md-3">



                <input type="text" class="form-control" readonly=""   required id="fecha" name="fecha">



        </div>

        <label class="col-md-2 control-label">Tipo Doc </label>
        <div class="col-md-4">



            <input type="text" class="form-control" readonly="" value="21-01-2018"     id="fecha" name="fecha">
        </div>
    </div>

</div>


<div class="row">
    <div class="col-sm-12">
        <table class="table table-responsive table-bordered table-striped table-condensed flip-content " id="tb-lista-cc">
            <thead>

            <tr>

                <th  style="width: 20px">#</th>

                <th style="width: 150px"> Fecha </th>

                <th> Motivo</th>
                <th> Monto </th>
                <th style="width: 25px"></th>

            </tr>

            </thead>
            <tbody>

                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>

                    <td> <a href="#" class="btn btn-xs default">
                            <i class="fa fa-trash-o "></i>
                        </a> </td>
                </tr>

            <tr>
                <td></td>
                <td>

                    <div class="input-group input-xs date date-picker"   data-date-format="dd-mm-yyyy"  >


                        <input type="text" class="form-control" readonly=""   required id="fecha_movilidad" name="fecha_movilidad">
                        <span class="input-group-btn">
                                                            <button class="btn default" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                    </div>


                </td>
                <td>  <input type="text" class="form-control input-sm" required="" id="motivo_movilidad" name="motivo_movilidad"> </td>
                <td>  <input type="text" class="form-control input-sm" required="" id="monto_movilidad" name="monto_movilidad"> </td>
                <td> <a href="#" class="btn btn-xs default">
                        <i class="fa fa-plus-square"></i>
                    </a> </td>
            </tr>


            </tbody>
        </table>
    </div>
</div>
