$(function () { 
    flatpickr('#fechaVacuna', {});
    function clearCampVacunas(){//LIMPIAR CAMPOS FOMRULARIO
        $("#viaDeAdminVacuna").val(0);
        $("#SelectNombreVacuna").val(0);
        $("#veterinarioVacunacion").val(0)
        $("#laboratorioVacuna").val("");
        $("#numeroLoteVacuna").val("");
        $("#registroIcaVacuna").val("");
        $("#dosificacionVacuna").val("");
        $("#tiempoDeRetiroVacuna").val("");
        $("#observacionVacuna").val("");
    }
    $('#registroVacunacion').on('shown.bs.modal', function() {
		clearCampVacunas();
	})
    function listarSelectVacunas(){//LISTAR SELECT DE VACUNAS
        $.post('../../archivo/controlador/vacunasctrl.php',{
            action:'selectVacunas',
        },function(data){
            $("#SelectNombreVacuna").html(data.selectVacunas);
            $("#SelectNombreVacunaUpdate").html(data.selectVacunas);
        },"json")
    }
    function listarSelectVeterinario(){//LISTAR SELECT DE VACUNAS
        $.post('../../archivo/controlador/vacunasctrl.php',{
            action:'selectVeterinario',
        },function(data){
            $("#veterinarioVacunacion").html(data.selectVeterinario);
            $("#veterinarioVacunacionUpdate").html(data.selectVeterinario);
        },"json")
    }
    function listarCardsVacunacion(){//LISTAR CARDS DE VACUNACION
        $.post('../../archivo/controlador/vacunasctrl.php',{
            action:'cardVacunaciones',
            idAnimalVacunacion:$("#idAnimalBusqueda").val()
        },function (data) {  
            $("#cardVacunacion").html(data.tabsVacunacion);
        }, "json")
    }
    $(document).on('click', '#btnGuardarVac', function(){
        $.post('../../archivo/controlador/vacunasctrl.php', {
            action:'guardarVacunacion',
            fechaVacunacion:$("#fechaVacuna").val(),
            nombreVacuna:$("#SelectNombreVacuna").val(),
            laboratorioVacuna:$("#laboratorioVacuna").val(),
            numeroLoteVacuna:$("#numeroLoteVacuna").val(),
            registroIcaVacuna:$("#registroIcaVacuna").val(),
            dosificacionVacuna:$("#dosificacionVacuna").val(),
            viaDeAdminVacuna:$("#viaDeAdminVacuna").val(),
            tiempoDeRetiroVacuna:$("#tiempoDeRetiroVacuna").val(),
            observacionVacuna:$("#observacionVacuna").val(),
            idUsuRegVacunacion:$("#idUsuLogueadoFK").val(),
            idAnimalVacuna:$("#idAnimalBusqueda").val(),
            idVeterinarioVacunacion:$("#veterinarioVacunacion").val()
        },function(data){
            if(data.resultd=="1"){
                alertify.success(data.msj);
                clearCampVacunas();
                listarCardsVacunacion();
            }else{
                alertify.error(data.msj);
            }      
        }, "json")
    })
    $(document).on('click', '#btnEliminarCardVacunacion', function (){  
       var idVacunacionDelete  = $(this).attr('data-idVacunacion');
       alertify.confirm("¿stá seguro de eliminar el registro? ", function (e) {
        if(e){ 
                $.post('../../archivo/controlador/vacunasctrl.php',  {
                    action:'eliminarVacunacion',
                    idVacunacionDel: idVacunacionDelete
                },function(data){
                    if(data.resultd=="1"){
                        alertify.success(data.msj);
                        listarCardsVacunacion();
                    }else{
                        alertify.error(data.msj);
                    }
                },"json")
            }
            else{ error("Cancelado el proceso de eliminacion."); }
        });
        return false;		 
    })
    $("#registroVacunacion").on("shown.bs.modal", function(){//CUANDO APARESCA EL FORMULARIO SE LISTEN LAS CARD DE PARTO
        listarSelectVacunas();
        listarSelectVeterinario();
        listarCardsVacunacion();
    })
    ///////////////////////ACTUALIZAR VACUNACION//////////////////////////
    $(document).on('click', '#btnActualizarCardVacunacion', function () { 
        var idVacunacionUpdate = $(this).attr('data-idVacunacionUpdate');
        $("#idVacunacionUpdate").val(idVacunacionUpdate);
        $.post('../../archivo/controlador/vacunasctrl.php',{
            action:'llenarFormVacunacion',
            idVacunacionUp:idVacunacionUpdate
        },function (data) {  
            $("#fechaVacunaUpdate").val(data.fechaVacunacion);
            setTimeout(() => {
                $("#SelectNombreVacunaUpdate").val(data.nombreVacuna).trigger('change');
            }, 1000);
            $("#laboratorioVacunaUpdate").val(data.laboratorioVacuna);
            $("#numeroLoteVacunaUpdate").val(data.numeroLoteVacuna);
            $("#registroIcaVacunaUpdate").val(data.registroIcaVacuna);
            $("#dosificacionVacunaUpdate").val(data.dosificacionVacuna);
            $("#tiempoDeRetiroVacunaUpdate").val(data.tiempoRetiroVacuna);
            setTimeout(() => {
                $("#viaDeAdminVacunaUpdate").val(data.viaAdministracionVacuna).trigger('change');
            }, 1000);
            setTimeout(() => {
                $("#veterinarioVacunacionUpdate").val(data.veterinarioVacunacion).trigger('change');
            }, 1000);
            $("#observacionVacunaUpdate").val(data.obervacionesVacunacion);
        }, "json")
    })
    $(document).on('click', '#btnGuardarVacUpdate', function(){
        $.post('../../archivo/controlador/vacunasctrl.php', {
            action:'updateVacunacion',
            fechaVacunacionUpdate: $("#fechaVacunaUpdate").val(),
            nombreVacunaUpdate:$("#SelectNombreVacunaUpdate").val(),
            laboratorioVacunaUpdate: $("#laboratorioVacunaUpdate").val(),
            numeroLoteVacunaUpdate:$("#numeroLoteVacunaUpdate").val(),
            registroIcaVacunaUpdate:$("#registroIcaVacunaUpdate").val(),
            dosificacionVacunaUpdate:$("#dosificacionVacunaUpdate").val(),
            viaDeAdminVacunaUpdate:$("#viaDeAdminVacunaUpdate").val(),
            tiempoDeRetiroVacunaUpdate:$("#tiempoDeRetiroVacunaUpdate").val(),
            observacionVacunaUpdate:$("#observacionVacunaUpdate").val(),
            idUsuRegVacunacionUpdate:$("#idUsuLogueadoFKUpdate").val(),
            idAnimalVacunaUpdate:$("#idAnimalBusqueda").val(),
            idVeterinarioVacunacionUpdate: $("#veterinarioVacunacionUpdate").val(),
            idVacunacionUpdate:$("#idVacunacionUpdate").val()
        },function(data){
            if(data.resultd=="1"){
                alertify.success(data.msj);
                clearCampVacunas();
                listarCardsVacunacion();
            }else{
                alertify.error(data.msj);
            }      
        }, "json")
    })
    $('#updateVacunacion').on('shown.bs.modal', function() {
        listarSelectVacunas();
        listarSelectVeterinario();
	})
})