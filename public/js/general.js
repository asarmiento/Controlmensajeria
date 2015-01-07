$(document).ready(function() {
    $('tbody.list tr:odd').addClass('odd');
    $('tbody.list tr:even').addClass('even');
    
    $(".fecha_entrega").datepicker({
        dateFormat: "yy-mm-dd",
        dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
        showOtherMonths: true,
        monthNamesShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
        changeMonth: true,
        changeYear: true
    });
 
    $("#fechacheque").datepicker({
        dateFormat: "yy-mm-dd",
        dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
        showOtherMonths: true,
        monthNamesShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
        changeMonth: true,
        changeYear: true
    });
    
     $("#fecha_recibido").datepicker({
        dateFormat: "yy-mm-dd",
        dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
        showOtherMonths: true,
        monthNamesShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
        changeMonth: true,
        changeYear: true
    });
      $("#fechacheque").datepicker({
        dateFormat: "yy-mm-dd",
        dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
        showOtherMonths: true,
        monthNamesShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
        changeMonth: true,
        changeYear: true
    });
});