function edit(id){
    art=id;
    cargar_formulario(5);
}


$(document).on("submit",".formentrada",function(e){
    e.preventDefault();
    var quien=$(this).attr("id");
    var formu=$(this);
    var varurl="";
    if(quien=="f_crear_usuario"){  var varurl=$(this).attr("action");  var div_resul="capa_formularios";  }
    if(quien=="f_crear_rol"){  var varurl=$(this).attr("action");  var div_resul="capa_formularios";  }
    if(quien=="f_crear_permiso"){  var varurl=$(this).attr("action");  var div_resul="capa_formularios";  }
    if(quien=="f_editar_usuario"){  var varurl=$(this).attr("action");  var div_resul="notificacion_E2";  }
    if(quien=="f_editar_acceso"){  var varurl=$(this).attr("action");  var div_resul="notificacion_E3";  }
    if(quien=="f_borrar_usuario"){  var varurl=$(this).attr("action");  var div_resul="capa_formularios";  }
    if(quien=="f_asignar_permiso"){  var varurl=$(this).attr("action");  var div_resul="capa_formularios";  }


        $("#"+div_resul+"").html( $("#cargador_empresa").html());
        $.ajax({
            // la URL para la petición
            url : varurl,
            data : formu.serialize(),
            type : 'POST',
            dataType : 'html',

            success : function(resul) {

                if(resul.error){
                    toastr["error"](resul.msg, "SAP Online")

                }else{
                    cargar();
                    toastr["success"]("Se guardo registro ", "SAP Online")
                    $("#modalFormulario").modal('hide');

                    $(".input-sm").val("");
                }


            },
            error : function(xhr, status) {

                toastr["error"]("Ha ocurrido un error, revise su conexion e intentelo nuevamente", "SAP Onlie")

            }


        });




})

function eliminar(id){
    $.ajax({
        // la URL para la petición
        url : "del_articulo/" + id,
        type : 'POST',
        dataType : 'html',

        success : function(resul) {
            cargar();
            toastr["success"]("Se guardo registro ", "SAP Online")
        },
        error : function(xhr, status) {
            toastr["error"]("Ha ocurrido un error, revise su conexion e intentelo nuevamente", "SAP Onlie")
        }
    });
}





$("#btnNuevoX").on("click", function(event){

    $("#modalNuevo").modal();
});

function nuevorq(){
    $.ajax({
        // la URL para la petición
        url : "nuevo",
        data : frmNuevo.serialize(),
        type : 'POST',
        dataType : 'html',

        success : function(resul) {
            cargar();
            toastr["success"]("Se guardo registro ", "SAP Online")
            $("#modalFormulario").modal('hide');
        },
        error : function(xhr, status) {

            toastr["error"]("Ha ocurrido un error, revise su conexion e intentelo nuevamente", "SAP Onlie")

        }


    });

}