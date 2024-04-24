$(function(){

	/////////////////////////*ACTUALIZACION DE CELOS*////////////////////////
	 //MIRAR QUE METODO ESCOGIO MONTA/INSEMINACION
	// $("#fechaCeloVacaUpdate").datepicker({
	// 	dateFormat: "yy-mm-dd"	
	// });
	flatpickr('#fechaCeloVacaUpdate', {});
	$(document).on("change", "#selectServidoUpdate",function (){  //YO NO TOQUE NADA
		var varservido = $(this).val();
		if(varservido==1){ 
			$("#DivMetodoUpdate").show('slow');
			$("#selectMetodosUpdate").show('slow'); 
			$("#nombreToroUpdate").show("slow");
			$("#razaToroUpdate").show("slow");
		}else{ 
			$("#DivMetodoUpdate").hide(500);
			$("#selectMetodosUpdate").hide(500); 
			$("#infoToroUpdate").hide(500);
			$("#datosRepTituloUpdate").hide(500);
			$("#nombreToroUpdate").hide(500);
			$("#razaToroUpdate").hide(500);
			$("#divBtnPajillaUpdate").hide(500);
			$("#observacionesRepUpdate").show("slow");
			//$("#codigoRegistroTUpdate").find('option').remove().end();
			// $("#codigoRegistroTUpdate").val()==""; 
			// $("#codigoRegistroTUpdate").val("");
			$("#nomToroUpdate").val("");
			$("#razToroUpdate").val("");
			$("#idRazaServUpdate").val("");
			$("#idToroServUpdate").val(""); 
			$("#selectMetodosUpdate option:eq(0)").prop("selected", true);
		}
	});
	$(document).on("change", "#selectMetodosUpdate",function () {
		opcionCelInsm = $('#selectMetodosUpdate').val()
		if (opcionCelInsm == 1){
			$('#divBtnPajillaUpdate').hide(500);
			$('#infoToroUpdate').show('slow');
			$('#datosRepTituloUpdate').show('slow');
			$("#divTlRepUpdate").show('slow');
		}
		else{
			if(opcionCelInsm == 2){
				$('#divBtnPajillaUpdate').show('slow');
				$('#btnPajilaUpdate').show('slow');
				$('#infoToroUpdate').show('slow');
				$('#datosRepTituloUpdate').show('slow');
				$("#divTlRepUpdate").show('slow');
			}
			else{
				if(opcionCelInsm == 0){
					$('#infoToroUpdate').hide(500);
					$('#datosRepTituloUpdate').hide(500);
					$('#divBtnPajillaUpdate').hide(500);
				}
			}
		}
	});

	
	//$('#codigoRegistroTUpdate').on('change', function() {
	$(document).on("change", "#codigoRegistroTUpdate",function () {
		var estado = $('#selectMetodosUpdate').val();
		// alert('esatado = '+estado); 
		if(estado == 1){
			cargarSelectMontaUpdate();
		}
		else{
			cargarSelectPajillaUpdate();
		}
	});
	function cargarSelectMontaUpdate(){
		//alert("llenar con monta");
		$.post("../controlador/reproduccionctrl.php", {
		action:'cargarServicio',
		idanimals:$("#codigoRegistroTUpdate").val()
		}, function(data){
			$("#nomToroUpdate").val(data.nombreAnimal);	
			$("#idToroServUpdate").val(data.idAnimal);	  
			$("#razToroUpdate").val(data.nombreRaza);	
			$("#idRazaServUpdate").val(data.idRaza_FK);	
		}, 'json'); 
    }
	function cargarSelectPajillaUpdate(){
		//alert("llenar con inseminacion");
		$.post("../controlador/reproduccionctrl.php", {
		action:'cargarServicioPjailla',
		numReg:$("#codigoRegistroTUpdate").val()
		}, function(data){
			$("#nomToroUpdate").val(data.nombrePajilla);	
			$("#idToroServUpdate").val(data.idPajilla);	  
			$("#razToroUpdate").val(data.nombreRazaP);	
			$("#idRazaServUpdate").val(data.numrazaPajilla);	
		}, 'json');
	}
	
	$(document).on("click", "#btnActualizarCardCelo",function () {
		
		const tipCeloUpdate = $(this).attr("data-tipo-update")
		const idcelUpdate = $(this).attr('data-idReproduccionCeloUpdate')
		$("#idCeloFormUpdate").val(tipCeloUpdate);
		$("#idCeloBdUpdate").val(idcelUpdate);
		//alertify.success("el celo que se esocgio es: "+ tipCeloUpdate)
		//alertify.success("el id del celo a actualizar es: " + idcelUpdate);
		$.post("../controlador/reproduccionCtrl.php", {
			action:'buscarCeloUpdate',
			idcelUpdate : idcelUpdate,
			tipCeloUpdate:tipCeloUpdate
			}, function(data){
				// console.log(data);
				// alertify.success("el val del numeroR:" + data.numeroRegistroMUpda)

				if (tipCeloUpdate == 1 || tipCeloUpdate == 2){
					$("#fechaCeloVacaUpdate").val(data.fechaCeloUp);
					$("#selectServidoUpdate").val(data.servidoUp).trigger('change');
					$("#selectMetodosUpdate").val(data.metodoRepUp).trigger('change');
					$("#codigoRegistroTUpdate").val(data.numeroRegistroMUpda).trigger('change');
					setTimeout(function(){
						$("#codigoRegistroTUpdate").val(data.numeroRegistroMUpda).trigger('change');
					},300);
					$("#observacionesRepUpdate").val(data.observacionesServUp);
				}
				else{
					$("#fechaCeloVacaUpdate").val(data.fechaCeloUp);
					$("#selectServidoUpdate").val(data.servidoUp).trigger('change');
					$("#observacionesRepUpdate").val(data.observacionesServUp);
				}
			}, 'json');
	});
	$(document).on("change", "#selectMetodosUpdate",function (){ //YO NO TOQUE NADA
		var metodosRep = $(this).val();
		// alert(metodosRep);
		$.post("../controlador/reproduccionctrl.php", {
		action:'listarTipo',
		tipoEnsiminacion: metodosRep 
			}, function(data){
			$("#codigoRegistroTUpdate").html(data.tipo);		
			}, 'json');
		if (metodosRep == 0 || metodosRep == 1 || metodosRep == 2){
			$("#nomToroUpdate").val("");
			$("#razToroUpdate").val("");
			$("#idRazaServUpdate").val("");
			$("#idToroServUpdate").val("");
		}       
	}); 


	$(document).on("click",'#btnUpdateCelo', function(){
		
		if($("#selectServidoUpdate").val()=="0"){ alertify.error("Debe seleccionar si esta servido o no");	}
		if($("#selectServidoUpdate").val()=="1")
		{
			idCeloFormUpdateUp = $("#idCeloBdUpdate").val();
			//alertify.success("si esta servidddppdpdpdpd con codigo de celo: " + idCeloFormUpdateUp);
			$.post("../controlador/reproduccionctrl.php", {
			action:'actualizarCheckCompleto',									
			codVacaUpdate:$("#idVacaFormUpdate").val(),
			//nombeVaca:$("#nombreVacaR").val(),
			//razaVaca:$("#idRazaV").val(),
			fechCeloUpdate:$("#fechaCeloVacaUpdate").val(),
			servicioUpdate:$("#selectServidoUpdate").val(),
			metodoRepUpdate:$("#selectMetodosUpdate").val(),
			codigoTorPUpdate:$("#codigoRegistroTUpdate").val(),
			//nombreTorP:$("#nomToro").val(),
			//razaTorP:$("#idRazaServ").val(),
			//ResponsableRep:$("#idresponsableRep").val(),
			idCeloFormUpdateUp: idCeloFormUpdateUp,
			observacionesRepUpdate:$("#observacionesRepUpdate").val(),
			idRespCeloUpdate:$("#idUsuRegistroCelUpdate").val()
			}, function(data){
				if(data.resultd=="1"){   
					 alertify.success(data.msj);
					if ($("#selectMetodosUpdate").val() == 1) {
						//alertify.success("Se actualizo monta");
						//$("#btnCerrarUpdateCerlo").trigger("click");
						
						actualizarListaMonta ();
					} else if ($("#selectMetodosUpdate").val() == 2) {
						//alertify.success("se actualizo inseminacion");
						//$("#btnCerrarUpdateCerlo").trigger("click");
						
						actualizarListaInseminacion();
					}
					
					Z//$('#btnCerrarUpdateCerlo').trigger('click');
					
				}else{	
					alertify.error(data.msj);	
				}
			}, 'json'); 
		}
		
		if($("#selectServidoUpdate").val()=="2"){  
		
			idCeloFormUpdate = $("#idCeloBdUpdate").val();
			//alertify.success("no esta servidddppdpdpdpd");  
			alertify.success("el id del celo de no servido es: "+idCeloFormUpdate)    
			$("#selectMetodosUpdate option[value=0]").attr("selected",true);
			$.post("../controlador/reproduccionctrl.php", {
				action:'actualizarCheck',
				// se envia al controlador
				codVacaUpNo:$("#idVacaFormUpdate").val(),
				//nombeVaca:$("#nombreVacaR").val(),
				//razaVaca:$("#idRazaV").val(),
				idCeloFormUpdate:idCeloFormUpdate,
				fechCeloUpNo:$("#fechaCeloVacaUpdate").val(),
				servicioUpNo:$("#selectServidoUpdate").val(),
				//ResponsableRep:$("#idresponsableRep").val(),
				observacionesRepUpNo:$("#observacionesRepUpdate").val(),
				idRespCeloUpNo:$("#idUsuRegistroCelUpdate").val()
				
			}, function(data){                      
				if(data.resultd=="1"){  
					alertify.success(data.msj);
					setTimeout(function(){
						//alert("cerrando modallll update");
						
						//$('#mdreproduccionUpdate').modal('hide');
						actualizarListaNoServido()
					},300);
					
					//$('#btnCerrarUpdateCerlo').trigger('click');
					//listarServicioT();
				}else{	
					alertify.error(data.msj);	
				}
			}, 'json'); 				
		}
	});
/////////////////////////////*ACTUALIZACION DE CELOS FIN*///////////////////





////////////////////////////*REGISTRO DE CELOS*//////////////////////////////
	$("#selectMetodos option[value=0]").attr("selected",true);
	$("#DivMetodo").hide(500); 
	$("#selectMetodos").hide(500); 
	$("#infoToro").hide(500); 
	$("#divBtnPajilla").hide(500); 
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
		//alertify.success("codigo de vaca es: " + idAnimalListCelo)
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
					//$("#listCel").empty();
				}
				else{
					$('#listarMonta').hide(500);
					$('#listarInseminacion').hide(500);
					$('#Title_celos').hide(500);
					$('#listarCelosNo').hide(500);
					$("#listCel").html("<center><h5><strong>No hay celos!!!</strong></h5></center>");
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
							// setTimeout(() => {
							// 	actualizarListaMonta();
							// }, 100);
							
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
										// setTimeout(() => {
										// 	actualizarListaInseminacion();
										// }, 100);
										
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
									// setTimeout(() => {
									// 	actualizarListaNoServido();
									// }, 100);
									
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
		
	});
	$(document).on("click", "#btnPajila",function () {
		llenarRazPajilla("#razaListaPajilla");
	});
	function llenarRazPajilla(idLlenaRaza){
		$.post("../controlador/reproduccionCtrl.php", {
			action:'buscarRazas',
			}, function(data){
					$(idLlenaRaza).html(data.listaRaza);
			}, 'json');
	}
	$(document).on("click", "#btnActualizarCardPajilla",function () {
			llenarRazPajilla("#razaListaPajillaA");
			const idPajiUpdate = $(this).attr('data-pajillaIdUpdate')
			$.post("../controlador/reproduccionCtrl.php", {
				action:'buscarPajillaUpdate',
				idPajiUpdate:idPajiUpdate
				}, function(data){
						$("#idRazaPA").val(data.razaListaPajillaAid).trigger('change');
						$("#idPaUpdate").val(data.idPajlaUp);
						$("#numeroRegistroRA").val(data.numeroRegistroPa);
						$("#nombreToroRA").val(data.nombreToroPa);
						$("#razaListaPajillaA").val(data.razaListaPajillaAid);
						setTimeout(function() {
							$("#idRazaPA").val(data.razaListaPajillaAid).trigger('change');//id pone el id , pero no se pone en el select aveces
						},300);
						setTimeout(function() {
							$("#razaListaPajillaA").val(data.razaListaPajillaAid);//id pone el id , pero no se pone en el select aveces
						},400);
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
			//alertify.success(numCelA);
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
				$("#listCel").html("<center><h5><strong>No hay celos!!!</strong></h5></center>");
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
	//$('#selectMetodos').on('change', function() {
	$(document).on("change", "#selectMetodos",function (){
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
	//$('#codigoRegistroT').on('change', function() {
	$(document).on("change", "#codigoRegistroT",function (){
		valorCodTor = $(this).val();
		//alertify.success("el codigo del toro  essss: " + valorCodTor)

		if(valorCodTor == 0){
			//alert("entrandododoodod");
			$("#nomToro").val("");
			$("#razToro").val("");
		}
		
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
		const raPajillaRegis= $("#razaListaPajilla").val();
		//alertify.success("la raza de la pajilla es: "+raPajillaRegis);
		$.post("../controlador/reproduccionctrl.php", {
			action:'guardarPajilla',	
				fechRegPaji:$("#fechaRegistroP").val(),						
				numeroRegistroR:$("#numeroRegistroR").val(),
				nombreToroP:$("#nombreToroR").val(),
				idRespRegP:$("#idUsuRegistroCel").val(),
				selRazPaj:$("#razaListaPajilla").val(),
				idrazaToroP:$("#idRazaP").val()
				}, function(data){
					if(data.resultd=="1")
					{   
						$("#numeroRegistroR").val("");
						$("#nombreToroR").val("");
						$("#razaListaPajilla").val("0");
						$("#razaToroR").val(""); 
						$("#idRazaP").val("");
						$("#nomToro").val("");
						$("#razToro").val("");
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
					
						alertify.success(data.msj);
						setTimeout(function(){
							actualizarCardPajilla();
						},300);
					} else
					{	
						alertify.error(data.msj);		
					}
			}, 'json');
	}); 
	//$('#btnguardarCelo').on('click', function() { 
	$(document).on("click", "#btnguardarCelo",function (){
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
				if($("#selectMetodos").val()==1){
					setTimeout(() => {
						actualizarListaMonta ();
					}, 300);
				
				}
				else{
					if($("#selectMetodos").val()==2){
						setTimeout(() => {
							actualizarListaInseminacion();
						}, 300);
						
					}
				}
				$("#nombreVacaR").val("");
				$("#razaVacaR").val("");//LIMPIAR CAJA DE TEXTO CUANDO SE GUARDE
				$("#idRazaV").val("");
				$("#selectServido option[value=0]").prop("selected",true);
				$("#selectMetodos option[value=0]").prop("selected",true);
				//$("#codigoRegistroT").val("");
				// Establecer la opción con valor 0 como seleccionada por defecto
				$("#codigoRegistroT option[value=0]").prop("selected", true);
				$("#idToroServ").val("");                           
				$("#nomToro").val("");
				$("#razToro").val("");
				$("#idRazaServ").val("");
				$("#responsableRep").val("");
				$("#idresponsableRep").val("");
				$("#observacionesRep").val("");
				
				alertify.success(data.msj);
				
				totalCelosF();
				oculCampCel();
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
					$("#selectServido option[value=0]").prop("selected",true);
					$("#nombreVacaR").val(""),
					$("#idAnimal").val(""),
					$("#razaVacaR").val(""),//LIMPIAR CAJA DE TEXTO CUANDO SE GUARDE
					$("#idRazaV").val(""),
					$("#responsableRep").val(""),
					$("#idresponsableRep").val(""),
					$("#observacionesRep").val("");
					alertify.success(data.msj);
					totalCelosF();
					setTimeout(function(){
						actualizarListaNoServido();
					},300);
					//listarServicioT();
				}else{	alertify.error(data.msj);	}
			}, 'json'); 				
		}
	});
	
});