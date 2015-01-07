$(document).ready(function () {
    var displayblock = {'display': 'block'};
    var displaynone = {'display': 'none'};
    /**/
    $(".estado").click(function () {
        var ID = $(this).attr("id");
        var id = ID.split('_');
        $("#estado_" + id[1]).css(displaynone);
        $("#estadodiv_" + id[1]).css(displayblock);
    });
        /**/
    $(".observacion").click(function () {
        var ID = $(this).attr("id");
        var id = ID.split('_');
        var pres = $("#empresa").val();
        var estado = $("#estadoj_" + id[1]).val();
        if(estado==2){
        $("#observacion_" + id[1]).css(displaynone);
        $("#observaciondiv_" + id[1]).css(displayblock);
        $("#observacionSelect_" + id[1]).load('generales/changobservacion?id=' + estado + '&empresas=' + pres);
    }else  if(estado==3){
        $("#observacion_" + id[1]).css(displaynone);
        $("#observaciondiv_" + id[1]).css(displayblock);
        $("#observacionSelect_" + id[1]).load('generales/changobservacion?id=' + estado + '&empresas=' + pres);
    }
    });
    /**/
    $(".recibido").click(function () {
        var ID = $(this).attr("id");
        var id = ID.split('-');
        $("#recibido-" + id[1]).css(displaynone);
        $("#recibidodiv_" + id[1]).css(displayblock);
    });
    /**/
    $(".fecha").click(function () {
        var ID = $(this).attr("id");
        var id = ID.split('_');
        $("#fecha_" + id[1]).css(displaynone);
        $("#fechaentrega_" + id[1]).css(displayblock);
    });
    /**/
    $(".mensajero").click(function () {
        var ID = $(this).attr("id");
        var id = ID.split('_');
        $("#mensajero_" + id[1]).css(displaynone);
        $("#empleadoSelect_" + id[1]).css(displayblock);
    });
    $("#tipopresupuesto").change(function (event) {
        var ID = $(this).attr("id");
        var id = ID.split('_');
        var id = $("#estadoSelect_" + id[1]).find(':selected').val();



    });


    /*
     * Cambiamos el estado y mostramos el resultado
     */
    $(".estadoSelect").change(function () {
        var ID = $(this).attr("id");
        var id = ID.split('_');
        var estado = $("#estadoSelect_" + id[1]).val();
        var pres = $("#empresa").val();
        var datos = "estado_id=" + estado + "&id=" + id[1]+ "&observacion_id= '' "+ "&comentario= " ;

        $.ajax({
            type: "POST",
            url: "generales/update",
            data: datos,
            success: function (data) {
                $("#estado_" + id[1]).css(displayblock);
                $("#estadodiv_" + id[1]).css(displaynone);
                $("#estadoj_" + id[1]).val(estado);
                    $("#observaciondiv_" + id[1]).css(displaynone);
                    $("#observacion_" + id[1]).css(displayblock);
                    
                if (estado == 1) {
                    $("#estado_" + id[1]).html('En Ruta');
                     $("#recibido-" + id[1]).html('No tiene');
                } else if (estado == 2) {
                    $("#estado_" + id[1]).html('Entregado');
                    $("#recibido-" + id[1]).html('No tiene');
                } else if (estado == 3) {
                    $("#observacionSelect_" + id[1]).load('generales/changobservacion?id=' + estado + '&empresas=' + pres);
                    $("#estado_" + id[1]).html('Devolución');
                } else if (estado == 4) {
                    $("#estado_" + id[1]).html('No Entregado');
                     $("#recibido-" + id[1]).html('No tiene');
                }
            }});
    });


    /*
     * Cambiamos el estado y mostramos el resultado
     */
    $(".recibidop").change(function () {
        var ID = $(this).attr("id");
        var id = ID.split('_');
        var recibido = $("#recibido_" + id[1]).val();
        
        var datos = "comentario=" + recibido + "&id=" + id[1];

        $.ajax({
            type: "POST",
            url: "generales/update",
            data: datos,
            success: function (data) {
                $("#recibido-" + id[1]).css(displayblock);
                $("#recibidodiv_" + id[1]).css(displaynone);
             
                 if(recibido===''){
                $("#recibido-" + id[1]).html('No tiene');
        }else{
             $("#recibido-" + id[1]).html(recibido);
           
        }
               

            }});
    });
    /*
     * Cambiamos el fecha entrega y mostramos el resultado
     */
    $(".fecha_entrega").change(function () {
        var ID = $(this).attr("id");
        var id = ID.split('_');
        var fecha = $("#fecha_entrega_" + id[2]).val();
        var datos = "fecha_entregado=" + fecha + "&id=" + id[2];

        $.ajax({
            type: "POST",
            url: "generales/update",
            data: datos,
            success: function (data) {

                $("#fecha_" + id[2]).css(displayblock);
                $("#fechaentrega_" + id[2]).css(displaynone);

                $("#fecha_" + id[2]).html(fecha);

            }});
    });
    /*
     * Cambiamos el mensajero y mostramos el resultado
     */
    $(".empleadoSelect").change(function () {
        var ID = $(this).attr("id");
        var id = ID.split('_');
        var mensajero = $("#empleadoSelect_" + id[1]).val();
        var datos = "mensajero_id=" + mensajero + "&id=" + id[1];

        $.ajax({
            type: "POST",
            url: "generales/updatemensajero",
            data: datos,
            success: function (data) {

                $("#mensajero_" + id[1]).css(displayblock);
                $("#empleadoSelect_" + id[1]).css(displaynone);

                $("#mensajero_" + id[1]).html(data);

            }});
    });
});