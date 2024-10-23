$(function(){
	function listarCardEspecie(){
		var unidadEspecie = $("#idUnidad_FKRegistro").val();
		//alert(unidadEspecie);
		$.post("../controlador/especieCtrl.php", {
			action:'cardEspecie',
			buscarPorUnidad: unidadEspecie
				}, function(data){
					if(data.tabsEspecie !== undefined){
						$("#cardEspecie").html(data.tabsEspecie);	
					}
					else{
						alertify.error(data.msj); 
					}
				}, 'json');
	}
	function cargarEspecie(selectEspecie, idUniFk){
		$.post("../controlador/animal_ctrl.php", {
			action:'cargarEspecie',
			idUnidad_FKRegistro:idUniFk
			}, function(data){		
				// $("#idRaza_FKRegistro").empty();	
				$(selectEspecie).html(data.listaEspecies);
			}, 'json');
	}
	$(document).on('click', '#btnGuardarEspecie', function(){
		var idUniSelectE = $("#idUnidad_FKRegistro").val();
		
		$.post("../controlador/especieCtrl.php", {
			action:'guardarEspecie',
			nombreEs:$('#nombreEspecie').val(),
			UnidadEs:$("#idUnidad_FKRegistro").val()
				}, function(data){
					if(data.resultd=="1"){   
						alertify.success(data.msj);
						$('#nombreEspecie').val("");
						$("#unidadEspecie option:eq(0)").prop("selected", true);
						listarCardEspecie();
						cargarEspecie("#idEspecie_FKRegistro", idUniSelectE);
						$("#idRaza_FKRegistro").empty();
						$("#btnModalRaza").hide();
				   }else{	
					   alertify.error(data.msj);	
				   }
				}, 'json');
	})
	//LISTAR LAS ESPECIES EN CARD
	$(document).on('click', '#btnModalEspecie', function(){
		//Buscar especie que pertence a esa unidad
		listarCardEspecie();
	})
	//ELIMINAR ESPECIE
	$(document).on('click', '#btnEliminarCardEspecie', function(){
		var idUniSelectE = $("#idUnidad_FKRegistro").val();
		
		var $btn = $(this); // Guardamos una referencia al botón
		var datEspecie = $(this).attr('data-idEspecie');
		alertify.confirm("¿stá seguro de eliminar el registro? ", function (e) {
			if(e){ 
				$.post("../controlador/especieCtrl.php", {
					action:'eliminarEspecie',
					eliminarEspecie: datEspecie
						}, function(data){
							if(data.resultd=="1"){  
								alertify.success(data.msj);
								listarCardEspecie() 	
								cargarEspecie("#idEspecie_FKRegistro", idUniSelectE);
								$("#idRaza_FKRegistro").empty();
								$("#btnModalRaza").hide();
							}
							else{
								alertify.error(data.msj); 
								$btn.hide();// Ocultamos el botón si la operación fue exitosa
								
							}
						}, 'json');
				} else { error("Cancelado el proceso de eliminacion."); }
			}); 
			return false
	})
	//RELLENAR CAMPOS FORMULARIO ESPECIE
	$(document).on('click', '#btnActualizarCardEspecie', function(){
		// listarUnidadEs("#unidadEspecieUpdate");//LLENARR EL SELECT DE UNIDADES EN ACTUALIZAR
		var ediDatEspecie = $(this).attr('data-idEspecieUpdate');
		//alertify.success(ediDatEspecie);
		$.post("../controlador/especieCtrl.php", {
			action:'rellenarDatosEsp',
			rellenarEspecie: ediDatEspecie
				}, function(data){
						$("#idEspecieUpdate").val(data.idEspecie);
						$("#nombreEspecieUpdate").val(data.nombreEspecie);
						$("#unidadEspecieUpdate").val(data.nombreUnidadFk);
				}, 'json');
	})
	$('#addEspecie').on('shown.bs.modal', function() {
		$('#cardEspecie').empty(); 
		$('#dato_especie').val(""); 
	})
	
	//ACTUALIZAR ESPECIE
	$(document).on('click', '#btnUptdEspecie', function(){
		var idUniSelectE = $("#idUnidad_FKRegistro").val();
		$.post("../controlador/especieCtrl.php", {
			action:'actualizarEspecie',
			idEspecieUptd:$('#idEspecieUpdate').val(),
			nombreEsUptd:$('#nombreEspecieUpdate').val(),
			//UnidadEsUptd:$('#unidadEspecieUpdate').val()
				}, function(data){
					if(data.resultd=="1"){   
						alertify.success(data.msj);
						listarCardEspecie();
						cargarEspecie("#idEspecie_FKRegistro", idUniSelectE);
						$("#idRaza_FKRegistro").empty();
						$("#btnModalRaza").hide();
				   }else{	
					   alertify.error(data.msj);	
				   }
				}, 'json');
	})
});