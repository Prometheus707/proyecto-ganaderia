$(function(){
	$(document).on('click','#btn_Buscar_Area', function(){
		if($('#dato_txt_area').val()==""){
			alertify.error("DEBE INGRESAR TEXTO A BUSCAR");
		}else{
			$.post("../controlador/areaCtrl.php", {
				action:'listarArea',
				var_area:$('#dato_txt_area').val()
					}, function(data){
						$("#areasList").html(data.listaArea);
					}, 'json');
		}
	})
	$(document).on('click', '#btnGuardarArea', function(){
        $.post("../controlador/areaCtrl.php", {
			action:'guardarArea',
			nombreArea:$('#nombreArea').val(),
			arexcentro:$('#areaXcentro').val()
				}, function(data){
					if(data.resultd=="1"){  
                       
						alertify.success(data.msj);
						$('#nombreArea').val("");
                        $('#nombreArea').val()=="";
						listarCardArea();
				   }else{	
					   alertify.error(data.msj);	
				   }
				}, 'json');
    })
	$(document).on('click', '#btnEliminarCardArea', function(){
		var idDeleteArea = $(this).attr('data-idArea');
		alertify.confirm("¿stá seguro de eliminar el registro? ", function (e) {
			if(e){ 
					$.post("../controlador/areaCtrl.php", {
					action:'DeleteArea',
					idAreaDel:idDeleteArea
						}, function(data){
							if(data.resultd=="1"){  
								alertify.success(data.msj);
						   }else{	
							   alertify.error(data.msj);	
						   }
						}, 'json');
				}
				else{ error("Cancelado el proceso de eliminacion."); }
		});
		return false;		
	})
	$(document).on('click','#btnActualizarCardArea', function(){
		var idUpdateArea = $(this).attr('data-idAreaUpdate');
		$.post("../controlador/areaCtrl.php", {
			action:'llenarAreas',
			idLlenarArea:idUpdateArea
				}, function(data){
					$('#nombreAreaUpdate').val(data.nombreArea);
					$('#idAreaUp').val(idUpdateArea);
				}, 'json');
	})
	$(document).on('click', '#btnUpdateArea', function(){
		$.post("../controlador/areaCtrl.php", {
			action:'updateArea',
			idUpdateArea:$('#idAreaUp').val(),
			nombreUpdateArea:$('#nombreAreaUpdate').val()
				}, function(data){
					if(data.resultd=="1"){  
						alertify.success(data.msj);
						listarCardArea();
				   }else{	
					   alertify.error(data.msj);	
				   }
				}, 'json');
	})
})