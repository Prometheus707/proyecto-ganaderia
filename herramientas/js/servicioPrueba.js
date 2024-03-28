$(document).ready(function(){
	$("#selectMetodos option[value=0]").attr("selected",true);
	$("#DivMetodo").hide(500); 
	$("#selectMetodos").hide(500); 
	$("#infoToro").hide(500); 
	$("#divBtnPajilla").hide(500); 
	/*  inicio recibe el codigo del anibal seleccionado  */
	$(document).on("click", "#btnListarCelo", function (){
		var idAnimal = $("#idVacaForm").val();	
		alertify.success(idAnimal);
		$.post("../controlador/reproduccionctrl.php", {
			action:'listarCelosA',
			idAnimal:idAnimal
			}, function(data){
				alertify.error("data llegoooooooo: ",data);
				if(data.result==1){ 
					$("#listadoDelCelo").html(data.listarCeloAnimales);
					alertify.error(data.nombreAnimalHembraCelo)
					$("#nombreHembraC").text(data.nombreAnimalHembraCelo);
				}
				else { 
					alertify.error(data.msj); 
				}		
			}, 'json');
	});	

	function actualizarListaMonta (){
		var idAnimalListCelo = $("#idVacaForm").val();	
		$.post("../controlador/reproduccionctrl.php", {
			action:'arregloMonta',
			idAnimalListCelo:idAnimalListCelo
			},function(data){
				
				if(data.tabsMonta !== undefined){ 
				    // 	$("#listadoDelCelo").html(data.listarCeloAnimales);
					$("#listCel").html(data.tabsMonta);
				}
				else { 
					alertify.error(data.msj); 
				}		
			}, 'json');
	}
	function actualizarListaInseminacion(){
		var idAnimalListCelo = $("#idVacaForm").val();	
		alertify.success("codigo de vaca es: " + idAnimalListCelo)
		$.post("../controlador/reproduccionctrl.php", {
			action:'arregloInseminacion',
			idAnimalListCeloI:idAnimalListCelo
			},function(data){
				
				if(data.tabsInseminacion !== undefined){ 
				    // 	$("#listadoDelCelo").html(data.listarCeloAnimales);
					$("#listCel").html(data.tabsInseminacion);
				}
				else { 
					alertify.error(data.msj); 
				}		
			}, 'json');
	}
	function actualizarListaNoServido(){
		var idAnimalListCelo = $("#idVacaForm").val();	
		$.post("../controlador/reproduccionctrl.php", {
			action:'arregloNoservidos',
			idAnimalListCeloNo:idAnimalListCelo
			},function(data){
				
				if(data.tabsNoServidos !== undefined){ 
				    // 	$("#listadoDelCelo").html(data.listarCeloAnimales);
					$("#listCel").html(data.tabsNoServidos);
				}
				else { 
					alertify.error(data.msj); 
				}		
			}, 'json');
	}

	function totalCelosF(){
		var idAnimalListCelo = $("#idVacaForm").val();	
		$.post("../controlador/reproduccionctrl.php", {
			action:'numCelosF',
			idAnimalTtlF:idAnimalListCelo 
			},function(data){
				$("#totalServicio").text(data.ttlServicioF);
				
				if(data.ttlServicioF > 0){
					$('#listarMonta').show('slow');
					$('#listarInseminacion').show('slow');
					$('#listarCelosNo').show('slow');
					$('#Title_celos').show('slow');
				}
				else{
					$('#listarMonta').hide(500);
					$('#listarInseminacion').hide(500);
					$('#Title_celos').hide(500);
					$('#listarCelosNo').hide(500);
					$("#listCel").html("<center><h5><strong>Los botones aparecerán cuando haya celos!!!</strong></h5></center>");
				}
			}, 'json');
	}

	function actualizarCardPajilla(){
		//alertify.success("entramos a pajillaaa");
		$.post("../controlador/reproduccionctrl.php", {
			action:'arregloPajillaCel',
			},function(data){
				if(data.tabsPajilla !== undefined){ 
				    // 	$("#listadoDelCelo").html(data.listarCeloAnimales);
					$("#cardPajillas").html(data.tabsPajilla);
				}
				else { 
					alertify.error(data.msj); 
				}		
			}, 'json');
	}
	
	
	$('#listarMonta').on('click', function() { 
		actualizarListaMonta ();
	});
	$('#listarInseminacion').on('click', function() { 
		actualizarListaInseminacion();
	});
	$('#listarCelosNo').on('click', function() { 
		actualizarListaNoServido();
	});
	//ELIMINAR PAJILLA
	$(document).on('click', '#btnEliminarCardPajilla', function(){
		var datPajiId = $(this).attr('data-pajillaId') //INGRESA A LOS ATRIBUTOS DEL BOTON
		
		if (confirm("¿Estás seguro de que deseas eliminar este registro?")) {
			$.post("../controlador/reproduccionctrl.php", {
				action: 'eliminarRegistroPajilla',
				datPajiId: datPajiId
			}, function(data) {
				if (data.resultd == "1") {
					alertify.success(data.msj);
					actualizarCardPajilla();
					$("#nomToro").val("");
					$("#razToro").val("");
					$("#nomToro").val("");
					recargar();
				} else {
					alertify.error(data.msj);
				}
			}, 'json');
			
		}
	});


	//ELIMINAR CELO
	$(document).on('click', '#btnEliminarCardCel', function(){
		var idCeloRepA = $(this).attr('data-idReproduccion');
		var dataTipoCel = $(this).attr('data-tipo');
		//alertify.success( "el id del celo es: " + idCeloRepA);
			if (dataTipoCel == 1){
				if (confirm("¿Estás seguro de que deseas eliminar este registro?")) {
					$.post("../controlador/reproduccionctrl.php", {
						action: 'eliminarRegistroCelo',
						idCeloRepA: idCeloRepA
					}, function(data) {
						if (data.resultd == "1") {
							alertify.success(data.msj);
							actualizarListaMonta();
							totalCelosF();
							
						} else {
							alertify.error(data.msj);
						}
					}, 'json');
				}
			}
			else{
				if(dataTipoCel==2){
					if (confirm("¿Estás seguro de que deseas eliminar este registro?")) {
						$.post("../controlador/reproduccionctrl.php", {
								action:'eliminarRegistroCelo',
								idCeloRepA : idCeloRepA
								},function(data){
									if(data.resultd=="1"){ 
										// 	$("#listadoDelCelo").html(data.listarCeloAnimales);
										alertify.success(data.msj);
										actualizarListaInseminacion();
										totalCelosF();
										
									}
									else { 
										alertify.error(data.msj); 
									}		
								}, 'json');
					}
				}
				else{
					if (confirm("¿Estás seguro de que deseas eliminar este registro?")) {
						$.post("../controlador/reproduccionctrl.php", {
							action:'eliminarRegistroCelo',
							idCeloRepA : idCeloRepA
							},function(data){
								if(data.resultd=="1"){ 
									// 	$("#listadoDelCelo").html(data.listarCeloAnimales);
									alertify.success(data.msj);
									actualizarListaNoServido();
									totalCelosF();
									
								}
								else { 
									alertify.error(data.msj); 
								}		
							}, 'json');
					}
				}
			}
	});
	$('#addPajilla').on('shown.bs.modal', function() {
		actualizarCardPajilla();
		
	});
	$(document).on("change", "#razaListaPajilla",function () {
		// alert($(this).val())
		var idRz = $("#razaListaPajilla").val();
		alertify.success(idRz);
		$("#idRazaP").val(idRz);
		
	});
	$(document).on("change", "#razaListaPajillaA",function () {
		//alert($(this).val())
		var idRz = $(this).val();
		alertify.success(idRz);
		$("#idRazaPA").val(idRz);
		
		$.post("../controlador/reproduccionctrl.php", {
			action: 'eliminarRegistroCelo',
			idCeloRepA: idCeloRepA
		}, function(data) {
			if (data.resultd == "1") {
				alertify.success(data.msj);
				actualizarListaMonta();
				totalCelosF();
			} else {
				alertify.error(data.msj);
			}
		}, 'json');
	});
	$(document).on("click", "#btnPajila",function () {
			$.post("../controlador/reproduccionCtrl.php", {
			action:'buscarRazas',
			}, function(data){
					$("#razaListaPajilla").html(data.listaRaza);
					$("#idRazaP").val(data.idRaza);
			}, 'json');
	});
	$(document).on("click", "#btnActualizarCardPajilla",function () {
		//alert("actualizarrrr");
		$.post("../controlador/reproduccionCtrl.php", {
		action:'buscarRazas',
		}, function(data){
				$("#razaListaPajillaA").html(data.listaRaza);
		}, 'json');


		
		// $.post("../controlador/reproduccionCtrl.php", {
		// 	action:'buscarRazas',
		// 	}, function(data){
		// 			$("#razaListaPajillaA").html(data.listaRaza);
		// 	}, 'json');
	});

	$(document).on("click", "#btnActualizarCardPajilla",function () {
			const idPajiUpdate = $(this).attr('data-pajillaIdUpdate')
			

			$.post("../controlador/reproduccionCtrl.php", {
				action:'buscarCeloUpdate',
				idPajiUpdate:idPajiUpdate
				}, function(data){
						$("#idPaUpdate").val(data.idPajlaUp);
						$("#numeroRegistroRA").val(data.numeroRegistroPa);
						$("#nombreToroRA").val(data.nombreToroPa);
						$("#razaListaPajillaA").val(data.razaListaPajillaAid);
						$("#idRazaPA").val(data.razaListaPajillaAid);
				}, 'json');
	});
	
	function eliminarTablaCelo() {
        $('#listCel').empty();
    }
	$(document).on("click", "#divChekeo", function (){
		eliminarTablaCelo();
	});
	function oculCampCel(){
		$("#infoToro").hide(500);
		$("#DivMetodo").hide(500);
		$("#divTlRep").hide(500);
		$("#selectMetodos").hide(500);
		$("#selectServido").val(0);
		$("#selectMetodos").val(0);
		$("#nombreToro").hide(500);
		$("#razaToro").hide(500);
		$("#codigoRegistroT").find('option').remove().end();
		$("#divBtnPajilla").hide(500);
		//CAMPOS DE PAJILLA
		$("#numeroRegistroR").val("");
		$("#nombreToroR").val("");
		$("#razaPajilla").val("");
	}	
	$('#mdreproduccion').on('shown.bs.modal', function() {
		var numeroCelosAnima = $("#totalServicio").text();
		var numCelA = parseInt(numeroCelosAnima);
		if (numCelA > 0){
			alertify.success(numCelA);
			$('#listarMonta').show('slow');
			$('#listarInseminacion').show('slow');
			$('#listarCelosNo').show('slow');
			$('#Title_celos').show('slow');
		}else{
			if (numCelA == 0){
				$('#listarMonta').hide(500);
			$('#listarInseminacion').hide(500);
			$('#Title_celos').hide(500);
			$('#listarCelosNo').hide(500);
			$("#listCel").html("<center><h5><strong>Los botones aparecerán cuando haya celos!!!</strong></h5></center>");
			}
		}
		oculCampCel();
	});
	/*  cierre recibe el codigo del anibal seleccionado  */		
	$(document).on("change", "#selectServido",function (){  //YO NO TOQUE NADA
		var varservido = $(this).val();
		if(varservido==1){ 
			$("#DivMetodo").show('slow');
			$("#selectMetodos").show('slow'); 
			$("#nombreToro").show("slow");
			$("#razaToro").show("slow");
		}else{ 
			$("#DivMetodo").hide(500);
			$("#selectMetodos").hide(500); 
			$("#infoToro").hide(500);
			$("#datosRepTitulo").hide(500);
			$("#nombreToro").hide(500);
			$("#razaToro").hide(500);
			$("#divBtnPajilla").hide(500);
			$("#observacionesRep").show("slow");
			$("#codigoRegistroT").find('option').remove().end();
			$("#codigoRegistroT").val()==""; 
			$("#codigoRegistroT").val("");
			$("#nomToro").val("");
			$("#razToro").val("");
			$("#idRazaServ").val("");
			$("#idToroServ").val(""); 
			$("#selectMetodos option:eq(0)").prop("selected", true);
		}
	});
	$(document).on("change", "#selectMetodos",function (){ //YO NO TOQUE NADA
		var metodosRep = $(this).val();
		// alert(metodosRep);
		$.post("../controlador/reproduccionctrl.php", {
		action:'listarTipo',
		tipoEnsiminacion: metodosRep 
			}, function(data){
			$("#codigoRegistroT").html(data.tipo);		
			}, 'json');
		if ( metodosRep == 1 || metodosRep == 2 || metodosRep == 0 ){
			$("#nomToro").val("");
			$("#razToro").val("");
			$("#idRazaServ").val("");
			$("#idToroServ").val("");
		}       
	}); 
	$('#selectMetodos').on('change', function() {
		opcionCelInsm = $('#selectMetodos').val()
		if (opcionCelInsm == 1){
			$('#divBtnPajilla').hide(500);
			$('#infoToro').show('slow');
			$('#datosRepTitulo').show('slow');
			$("#divTlRep").show('slow');
		}
		else{
			if(opcionCelInsm == 2){
				$('#divBtnPajilla').show('slow');
				$('#btnPajila').show('slow');
				$('#infoToro').show('slow');
				$('#datosRepTitulo').show('slow');
				$("#divTlRep").show('slow');
			}
			else{
				if(opcionCelInsm == 0){
					$('#infoToro').hide(500);
					$('#datosRepTitulo').hide(500);
					$('#divBtnPajilla').hide(500);
				}
			}
		}
	});
	 //MIRAR QUE METODO ESCOGIO MONTA/INSEMINACION
	$('#codigoRegistroT').on('change', function() {
		var estado = $('#selectMetodos').val();
		// alert('esatado = '+estado); 
		if(estado == 1){
			cargarSelectMonta();
		}
		else{
			cargarSelectPajilla();
		}
	});
	function cargarSelectMonta(){
		//alert("llenar con monta");
		$.post("../controlador/reproduccionctrl.php", {
		action:'cargarServicio',
		idanimals:$("#codigoRegistroT").val()
		}, function(data){
			$("#nomToro").val(data.nombreAnimal);	
			$("#idToroServ").val(data.idAnimal);	  
			$("#razToro").val(data.nombreRaza);	
			$("#idRazaServ").val(data.idRaza_FK);	
		}, 'json'); 
    }
	function cargarSelectPajilla(){
		//alert("llenar con inseminacion");
		$.post("../controlador/reproduccionctrl.php", {
		action:'cargarServicioPjailla',
		numReg:$("#codigoRegistroT").val()
		}, function(data){
			$("#nomToro").val(data.nombrePajilla);	
			$("#idToroServ").val(data.idPajilla);	  
			$("#razToro").val(data.nombreRazaP);	
			$("#idRazaServ").val(data.numrazaPajilla);	
		}, 'json');
	}
	function recargar(){
		$.post("../controlador/reproduccionctrl.php", {
			action:'listarTipo',
			tipoEnsiminacion:$("#selectMetodos").val()
			}, function(data){
				$("#codigoRegistroT").html(data.tipo);
			}, 'json');
	}
	///////////////////////////GUARDAR PAJILLA////////////////////////////////////
	$(document).on("click", "#btnGuardarPajilla",function (){
		$.post("../controlador/reproduccionctrl.php", {
			action:'guardarPajilla',	
				fechRegPaji:$("#fechaRegistroP").val(),						
				numeroRegistroR:$("#numeroRegistroR").val(),
				nombreToroP:$("#nombreToroR").val(),
				idRespRegP:$("#idUsuRegistroCel").val(),
				idrazaToroP:$("#idRazaP").val()
				}, function(data){
					if(data.resultd=="1")
					{   
						$("#numeroRegistroR").val("");
						$("#nombreToroR").val("");
						$("#razaListaPajilla").val("0");
						$("#razaToroR").val(""); 
						alertify.success(data.msj);
						// setTimeout(function(){
						// 	$("#cerrarPajilla").trigger("click");
						// },300);
						actualizarCardPajilla();
						recargar();	
					} else
					{	
						alertify.error(data.msj);		
					}
			}, 'json');                  
	});
	////////////////////////////GUARDAR CELO SERVICIOS////////////////////////
	$(document).on("click", "#btnActualizarPajilla",function (){
		var datPajiIdU = $("#idPaUpdate").val(); //INGRESA A LOS ATRIBUTOS DEL BOTON
		//alertify.success("numero pajila a actuaolizar es: " + datPajiIdU)
		//alertify.success("click actualizar jsjsj");
		$.post("../controlador/reproduccionctrl.php", {
			action:'actualizarPajilla',
			fechaRegPaUp : $("#fechaRegistroPA").val(),
			datPajiIdU : datPajiIdU,
			numRegUpPa: $("#numeroRegistroRA").val(),
			nombretUpd:$("#nombreToroRA").val(),
			razSelPaUp:$("#idRazaPA").val()
			}, function(data){
				if(data.resultd=="1")
					{   
						$("#numeroRegistroRA").val("");
						$("#nombreToroRA").val("");
						$("#razaListaPajillaA").val("");
						$("#idRazaPA").val(""); 
						alertify.success(data.msj);
						setTimeout(function(){
							$("#cerrarPajillaActu").trigger("click");
							actualizarCardPajilla();
						},300);
					} else
					{	
						alertify.error(data.msj);		
					}
			}, 'json');
	});
	// $('#btnGP').on('click', function() {  alert("hola"); });
	$('#btnguardarCelo').on('click', function() { 
		if($("#selectServido").val()=="0"){ alertify.error("Debe seleccionar si esta servido o no");	}
		if($("#selectServido").val()=="1")
		{
			$.post("../controlador/reproduccionctrl.php", {
			action:'guardarCheckCompleto',									
			codVaca:$("#idVacaForm").val(),
			//nombeVaca:$("#nombreVacaR").val(),
			//razaVaca:$("#idRazaV").val(),
			fechCelo:$("#fechaCeloVaca").val(),
			servicio:$("#selectServido").val(),
			metodoRep:$("#selectMetodos").val(),
			codigoTorP:$("#codigoRegistroT").val(),
			//nombreTorP:$("#nomToro").val(),
			//razaTorP:$("#idRazaServ").val(),
			//ResponsableRep:$("#idresponsableRep").val(),
			observacionesRep:$("#observacionesRep").val(),
			idRespCelo:$("#idUsuRegistroCel").val()
			}, function(data){
			if(data.resultd=="1"){   
				$("#nombreVacaR").val("");
				$("#razaVacaR").val("");//LIMPIAR CAJA DE TEXTO CUANDO SE GUARDE
				$("#idRazaV").val("");
				$("#fechaCeloVaca").val("");
				$("#selectServido").val("");
				$("#selectMetodos").val("");
				$("#codigoRegistroT").val("");
				$("#idToroServ").val("");                           
				$("#nomToro").val("");
				$("#razToro").val("");
				$("#idRazaServ").val("");
				$("#responsableRep").val("");
				$("#idresponsableRep").val("");
				$("#observacionesRep").val("");
				alertify.success(data.msj);
					setTimeout(function(){
						$("#btncerrarReproduccion").trigger("click");
						location.reload();
					},300);
				//listarServicioT();
				}else{	alertify.error(data.msj);	}
			}, 'json'); 
		}
		if($("#selectServido").val()=="2"){              
			$.post("../controlador/reproduccionctrl.php", {
			action:'guardarCheck',
			// se envia al controlador
			codVaca:$("#idVacaForm").val(),
			//nombeVaca:$("#nombreVacaR").val(),
			//razaVaca:$("#idRazaV").val(),
			fechCelo:$("#fechaCeloVaca").val(),
			servicio:$("#selectServido").val(),
			//ResponsableRep:$("#idresponsableRep").val(),
			observacionesRep:$("#observacionesRep").val(),
			idRespCelo:$("#idUsuRegistroCel").val()
			}, function(data){                      
				if(data.resultd=="1"){  
					$("#nombreVacaR").val(""),
					$("#idAnimal").val(""),
					$("#razaVacaR").val(""),//LIMPIAR CAJA DE TEXTO CUANDO SE GUARDE
					$("#idRazaV").val(""),
					$("#fechaCeloVaca").val(""),
					$("#selectServido").val(""),
					$("#responsableRep").val(""),
					$("#idresponsableRep").val(""),
					$("#observacionesRep").val("");
					alertify.success(data.msj);
					setTimeout(function(){
					$("#btncerrarReproduccion").trigger("click");
					location.reload();
					},300);
					listarServicioT();
				}else{	alertify.error(data.msj);	}
			}, 'json'); 				
		}
	});
});