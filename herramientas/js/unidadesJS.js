$(document).ready(function(){	
	///////////////////////////////////MODAL UNIDAD EN ANIMALES////////////////
	function cargarUnidad(selectUni){//cargarRazas
		$.post("../controlador/animal_ctrl.php", {
		action:'cargarUnidad'
		}, function(data){
			$(selectUni).html(data.listaUnidad);
			$("#idEspecie_FKRegistro").empty();
			$("#idRaza_FKRegistro").empty();
		}, 'json');
	}
	function listarUnidades(){
		$.post("../controlador/unidades_ctrl.php", {
			action:'buscarListaUnidades',
		}, function(data){
			$("#cardUnidades").html(data.datosUnidades);		
		}, 'json');	
	}
	$(document).on('click', '#btnDellUnidad', function(){
		var idUnidadDelete =  $(this).attr('data-id_unidad_del');
		alertify.confirm("¿stá seguro de eliminar el registro? ", function (e) {
			if (e) { 
					$.post("../controlador/unidades_ctrl.php", {
						action:'killerUnidad',
						idUnidadDell : idUnidadDelete
					}, function(data){
						if(data.restl==1){ 
							dellOk(data.msj);
							listarUnidades();
							cargarUnidad("#idUnidad_FKRegistro");
							$("#btnModalEspecie").hide();
							$("#btnModalRaza").hide();
						}
						else { dellErr(data.msj); }	
					}, 'json');
				}
			else   { alertify.error("Proceso de eliminacion cancelado."); }
		}); 
		return false
	})//idUnidadProUpdate
	$(document).on('click', '#btnActualizarCardUnidad', function(){
		var idUnidadUpdt = $(this).attr('data-id');
		$.post("../controlador/unidades_ctrl.php", {
			action:'buscarUnidadV',
			idUnidadRellenar : idUnidadUpdt
		}, function(data){
			$('#nombreUnidadProUpdate').val(data.NombreUnidad);
			$('#idUnidadUpdate').val(idUnidadUpdt);
		}, 'json');
	})
	$(document).on('click', '#btnUpdateUnidad', function(){
		$.post("../controlador/unidades_ctrl.php", {
			action:'updateUnidades',
			idUnidadUpdate : $('#idUnidadUpdate').val(),
			nombreUpdateUni: $('#nombreUnidadProUpdate').val()
		}, function(data){
			if(data.resultd=="1"){  
				addOk(data.msj);
				listarUnidades();
				cargarUnidad("#idUnidad_FKRegistro");
				$("#btnModalEspecie").hide();
				$("#btnModalRaza").hide();
			}
			else { alertify.error(data.msj); }	
		}, 'json');
	})
	//////////////////////////////////FIN MODAL UNIDAD EN ANIMALES////////////////
	$("#listarGuardar").show();
	$("#listarActualizar").hide();	
	$("#listarKiller").hide();
	$(document).on("click", "#btnGuardarUnidad",function (){
		$.post("../controlador/unidades_ctrl.php", {
		action:'guardarUnidad',
		nombreUnidadPro:$("#nombreUnidadPro").val(),
		centroUniPro:$("#unidadXcentro").val(),
		regionalUniPro:$("#unidadXRegional").val()
		}, function(data){
			if(data.restl==1){
				$("#nombreUnidadPro").val("");	
				$("#divRespTUnidad").empty();
				$("#divRespTUnidad").html(data.msj);
				addOk(data.msj);
				$('#divRespTUnidad').empty();
				cargarUnidad("#idUnidad_FKRegistro");
				listarUnidades();
				$("#btnModalEspecie").hide();
				$("#btnModalRaza").hide();
			}else{
				$("#divRespTUnidad").empty();
				$("#divRespTUnidad").html(data.msj);
			}					
		}, 'json');
	});	
	function buscarOk(mnsj){
		alertify.error(mnsj); 
		return false;
	}
	function buscarError(msjEntrada){
		alertify.error(msjEntrada); 
		return false; 
	}
	function dellOk(mnsj){
		alertify.success(mnsj); 
		return false;
	}
	function dellErr(mnsj){
		alertify.success(mnsj); 
		return false;
	}
	function addErr(mnsj){
		alertify.success(mnsj); 
		return false;
	}
	function addOk(mnsj){
		alertify.success(mnsj); 
		return false;
	}
	function updEspcOk(msj){
		alertify.success(msj); 
		return false;
	}
	function updEspcErr(msj){
		alertify.success(msj); 
		return false;
	}
	function updtOk(){
		alertify.success("REGISTRO ACTUALIZADO CON EXITO."); 
		setTimeout(function(){
			location.reload(true);
		}, 1100);
		return false;
	}
	function updtErr(){
		alertify.error("NOMBRE YA EXISTE."); 
		return false;
	}	
	$(document).on("click", "#modalUnidad", function(){
		listarUnidades();
	})
	$(document).on("click", "#btnUpdate",function (){ 
		$.post("../controlador/unidades_ctrl.php", {
			action:'updUnidad',
			idUnidadProUpdate:$("#idUnidadProUpdate").val(),
			nombreUnidadProUpdate:$("#nombreUnidadProUpdate").val()
		}, function(data){
			if(data.restl==1){	
				$("#idUnidadProUpdate").val("");
				$("#nombreUnidadProUpdate").val("");
				$("#divRespTUnidadUpdate").html(data.msj);
				updtOk();
				// $("#btnCerrarUpdate").trigger("click");
				$('#divRespTUnidadUpdate').empty();
				$('#divRespTUnidadUpdate').empty();
			}else{
				$('#divRespTUnidadUpdate').empty();
				$("#divRespTUnidadUpdate").html(data.msj);
				updtErr();
			} 
		}, 'json');			
	});
	$(document).on("click", "#btnAdd",function () {
		$.post("../controlador/unidades_ctrl.php", {
			action:'guardarEspecie',
			nombreEspecie:$("#nombreEspecie").val(),
			idUnidadAdmin:$("#idUnidadAdmin").val()
		}, function(data){
				if(data.restl==1){
					$("#nombreEspecie").val("");
					$("#lista").empty();
						$.post("../controlador/unidades_ctrl.php", {
						action:'listarEspecies',
						idUnidadAdmin:$("#idUnidadAdmin").val()
						}, function(data){
							$("#lista").html(data.listaEspecies);
						}, 'json');
					addOk(data.msj);				
				}
				else{					
					addErr(data.msj)
				}
		}, 'json');
	});
	
	$(document).on("click", "#btnAdministrar",function () {
		var id_unidad = $(this).data('id');
		$('#idUnidadAdmin').val(id_unidad);	
		$.post("../controlador/unidades_ctrl.php", {
			action:'buscarUnidad',
			idUnidadProUpdate:$("#idUnidadAdmin").val()
		}, function(data){
				$('#nombreUnidadAdmin').val(data.NombreUnidad);	
		}, 'json');
		// inicio listar especies -->
		$.post("../controlador/unidades_ctrl.php", {
			action:'listarEspecies',
			idUnidadAdmin:$("#idUnidadAdmin").val()
		}, function(data){
				$("#lista").html(data.listaEspecies);
		}, 'json');
		// cierre listar especies -->
	});
	
	$(document).on("click", "#btnEditarEspecie",function () {
		var id = $(this).data('id');
		$('#idEspecieUpd').val(id);	
		$("#listarActualizar").show();	
		$("#listarGuardar").hide();
		$("#listarKiller").hide();	
		$.post("../controlador/unidades_ctrl.php", {
			action:'buscarEspecie2',
			idEspecieUpd : $("#idEspecieUpd").val()
		}, function(data){
				$('#nombreEspecieUpd').val(data.NombreEspecie);
		}, 'json');
	});   
	
	$(document).on("click", "#btnUpd",function () {	
		$.post("../controlador/unidades_ctrl.php", {
			action:'actualizarEspecie',
			idEspecieUpd : $("#idEspecieUpd").val(),
			nombreEspecieUpd : $("#nombreEspecieUpd").val()
		}, function(data){
				if(data.restl==1){  
					updEspcOk(data.msj); 	
					$("#listarGuardar").show();
					$("#listarActualizar").hide();	
					$("#listarKiller").hide();	
					$("#idEspecieUpd").val("");
					$("#nombreEspecieUpd").val("");
					// inicio listar especies -->
						$.post("../controlador/unidades_ctrl.php", {
							action:'listarEspecies',
							idUnidadAdmin:$("#idUnidadAdmin").val()
						}, function(data){
								$("#lista").html(data.listaEspecies);
						}, 'json');
					// cierre listar especies -->
					}
				else 	{  updEspcErr(data.msj);   }					
				
		}, 'json');
	});  
	
	
	$(document).on("click", "#btnDellEspecie",function () {
		$("#listarGuardar").hide();
		$("#listarActualizar").hide();	
		$("#listarKiller").show();
		var idespeciedell = $(this).data('idespeciedell');
		$('#idEspecieDell').val(idespeciedell);	
		$.post("../controlador/unidades_ctrl.php", {
			action:'buscarEspecie',
			idEspecieDell:$("#idEspecieDell").val()
		}, function(data){
				$('#nombreEspecieDell').val(data.NombreEspecie);	
		}, 'json');
	});
	
	$(document).on("click", "#btnCancelarDell",function () {
		$("#listarGuardar").show();
		$("#listarActualizar").hide();	
		$("#listarKiller").hide();		
		$("#idEspecieDell").val("");
		$("#nombreEspecieDell").val("");
	});  
	
	$(document).on("click", "#btnCancelar",function () {
		$("#listarGuardar").show();
		$("#listarActualizar").hide();	
		$("#listarKiller").hide();		
		$("#idEspecieUpd").val("");
		$("#nombreEspecieUpd").val("");
	});	
	
	$(document).on("click", "#btnDell",function () {	
		alertify.success()
		confirmar();
	});
	function confirmar(){
		alertify.confirm("¿stá seguro de eliminar el registro? ", function (e) {
			if (e) { 
					$.post("../controlador/unidades_ctrl.php", {
						action:'killerEspecie',
						idEspecieDell : $("#idEspecieDell").val()
					}, function(data){
						if(data.restl==1){ 
						dellOk(data.msj);
						$("#idEspecieDell").val("");						
						$("#nombreEspecieDell").val("");						
						$("#listarGuardar").show();
						$("#listarActualizar").hide();	
						$("#listarKiller").hide();
						// inicio listar especies -->
							$.post("../controlador/unidades_ctrl.php", {
								action:'listarEspecies',
								idUnidadAdmin:$("#idUnidadAdmin").val()
							}, function(data){
									$("#lista").html(data.listaEspecies);
							}, 'json');
						// cierre listar especies -->
						}
						else { dellErr(data.msj); }	
					}, 'json');
					alertify.success("");   }
			else   { alertify.error("Proceso de eliminacion cancelado."); }
		}); 
		return false
	}
	
});	