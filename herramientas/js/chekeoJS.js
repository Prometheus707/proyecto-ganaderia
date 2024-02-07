$(document).ready(function(){ 
	
	function ordenar(){
		$("#nombreRazaAdd").val("");
		$("#idRazaUpdt").val("");
		$("#nombreRazUpdt").val("");
		$("#idRazaDell").val("");
		$("#nombreRazDell").val("");
		$("#botonRaza").hide(); 
		$("#listarGuardar").show();
		$("#listarActualizar").hide();	
		$("#listarKiller").hide();
	}
	
	cargarUnidad();
	function notificar(msjEntrada){
		alertify.log(msjEntrada); 
		return false;
	}
	function ok(msjEntrada){
		alertify.success(msjEntrada); 
		return false;
	}	
	function error(msjEntrada){
		alertify.error(msjEntrada); 
		return false; 
	}
	function listarRazas(){
		$.post("../controlador/animal_ctrl.php", {
			action:'listaRazas',
			idEspecie_FKRegistro:$("#idEspecie_FKRegistro").val()
		}, function(data){
				$("#lista").empty();
				$("#lista").html(data.listaRazas);
		}, 'json');
	}
	
	function msjOk(msjHelp){
		ok(msjHelp)
	}
	function cargarRazas(){
		$.post("../controlador/animal_ctrl.php", {
		action:'selectRazas',
		idEspecie_FKRegistro:$("#idEspecie_FKRegistro").val()
		}, function(data){		
			$("#idRaza_FKRegistro").html(data.listaRazas);
			$("#botonRaza").show();   //para crear la raza 			
		}, 'json');
	}
	$("#btnModalRaza").click(function(){
		// inicio listar razas -->
		$("#nombreRazaAdd").val("");
		$("#idRazaUpdt").val("");
		$("#nombreRazUpdt").val("");
		$("#idRazaDell").val("");
		$("#nombreRazDell").val("");
		ordenar();
		listarRazas();
		// cierre listar razas -->
	});
	
	$(document).on("click", "#btnEditarRaza",function (){
		$("#listarGuardar").hide();
		$("#listarActualizar").show();	
		$("#listarKiller").hide();    
		$("#botonRaza").hide();
		var idUpd = $(this).data('idraza');   
		$('#idRazaUpdt').val(idUpd);
		var nombreraza = $(this).data('nombreraza');   
		$('#nombreRazUpdt').val(nombreraza);
	});	
	$(document).on("click", "#btnKillerRaza",function () {
		$("#listarGuardar").hide();
		$("#listarActualizar").hide();	
		$("#listarKiller").show();  
		$("#idRazaDell").val("");
		$("#nombreRazDell").val("");
		var idrazadell = $(this).data('idrazadell');   
		$('#idRazaDell').val(idrazadell);
		var nomrazadell = $(this).data('nomrazadell');   
		$('#nombreRazDell').val(nomrazadell);
	}); 	
	$(document).on("click", "#btnDellRaza",function () {
		confirmar();
	}); 
	function confirmar(){
		alertify.confirm("¿stá seguro de eliminar el registro? ", function (e) {
		if(e){ 
				$.post("../controlador/animal_ctrl.php", {
					action:'killerRaza',
					idRazaDell:$("#idRazaDell").val()
				}, function(data){
					if(data.restl==1){ 
						ordenar();
						listarRazas();
						cargarRazas();
						msjOk(data.msj)						;
					} else { error(data.msj); ordenar(); }	
				}, 'json');
			} else { error("Cancelado el proceso de eliminacion."); }
		}); 
		return false
	}
	$(document).on("click", "#btnUpdtRaza",function (){ 
		$.post("../controlador/animal_ctrl.php", {
			action:'updRaza',
			idRazaUpdt:$("#idRazaUpdt").val(),
			nombreRazUpdt:$("#nombreRazUpdt").val(),
			idEspecie_FKRegistro:$("#idEspecie_FKRegistro").val()
		}, function(data){
			if(data.restl==1){	
				ok(data.msj);
				listarRazas();
				cargarRazas();
				ordenar();
			}else{
				error(data.msj);
			} 
		}, 'json');			
	});
	
	$(document).on("click", "#btnNewRaza",function (){
		$.post("../controlador/animal_ctrl.php", {
		action:'guardarRaza',
		idEspecie_FKRegistro:$("#idEspecie_FKRegistro").val(),
		nombreRazaAdd:$("#nombreRazaAdd").val()
		}, function(data){
			if(data.restl==1){
				$("#nombreRazaAdd").val("");
				ok(data.msj);
				ordenar();
				listarRazas();
				cargarRazas();
			}else{ error(data.msj); }					
		}, 'json');
	});	
	
	function limpiar()
		{
			$("#fechaRegistro").val("");
			$("#codAnimalRegistro").val("");
			$("#fechaNacimientoRegistro").val("");
			$("#nombreAnimalRegistro").val("");
			$("#diasLactanciaAnimalRegistro").val("");
			$("#colorAnimalRegistro").val("");
			$("#pesoAnimalRegistro").val("");
			$("#unidadMedidaRegistro").val("");
			$("#unidadMedidaRegistro").val();
			cargarUnidad();
			$("#idSexoRegistro").val("0");
			$("#observacionesRegistro").val("");
		}
	$('.solo-numero').keyup(function (){
		this.value = (this.value + '').replace(/[^0-9]/g, '');
	});

	$.datepicker.setDefaults($.datepicker.regional["es"]);
	$("#fechaNacimientoRegistro").datepicker({dateFormat: "yy/mm/dd"});	
	
	function cargarUnidad(){
		$.post("../controlador/animal_ctrl.php", {
		action:'cargarUnidad'
		}, function(data){
			$("#idUnidad_FKRegistro").html(data.listaUnidad);
			$("#idEspecie_FKRegistro").empty();
			$("#idRaza_FKRegistro").empty();									
		}, 'json');
	}

	$('#idUnidad_FKRegistro').on('change', function(){	
		$.post("../controlador/animal_ctrl.php", {
		action:'cargarEspecie',
		idUnidad_FKRegistro:$("#idUnidad_FKRegistro").val()
		}, function(data){		
			$("#idRaza_FKRegistro").empty();			
			$("#idEspecie_FKRegistro").html(data.listaEspecies);
		}, 'json');
	});
	$('#idEspecie_FKRegistro').on('change', function(){	
		cargarRazas(); 
	});	
	$('#btnGuardar').on('click', function(){
		$.post("../controlador/animal_ctrl.php", {
			action:'guardarRegistro',
			fechaRegistro:$("#fechaRegistro").val(),
			codAnimalRegistro:$("#codAnimalRegistro").val(),
			fechaNacimientoRegistro:$("#fechaNacimientoRegistro").val(),
			nombreAnimalRegistro:$("#nombreAnimalRegistro").val(),
			diasLactanciaAnimalRegistro:$("#diasLactanciaAnimalRegistro").val(),
			colorAnimalRegistro:$("#colorAnimalRegistro").val(),
			pesoAnimalRegistro:$("#pesoAnimalRegistro").val(),
			unidadMedidaRegistro:$("#unidadMedidaRegistro").val(),
			observacionesRegistro:$("#observacionesRegistro").val(),
			idUnidad_FKRegistro:$("#idUnidad_FKRegistro").val(),
			idEspecie_FKRegistro:$("#idEspecie_FKRegistro").val(),
			idRaza_FKRegistro:$("#idRaza_FKRegistro").val(),
			idUsuRegistro:$("#idUsuRegistro").val(),
			nombreUsuRegistro:$("#nombreUsuRegistro").val(),
			idSexoRegistro:$("#idSexoRegistro").val()
			}, function(data){		
				if(data.restl==1){
					limpiar();
					// $("#divResptAnimal").empty();				
					// $("#divResptAnimal").html(data.msj);
					ok|(data.msj);
					setTimeout(function(){
						$("#btnCerrar").trigger("click");
					}, 1000);
					location.reload(true);
				}else{ error(data.msj);	}
			}, 'json');			
	});	

	$(document).on("focus", "#dato_txt",function (){ $("#tbServicio").empty(); $('#listaEncontrada').empty();});
	$("#btn_Buscar").click(function(){ ordenar(); }); 
	$("#btn_Buscar").click(function(){ ordenar(); }); 
	$("#btn_Buscar").click(function(){
		if($("#dato_txt").val()==""){
			error("DEBE INGRESAR TEXTO A BUSCAR.");
		}else{
			$.post("../controlador/chekeo_ctrl.php", {
				action:'listarServicioR',
				dato_txt:$("#dato_txt").val()
			}, function(data){
				$('#divRespuestasPanel').empty();
				$('#listaEncontrada').empty(); 
				if(data.result==1){ $("#example").html(data.listaAnimales);}
				else { error(data.msj);  }		
			}, 'json');
		}	
	});
	ordenar();
});	