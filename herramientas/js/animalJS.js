$(document).ready(function(){ 
	function verificarTamanoPantalla() {
        var anchoPantalla = $(window).width();
        if (anchoPantalla <= 1024) { // Ancho para tabletas y celulares
            return 1
        } else {
            return 0
        }
    }
    // Ejecutar la función al cargar la página

    var resultadoAncho = verificarTamanoPantalla();
   	// Ejecutar la función cada vez que la ventana cambie de tamaño
    $(window).resize(function() {
        verificarTamanoPantalla();
    });
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
	$(document).on('change', '#idMetodoRegAnimal', function(){
		idMetodoRegAnimal = $(this).val();
		if(idMetodoRegAnimal===0){

		}else{		
			$.post("../controlador/animal_ctrl.php", {
				action:'selectPadreRegAnimal',
				metodoReg: idMetodoRegAnimal
			}, function(data){
					$("#idPadreAnimal").html(data.listaAnimalMacho);
			}, 'json');
		}
	})
	// Fecha de nacimiento de la vaca
	$(document).on("change", "#fechaNacimientoRegistro",function (){
		// 1. Obtener fechas
		const birthDate = new Date($("#fechaNacimientoRegistro").val());  
		const today = new Date();
		// 2. Calcular diferencia en milisegundos 
		const diffInMs = Math.abs(today - birthDate);
		// 3. Convertir a días
		const diffInDays = diffInMs / (1000 * 60 * 60 * 24); 
		// 4. Calcular años  
		const years = Math.floor(diffInDays / 365);   
		// 5. Calcular meses
		const months = Math.floor((diffInDays % 365) / 30);
		// 6. Mostrar resultados 
		console.log(years + " años y " + months + " meses");
		const info = years + " años y " + months + " meses"
		//const textBox = 
		$("#edadAnimal").val(info)
	});
	// Fecha de nacimiento de la vaca (cajas ocultas)
	$(document).on("change", "#fechaNacimientoRegistro", function () {
		// 1. Obtener fecha de nacimiento y fecha actual
		const birthDate = new Date($("#fechaNacimientoRegistro").val());
		const today = new Date();
		// 2. Calcular la diferencia en años y meses
		let years = today.getFullYear() - birthDate.getFullYear();
		let months = today.getMonth() - birthDate.getMonth();
		let days = today.getDate() - birthDate.getDate();
	
		// 3. Ajustar los meses si es necesario
		if (months < 0) {
			years--;
			months += 12;
		}
		// 4. Ajustar los días si es necesario
		if (days < 0) {
			months--;
			const previousMonth = new Date(today.getFullYear(), today.getMonth(), 0); // último día del mes anterior
			days += previousMonth.getDate(); // sumar los días del mes anterior
			if (months < 0) {
				years--;
				months += 12;
			}
		}
		// 5. Convertir los años a meses y sumar los meses restantes
		const totalMonths = (years * 12) + months;
		// 6. Mostrar el resultado en meses y días
		const info = totalMonths + " meses y " + days + " días";
		console.log(info);
		// 7. Establecer el valor en el campo de texto
		$("#mesesAnimal").val(totalMonths);
		$("#diasAnimal").val(days);
	});
	
	cargarUnidad("#idUnidad_FKRegistro");
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
	function listarRazasCard(){//CARDS RAZA DE PAJILLA
		$.post("../controlador/animal_ctrl.php", {
			action:'listaRazas',
			idEspecie_FKRegistro:$("#idEspecie_FKRegistro").val()
		}, function(data){
				$("#cardRazas").html(data.listaRazas);
		}, 'json');
	}
	function msjOk(msjHelp){
		ok(msjHelp)
	}
	function cargarRazas(selectRaza, idUpEs){
		$.post("../controlador/animal_ctrl.php", {
		action:'selectRazas',
		idEspecie_FKRegistro:idUpEs
		}, function(data){		
			$(selectRaza).html(data.listaRazas);
			$("#botonRaza").show();   //para crear la raza 			
		}, 'json');
	}
	$("#btnModalRaza").click(function(){
		$("#nombreRazaAdd").val("");
		$("#idRazaUpdt").val("");
		$("#nombreRazUpdt").val("");
		$("#idRazaDell").val("");
		$("#nombreRazDell").val("");
		ordenar();
		listarRazasCard();
	});
	$(document).on("click", "#openModalRazaUpdate",function (){
		var idRazaUp = $(this).attr('data-idRazaUpdate');
		$('#idRazaUpdt').val(idRazaUp);
		var nombreRazaUp = $(this).attr('data-nombrerazaUpdate'); 
		$('#nombreRazUpdt').val(nombreRazaUp);
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
		var idRaza = $(this).attr('data-idRaza');
		confirmar(idRaza);
	}); 
	function confirmar(idRazaDelete){
		var idEspeRaz = $("#idEspecie_FKRegistro").val(); 
		alertify.confirm("¿stá seguro de eliminar el registro? ", function (e) {
		if(e){ 
				$.post("../controlador/animal_ctrl.php", {
					action:'killerRaza',
					idRazaDell:idRazaDelete
				}, function(data){
					if(data.restl==1){ 
						ordenar();
						listarRazasCard();
						cargarRazas("#idRaza_FKRegistro", idEspeRaz);
						msjOk(data.msj)						;
					} else { error(data.msj); ordenar(); }	
				}, 'json');
			} else { error("Cancelado el proceso de eliminacion."); }
		}); 
		return false
	}
	$(document).on("click", "#btnUpdtRaza",function (){ 
		var idEspeRaz = $("#idEspecie_FKRegistro").val(); 
		$.post("../controlador/animal_ctrl.php", {
			action:'updRaza',
			idRazaUpdt:$("#idRazaUpdt").val(),
			nombreRazUpdt:$("#nombreRazUpdt").val(),
			idEspecie_FKRegistro:$("#idEspecie_FKRegistro").val()
		}, function(data){
			if(data.restl==1){	
				ok(data.msj);
				listarRazasCard();
				cargarRazas("#idRaza_FKRegistro", idEspeRaz);
				ordenar();
			}else{
				error(data.msj);
			} 
		}, 'json');			
	});
	$("#btnModalEspecie").hide();
	$('#ppNuevoRegistro').on('show.bs.modal', function (e) {
		$("#btnModalEspecie").hide();
		$("#nombreAnimalRegistro").val("");
		$('#idUnidad_FKRegistro').prop('disabled', true);
		$.post("../controlador/animal_ctrl.php", {
			action:'listarAnimalHmebra',
			}, function(data){
				$("#idMadreAnimal").html(data.listaAnimalHembra);			
			}, 'json');
	});
	$(document).on("click", "#btnNewRaza",function (){
		var idEspeRaz = $("#idEspecie_FKRegistro").val(); 
		$.post("../controlador/animal_ctrl.php", {
		action:'guardarRaza',
		idEspecie_FKRegistro:$("#idEspecie_FKRegistro").val(),
		nombreRazaAdd:$("#nombreRazaAdd").val()
		}, function(data){
			if(data.restl==1){
				$("#nombreRazaAdd").val("");
				ok(data.msj);
				ordenar();
				listarRazasCard();
				cargarRazas("#idRaza_FKRegistro", idEspeRaz);
			}else{ error(data.msj); }					
		}, 'json');
	});	
	function limpiar()
		{
			$('#idUnidad_FKRegistro').prop('disabled', true);
			$("#NumchapetaAnimal").val("");
			$("#btnModalEspecie").hide();
			$("#idchapetaAnimal").val("");
			$("#codigoSenaRegistro").val("");
			$("#edadAnimal").val("");
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
			$("#idRaza_FKRegistro").empty();
			$("#idRaza_FKRegistro").val("");
			$("#observacionesRegistro").val("");
		}
	$('.solo-numero').keyup(function (){
		this.value = (this.value + '').replace(/[^0-9]/g, '');
	});
	$.datepicker.setDefaults($.datepicker.regional["es"]);
	flatpickr('#fechaNacimientoRegistro', {});
	function cargarUnidad(selectUni){
		$.post("../controlador/animal_ctrl.php", {
		action:'cargarUnidad'
		}, function(data){
			$(selectUni).html(data.listaUnidad);
			$("#idEspecie_FKRegistro").empty();
			$("#idRaza_FKRegistro").empty();
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
	$('#idUnidad_FKRegistro').prop('disabled', true);
	$('#nombreAnimalRegistro').on('input', function() {
		var texto = $(this).val();
		if (texto === "") {
			$('#idUnidad_FKRegistro').prop('disabled', true);
			$('#idUnidad_FKRegistro').val($('#idUnidad_FKRegistro option:first').val()).trigger('change');;
			// Aquí puedes agregar la acción que deseas realizar cuando la caja está vacía
		} else {
			$('#idUnidad_FKRegistro').prop('disabled', false);
			// Aquí puedes agregar la acción que deseas realizar cuando la caja está llena
		}
	});
	$(document).on('change', '#idUnidad_FKRegistro', function(){
		var valUnidad = $(this).val();
		if(valUnidad==0){
			$("#btnModalEspecie").hide();	
			$("#btnModalRaza").hide();			
		}
		else{
			$("#btnModalEspecie").show();		
		}
		$("#idRaza_FKRegistro").empty();
	});
	$(document).on('change', '#idEspecie_FKRegistro', function(){
		var valEspecie = $(this).val();
		if(valEspecie==0){
			$("#btnModalRaza").hide();			
		}
		else{
			$("#btnModalRaza").show();		
		}
	});
	$('#ppNuevoRegistro').on('hide.bs.modal', function (e) {
		$("#idUnidad_FKRegistro").val(0).trigger('change');
		$("#idRaza_FKRegistro").empty();
		$("#idRaza_FKRegistro").val("");
		$("#btnModalRaza").hide();	
	});

	$('#idUnidad_FKRegistro').on('change', function(){	
		var idUnidadE = $(this).val();
		cargarEspecie("#idEspecie_FKRegistro", idUnidadE);
		$("#divModalEspecies").show(); 
		$.post("../controlador/animal_ctrl.php", {
			action:'selectPredecirChapeta',
			id_unidad_predecir_chapeta:idUnidadE,
			NumchapetaAnimal:$("#NumchapetaAnimal").val(),
			idchapetaAnimal:$("#idchapetaAnimal").val(),
			nombreAnimalRegVacio:$("#nombreAnimalRegistro").val()
			}, function(data){		
				$("#NumchapetaAnimal").val(data.codigoChapetaCreadoSistema);
				$("#idchapetaAnimal").val(data.idChapetaAnim);
			}, 'json');
	});
	$('#idEspecie_FKRegistro').on('change', function(){	
		var idEsp = $(this).val();
		cargarRazas("#idRaza_FKRegistro", idEsp);
	});	
	// $('#btnGuardar').on('click', function(){
	// 	$.post("../controlador/animal_ctrl.php", {
	// 		action:'guardarRegistro',
	// 		fechaRegistro:$("#fechaRegistro").val(),
	// 		fechaNacimientoRegistro:$("#fechaNacimientoRegistro").val(),
	// 		codigoSenaRegistro:$("#codigoSenaRegistro").val(),
	// 		nombreAnimalRegistro:$("#nombreAnimalRegistro").val(),
	// 		colorAnimalRegistro:$("#colorAnimalRegistro").val(),
	// 		pesoAnimalRegistro:$("#pesoAnimalRegistro").val(),
	// 		unidadMedidaRegistro:$("#unidadMedidaRegistro").val(),
	// 		observacionesRegistro:$("#observacionesRegistro").val(),
	// 		idUnidad_FKRegistro:$("#idUnidad_FKRegistro").val(),
	// 		idEspecie_FKRegistro:$("#idEspecie_FKRegistro").val(),
	// 		idRaza_FKRegistro:$("#idRaza_FKRegistro").val(),
	// 		idUsuRegistro:$("#idUsuRegistro").val(),
	// 		//nombreUsuRegistro:$("#nombreUsuRegistro").val(),
	// 		idSexoRegistroAnimalfk:$("#idSexoRegistro").val()
	// 		}, function(data){		
	// 			if(data.restl=="1"){
	// 				alertify.success(data.msj);
	// 				limpiar();
	// 				$("#idUnidad_FKRegistro").val(0);
	// 				$("#btnModalEspecie").hide();
	// 				$("#btnModalRaza").hide();
	// 			}else{ error(data.msj);	}
	// 		}, 'json');			
	// });	
	$('#btnGuardar').on('click', function(){
		$.post("../controlador/animal_ctrl.php", {
			action:'guardarRegistro',
			fechaRegistro:$("#fechaRegistro").val(),
			NumchapetaAnimal:$("#NumchapetaAnimal").val(),
			fechaNacimientoRegistro:$("#fechaNacimientoRegistro").val(),
			codigoSenaRegistro:$("#codigoSenaRegistro").val(),
			nombreAnimalRegistro:$("#nombreAnimalRegistro").val(),
			colorAnimalRegistro:$("#colorAnimalRegistro").val(),
			pesoAnimalRegistro:$("#pesoAnimalRegistro").val(),
			unidadMedidaRegistro:$("#unidadMedidaRegistro").val(),
			observacionesRegistro:$("#observacionesRegistro").val(),
			idUnidad_FKRegistro:$("#idUnidad_FKRegistro").val(),
			idEspecie_FKRegistro:$("#idEspecie_FKRegistro").val(),
			idRaza_FKRegistro:$("#idRaza_FKRegistro").val(),
			idUsuRegistro:$("#idUsuRegistro").val(),
			mesesAnimal:$("#mesesAnimal").val(),
			idSexoRegistroAnimalfk:$("#idSexoRegistro").val(),
			idMetodoRegAnimal:$("#idMetodoRegAnimal").val(),
			idMadreAnimal:$("#idMadreAnimal").val(),
			idPadreAnimal:$("#idPadreAnimal").val(),
			}, function(data){		
				if(data.restl=="1"){
					alertify.success(data.msj);
					limpiar();
					$("#idUnidad_FKRegistro").val(0);
					$("#btnModalEspecie").hide();
					$("#btnModalRaza").hide();
					$("#NumchapetaAnimal").val("");
					$("#idMetodoRegAnimal").val(0);
					$("#idMadreAnimal").val(0);
					$("#idPadreAnimal").empty();
				}else{ error(data.msj);	}
			}, 'json');			
	});	
	////////////////////ACTUALIZAR ANIMAL///////////////////////
	$('#updateAnimal').on('show.bs.modal', function (e) {
		cargarUnidad("#idUnidad_FKRegistroUpdate");	
		
	});
	$('#idUnidad_FKRegistroUpdate').on('change', function(){	
		var idUnidad = $(this).val();
		cargarEspecie("#idEspecie_FKRegistroUpdate", idUnidad);
	});
	$('#idEspecie_FKRegistroUpdate').on('change', function(){	
		var idEspU = $(this).val();
		cargarRazas("#idRaza_FKRegistroUpdate", idEspU);
	});
	flatpickr('#fechaNacimientoRegistroUpdate', {});
	$(document).on('click', '#btnEdiarAnimal', function(){
		var idAnimalUpdate = $(this).attr('data-idAnimal');
		$("#idAnimalUp").val(idAnimalUpdate);
		$.post("../controlador/animal_ctrl.php", {
			action:'llenarDatosFromAnimal',
			idAnimalLLenarFrom:idAnimalUpdate 
		},
		function (data) {  
			$("#fechaRegistroUpdate").val(data.fechaRegistro);
			$("#fechaNacimientoRegistroUpdate").val(data.fechaNacimiento);
			$("#codAnimalRegistroUpdate").val(data.codAnimal);
			$("#codigoSenaRegistroUpdate").val(data.codigoSena);
			$("#nombreAnimalRegistroUpdate").val(data.nombreAnimal);
			$("#colorAnimalRegistroUpdate").val(data.colorAnimal);
			$("#pesoAnimalRegistroUpdate").val(data.pesoAnimal);
			$("#unidadMedidaRegistroUpdate").val(data.unidadMedida).trigger('change');
			$("#observacionesRegistroUpdate").val(data.observaciones);
			setTimeout(() => {
				$("#idUnidad_FKRegistroUpdate").val(data.idUnidad_FK).trigger('change');
			}, 1000);
			setTimeout(() => {
				$("#idEspecie_FKRegistroUpdate").val(data.idEspecie_FK).trigger('change');
			}, 1100);
			setTimeout(() => {
				$("#idRaza_FKRegistroUpdate").val(data.idRaza_FK).trigger('change');
			}, 1200);
			$("#idSexoRegistroUpdate").val(data.idSexo).trigger('change');
		},'json')
	})
	$(document).on('click', '#btnUpdateAnimal', function () {  
		$.post("../controlador/animal_ctrl.php", {
			action:'updateAnimal',
			fechaNacimientoRegistroUpdate:$("#fechaNacimientoRegistroUpdate").val(),
			codigoSenaRegistroUpdate:$("#codigoSenaRegistroUpdate").val(),
			nombreAnimalRegistroUpdate:$("#nombreAnimalRegistroUpdate").val(),
			colorAnimalRegistroUpdate:$("#colorAnimalRegistroUpdate").val(),
			pesoAnimalRegistroUpdate:$("#pesoAnimalRegistroUpdate").val(),
			unidadMedidaRegistroUpdate:$("#unidadMedidaRegistroUpdate").val(),
			observacionesRegistroUpdate:$("#observacionesRegistroUpdate").val(),
			idUnidad_FKRegistroUpdate:$("#idUnidad_FKRegistroUpdate").val(),
			idEspecie_FKRegistroUpdate:$("#idEspecie_FKRegistroUpdate").val(),
			idRaza_FKRegistroUpdate:$("#idRaza_FKRegistroUpdate").val(),
			idUsuRegistroUpdate:$("#idUsuRegistroUpdate").val(),
			//nombreUsuRegistro:$("#nombreUsuRegistro").val(),
			idSexoRegistroAnimalfkUpdate:$("#idSexoRegistroUpdate").val(),
			idAnimalUp:$("#idAnimalUp").val()
			}, function(data){		
				if(data.restl=="1"){
					alertify.success(data.msj);
				}else{ error(data.msj);	}
			}, 'json');			
	})
	////////////////////FIN ACTUALIZAR ANIMAL///////////////////
	$(document).on("focus", "#dato_txt",function (){ $("#divRespuestasPanel").empty(); $('#listaEncontrada').empty();});
	$("#btnUpdtRazaEsc").click(function(){ ordenar(); }); 
	$("#btnDellRazaEsc").click(function(){ ordenar(); }); 
	$("#btn_Buscar").click(function(){
		if($("#dato_txt").val()==""){
			error("DEBE INGRESAR TEXTO A BUSCAR.");
		}else{
			$.post("../controlador/animal_ctrl.php", {
				action:'listarAnimales',
				dato_txt:$("#dato_txt").val(),
				tamanoPantalla:resultadoAncho
			}, function(data){
				$('#divRespuestasPanel').empty();
				$('#listaEncontrada').empty(); 
				if(data.result==1){ $("#example").html(data.listaAnimales);
					verificarTamanoPantalla();
				}
				else { error(data.msj);  }		
			}, 'json');
		}	
	});
	ordenar();
});	