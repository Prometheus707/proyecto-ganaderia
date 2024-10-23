$(function(){
    flatpickr('#fechaControlS', {});
    $(document).on('click', '#btnGuardarControlSanitario', function () {  
        $.post("../controlador/controlSanitarioctrl.php", {
			action:'guardarControlSanitario',
			fechaControlSnitario:$('#fechaControlS').val(),
            eventoSanitario:$('#eventoSanitario').val(),
            productoUtilizado:$('#productoUtilizado').val(),
            dosisSanitario:$('#dosisSanitario').val(),
			observacionesSanitario:$('#observacionSanitario').val(),
            idAnimalSanitario:$("#idAnimalBusqueda").val()
				}, function(data){
					if(data.resultd=="1"){  
						alertify.success(data.msj);
				   }else{	
					   alertify.error(data.msj);	
				   }
				}, 'json');
    })
    $('#registroControlS').on('shown.bs.modal', function() {
        $.post("../controlador/controlSanitarioctrl.php", {
			action:'listarCardsControlSanitario',
            idAnimalSanitarioCard:$("#idAnimalBusqueda").val()
				}, function(data){
					$("#cardControlSanitario").html(data.tabsControlSanitario)
				}, 'json');
	})
	
})