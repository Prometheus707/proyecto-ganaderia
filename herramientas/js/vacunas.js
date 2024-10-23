$(function(){
    function listarSelectVacunas(){//LISTAR SELECT DE VACUNAS
        $.post('../../archivo/controlador/vacunasctrl.php',{
            action:'selectVacunas',
        },function(data){
            $("#SelectNombreVacuna").html(data.selectVacunas);
        },"json")
    }
    function limpiarFormVacunas(){
        $("#nombreVacuna").val("");
        $("#observacionVacunas").val("");
    }
    function listarCardsVacunas(){//LISTAR CARDS DE VACUNACION
        $.post('../../archivo/controlador/vacunasctrl.php',{
            action:'cardVacunas'
        },function (data) {  
            $("#cardVacunas").html(data.tabsVacunas);
        }, "json")
    }
    $(document).on('click', '#btnGuardarVacuna', function(){
        $.post('../../archivo/controlador/vacunasctrl.php', {
           action: 'guardarVacuna',
           fechaVacuna: $("#fechaVacuna").val(),
           nombreVacuna:$("#nombreVacuna").val(),
           observacionVacuna:$("#observacionVacunas").val()
        },function(data){
            if(data.resultd=="1"){
                alertify.success(data.msj);
                limpiarFormVacunas();
                listarSelectVacunas();
                listarCardsVacunas()
            }else{
                alertify.error(data.msj);
            }      
        },"json")
    })
    $(document).on('click', '#btnGuardarVacunaUpdate', function(){
        $.post('../../archivo/controlador/vacunasctrl.php', {
           action: 'updateVacuna',
           fechaVacunaUpd: $("#fechaVacunaUpd").val(),
           nombreVacunaUpdate:$("#nombreVacunaUpdate").val(),
           observacionVacunasUpdate:$("#observacionVacunasUpdate").val(),
           idVacunaUpdate:$("#idVacunaUpdate").val()
        },function(data){
            if(data.resultd=="1"){
                alertify.success(data.msj);
                listarSelectVacunas();
                listarCardsVacunas();
            }else{
                alertify.error(data.msj);
            }      
        },"json")
    })
    $(document).on('click', '#btnEliminarCardVacuna', function(){
        var idVacunaDelete = $(this).attr('data-idVacuna');
        alertify.confirm("¿stá seguro de eliminar el registro? ", function (e) {
            if(e){ 
                $.post('../../archivo/controlador/vacunasctrl.php', {
                    action: 'EliminarVacuna',
                    fechaVacuna: $("#fechaVacuna").val(),
                    nombreVacuna:$("#nombreVacuna").val(),
                    observacionVacuna:$("#observacionVacunas").val(),
                    idVacunaDelete:idVacunaDelete
                 },function(data){
                     if(data.resultd=="1"){
                         alertify.success(data.msj);
                         limpiarFormVacunas();
                         listarSelectVacunas();
                         listarCardsVacunas();
                     }else{
                         alertify.error(data.msj);
                     }      
                 },"json")
                }
                else{ error("Cancelado el proceso de eliminacion."); }
            });
        return false;		
    })
    $("#registroVacunas").on("shown.bs.modal", function(){//CUANDO APARESCA EL FORMULARIO SE LISTEN LAS CARD DE PARTO
        listarCardsVacunas();
    })
    /////////ACTUALIZAR VACUNAS////////////////
    $(document).on('click', '#btnActualizarCardVacuna', function(){
        var idVacunaRellenar = $(this).attr('data-idVacunaUpdate');
        $("#idVacunaUpdate").val(idVacunaRellenar);
        $.post('../../archivo/controlador/vacunasctrl.php', {
           action: 'rellanarVacuna',
          idVacunaRellenar:idVacunaRellenar
        },function(data){
           $("#fechaVacunaUpd").val(data.fechaRegistroVacuna);
           $("#nombreVacunaUpdate").val(data.nombreVacuna);
           $("#observacionVacunasUpdate").val(data.observacionVacuna);
        },"json")
    })
})