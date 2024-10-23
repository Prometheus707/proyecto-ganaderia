$(function(){
    alert("validar estado general animales y actualizar");
    $.post("../../archivo/controlador/pruebaCtrl.php", {
        action:'EvaluarCrecimientoGeneral',
    }, function(data){
            $("#cardRazas").html(data.listaRazas);
    }, 'json');
})
