$(document).ready(function() {
    var displayblock = {'display': 'block'};
    var displaynone = {'display': 'none'};

    /**/
    $(".estado").click(function() {
        var ID = $(this).attr("id");
        var id = ID.split('_');
        $("#estado_" + id[1]).css(displaynone);
        $("#estadodiv_" + id[1]).css(displayblock);
    });
    /**/
    $(".Claroestado").click(function() {
        var ID = $(this).attr("id");
        var id = ID.split('_');
        $("#Claroestado_" + id[1]).css(displaynone);
        $("#Claroestadodiv_" + id[1]).css(displayblock);
    });
    /**/
    $("#barrido").change(function() {
        var estado = $("#barrido").val();
	
        if (estado == 2) {
            $("#observEnt").css(displayblock);
        //    $("#observacionSelect_" + id[1]).load('generales/changobservacion?id=' + estado + '&empresas=1' );
        } else if (estado == 3) {
            $("#observDev").css(displayblock);
        //    $("#observacionSelect_" + id[1]).load('generales/changobservacion?id=' + estado + '&empresas=1' );
        }
    });
	    /**/
    $(".observacion").click(function() {
        var ID = $(this).attr("id");
        var id = ID.split('_');
        var pres = $("#empresa").val();
        var estado = $("#estadoj_" + id[1]).val();
        if (estado == 2) {
            $("#observacion_" + id[1]).css(displaynone);
            $("#observaciondiv_" + id[1]).css(displayblock);
            $("#observacionSelect_" + id[1]).load('generales/changobservacion?id=' + estado + '&empresas=' + pres);
        } else if (estado == 3) {
            $("#observacion_" + id[1]).css(displaynone);
            $("#observaciondiv_" + id[1]).css(displayblock);
            $("#observacionSelect_" + id[1]).load('generales/changobservacion?id=' + estado + '&empresas=' + pres);
        }
    });
    /**/
    $(".ClaroObservacion").click(function() {
        var ID = $(this).attr("id");
        var id = ID.split('_');
        var pres = $("#empresa").val();
        var estado = $("#estadoj_" + id[1]).val();
        if (estado == 2) {
            $("#ClaroObservacion_" + id[1]).css(displaynone);
            $("#ClaroObservaciondiv_" + id[1]).css(displayblock);
            $("#CalroObservacionSelect_" + id[1]).load('generales/changobservacion?id=' + estado + '&empresas=' + pres);
        } else if (estado == 3) {
            $("#ClaroObservacion_" + id[1]).css(displaynone);
            $("#ClaroObservaciondiv_" + id[1]).css(displayblock);
            $("#CalroObservacionSelect_" + id[1]).load('generales/changobservacion?id=' + estado + '&empresas=' + pres);
        }
    });
    /**/
    $(".recibido").click(function() {
        var ID = $(this).attr("id");
        var id = ID.split('-');
        $("#recibido-" + id[1]).css(displaynone);
        $("#recibidodiv_" + id[1]).css(displayblock);
        $("#recibido_" + id[1]).focus();
    });
    /**/
    $(".fecha").click(function() {
        var ID = $(this).attr("id");
        var id = ID.split('_');
        $("#fecha_" + id[1]).css(displaynone);
        $("#fechaentrega_" + id[1]).css(displayblock);
    });
    /**/
    $(".mensajero").click(function() {
        var ID = $(this).attr("id");
        var id = ID.split('_');
        $("#mensajero_" + id[1]).css(displaynone);
        $("#empleadoSelect_" + id[1]).css(displayblock);
    });
    $("#tipopresupuesto").change(function(event) {
        var ID = $(this).attr("id");
        var id = ID.split('_');
        var id = $("#estadoSelect_" + id[1]).find(':selected').val();
    });


    /*
     * Cambiamos el estado y mostramos el resultado
     */
    $(".estadoSelect").change(function() {
        var ID = $(this).attr("id");
        var id = ID.split('_');
        var estado = $("#estadoSelect_" + id[1]).val();
        var pres = $("#empresa").val();
        var datos = "estado_id=" + estado + "&campoid=" + id[1] + "&observacion_id= '' " + "&comentario= ";

        $.ajax({
            type: "POST",
            url: "http://system.elcorso.hn/public/generales/update",
            data: datos,
            success: function(data) {
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
     * Cambiamos el estado y mostramos el resultado Claro
     */
    $(".ClaroestadoSelect").change(function() {
        var ID = $(this).attr("id");
        var id = ID.split('_');
        var estado = $("#ClaroestadoSelect_" + id[1]).val();
        var pres = $("#empresa").val();
        var datos = "estado_id=" + estado + "&campoid=" + id[1] + "&observacion_id=  " + "&comentario= ";
        $.ajax({
            type: "POST",
            url: "http://system.elcorso.hn/public/generales/update",
            data: datos,
            success: function(data) {
                $("#Claroestado_" + id[1]).css(displayblock);
                $("#Claroestadodiv_" + id[1]).css(displaynone);
                $("#estadoj_" + id[1]).val(estado);

                if (estado == 1) {
                     $("#ClaroObservacion_" + id[1]).css(displayblock);
                   $("#ClaroObservaciondiv_" + id[1]).css(displaynone);
                    $("#Claroestado_" + id[1]).html('En Ruta');
                    $("#recibido-" + id[1]).html('No tiene');
                    $("#ClaroObservacion_" + id[1]).html('No tiene');
                } else if (estado == 2) {
                    $("#ClaroObservacionSelect_" + id[1]).load('http://system.elcorso.hn/public/generales/changobservacion?id=' + estado + '&empresas=' + pres);
                    $("#ClaroObservacion_" + id[1]).css(displaynone);
                   $("#ClaroObservaciondiv_" + id[1]).css(displayblock);
                    $("#Claroestado_" + id[1]).html('Entregado');
                    $("#recibido-" + id[1]).html('No tiene');
                   
            } else if (estado == 3) {
                $("#ClaroObservacionSelect_" + id[1]).load('http://system.elcorso.hn/public/generales/changobservacion?id=' + estado + '&empresas=' + pres);
                 $("#ClaroObservacion_" + id[1]).css(displaynone);
                   $("#ClaroObservaciondiv_" + id[1]).css(displayblock);
                    $("#Claroestado_" + id[1]).html('Devolución');
                
                    } else if (estado == 4) {
                      $("#ClaroObservacion_" + id[1]).css(displayblock);
                   $("#ClaroObservaciondiv_" + id[1]).css(displaynone);
                    $("#Claroestado_" + id[1]).html('No Entregado');
                    $("#recibido-" + id[1]).html('No tiene');
                     $("#ClaroObservacion_" + id[1]).html('No tiene');
                }
            }});
    });
    /*
     * Cambiamos el estado y mostramos el resultado
     */
    $(".observacionSelect").change(function() {
        var ID = $(this).attr("id");
        var id = ID.split('_');
        var observacion = $("#observacionSelect_" + id[1]).val();
        var datos = "observacion_id=" + observacion + "&campoid=" + id[1];

        $.ajax({
            type: "POST",
            url: "http://system.elcorso.hn/public/generales/update",
            data: datos,
            success: function(data) {
                $("#observacion_" + id[1]).css(displayblock);
                $("#observaciondiv_" + id[1]).css(displaynone);
                $("#observacion_" + id[1]).load('generales/observacion?id=' + observacion);


            }});
    });
    /*
     * Cambiamos el estado y mostramos el resultado Claro
     */
    $(".ClaroObservacionSelect").change(function() {
        var ID = $(this).attr("id");
        var id = ID.split('_');
        var observacion = $("#ClaroObservacionSelect_" + id[1]).val();
        var datos = "observacion_id=" + observacion + "&campoid=" + id[1];
       
        $.ajax({
            type: "POST",
            url: "http://system.elcorso.hn/public/generales/updateobservacion",
            data: datos,
            success: function(data) {
                $("#ClaroObservacion_" + id[1]).css(displayblock);
                $("#ClaroObservaciondiv_" + id[1]).css(displaynone);
                $("#ClaroObservacion_" + id[1]).load('http://system.elcorso.hn/public/generales/observacion?id=' + observacion);


            }});
    });
    /*
     * Cambiamos el estado y mostramos el resultado
     */
    $(".recibidop").change(function() {
        var ID = $(this).attr("id");
        var id = ID.split('_');
        var recibido = $("#recibido_" + id[1]).val();
        var datos = "comentario=" + recibido + "&campoid=" + id[1];

        $.ajax({
            type: "POST",
            url: "http://system.elcorso.hn/public/generales/updatecomentario",
            data: datos,
            success: function(data) {
                $("#recibido-" + id[1]).css(displayblock);
                $("#recibidodiv_" + id[1]).css(displaynone);
                if (recibido === '') {
                    $("#recibido-" + id[1]).html('No tiene');
                } else {
                    $("#recibido-" + id[1]).html(recibido);

                }
            }});
    });
    /*
     * Cambiamos el fecha entrega y mostramos el resultado
     */
    $(".fecha_entrega").change(function() {
        var ID = $(this).attr("id");
        var id = ID.split('_');
        var fecha = $("#fecha_entrega_" + id[2]).val();
        var datos = "fecha_entregado=" + fecha + "&campoid=" + id[2];

        $.ajax({
            type: "POST",
            url: "http://system.elcorso.hn/public/generales/updatefecha",
            data: datos,
            success: function(data) {
				$("#fecha_" + id[2]).css(displayblock);
                $("#fechaentrega_" + id[2]).css(displaynone);
				$("#fecha_" + id[2]).html(fecha);

            }});
    });
    /*
     * Cambiamos el mensajero y mostramos el resultado
     */
    $(".empleadoSelect").change(function() {
        var ID = $(this).attr("id");
        var id = ID.split('_');
        var mensajero = $("#empleadoSelect_" + id[1]).val();
        var datos = "mensajero_id=" + mensajero + "&id=" + id[1];
		
        $.ajax({
            type: "POST",
            url: "http://system.elcorso.hn/public/generales/updatemensajero",
            data: datos,
            success: function(data) {
				
                $("#mensajero_" + id[1]).css(displayblock);
                $("#empleadoSelect_" + id[1]).css(displaynone);
              
                if(mensajero>0){
                     $("#mensajero_" + id[1]).html(data);
                }else{
                     $("#mensajero_" + id[1]).html("No Tiene Mensajero");
               
            }

            }});
    });
    
      /**/
    $("#limpiar").click(function() {
         $.ajax({
            type: "POST",
            url: "http://system.elcorso.hn/public/generales/borrarsession",
            data: 'id=1',
            success: function(data) {


            }});
    });
});