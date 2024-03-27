$(document).ready(function(){//YO NO TOQUE NADA
	function listarPajillas(){
		$.post("../controlador/animal_ctrl.php", {
			action:'listaRazas',
			idEspecie_FKRegistro:$("#idEspecie_FKRegistro").val()
		}, function(data){
				$("#lista").empty();
				$("#lista").html(data.listaRazas);
		}, 'json');
	}
	$("#mdreproduccion").on('shown.bs.modal', function() {
		const video = document.getElementById('video');
		const snap = document.getElementById('snap'); 
		const canvas = document.getElementById('canvas');
		
		// Acceder a la cámara
		navigator.mediaDevices.getUserMedia({ video: { facingMode: { exact: 'environment' } } })
		.then(stream => {
			video.srcObject = stream;
			video.play(); // Comenzar la reproducción del video
		})
		.catch(error => {
			console.error('Error accessing the camera:', error);
		});

		// Tomar una foto y mostrarla en el canvas
		snap.onclick = function() {
			if (video.srcObject) {
				canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
				// Mostrar imagen tomada    
				canvas.style.display = "block";
			}
		};
	});
	$("#selectMetodos option[value=0]").attr("selected",true);
	$("#DivMetodo").hide(500); 
	$("#selectMetodos").hide(500); 
	$("#infoToro").hide(500); 
	$("#divBtnPajilla").hide(500); 
	$("#fechaCeloVaca").datepicker(500);
	/*  inicio recibe el codigo del anibal seleccionado  */		
	$(document).on("click", "#divChekeo",function () {
		var idAnimalFk = $("#idAnimalBusqueda").val();	
		$("#idVacaForm").val(idAnimalFk);
		$("#infoToro").hide(500);
		$("#codigoToro").hide(500);
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
			$("#codigoToro").hide(500);
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
			$('#codigoToro').show('slow');
		}
		else{
			if(opcionCelInsm == 2){
				$('#divBtnPajilla').show('slow');
				$('#btnPajila').show('slow');
				$('#infoToro').show('slow');
				$('#codigoToro').show('slow');
			}
			else{
				if(opcionCelInsm == 0){
					$('#infoToro').hide(500);
					$('#codigoToro').hide(500);
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
    $('#btnGuardarPajilla').on('click', function() {
				$.post("../controlador/reproduccionctrl.php", {
					action:'guardarPajilla',
							// se envia al controlador
						numeroRegistroR:$("#numeroRegistroR").val(),
						nombreToroP:$("#nombreToroR").val(),
						idrazaToroP:$("#idRazaP").val(),
						}, function(data){
							if(data.resultd=="1")
							{   
								$("#numeroRegistroR").val(""),
								$("#nombreToroR").val(""),
								$("#razaPajilla").val(""),
								$("#razaToroR").val("");//LIMPIAR CAJA DE TEXTO CUANDO SE GUARDE 
								alertify.success(data.msj);
								setTimeout(function(){
									$("#cerrarPajilla").trigger("click");
								},300);
								recargar();
							}
							else
							{
								alertify.error(data.msj);
							}
					}, 'json');                  
	});
		$.post("../controlador/reproduccionctrl.php", {
			action:'raza',
				}, function(data){
					$("#razaPajilla").html(data.raza);
					$("#idRazaP").val(data.idRazaP);
				}, 'json');
		$('#razaPajilla').on('change', function() { 
			var idrazaPaj = $(this).val();  
			$('#idRazaP').val(idrazaPaj);
	});
		////////////////////////////GUARDAR CELO SERVICIOS////////////////////////
		$('#btnguardarCelo').on('click', function() { 
			if($("#selectServido").val()=="0"){
				alertify.error("Debe seleccionar si esta servido no no")
			}
			if($("#selectServido").val()=="1"){
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
									}, function(data){
									if(data.resultd=="1")
										{   
											$("#nombreVacaR").val("");
											$("#razaVacaR").val("");//LIMPIAR CAJA DE TEXTO CUANDO SE GUARDE
											$("#idRazaV").val("");
											$("#fechaCeloVaca").val("");
											$("#selectServido").val("");
											$("#selectMetodos").val("");
											$("#codigoRegistroT").val("");
											$("#idToroServ").val(""),                               
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
											listarServicioT();
										}
								else
									{
									alertify.error(data.msj);
									}
								}, 'json'); 
			}
			if($("#selectServido").val()=="2")
				{              
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
							}, function(data){                      
								if(data.resultd=="1")
								{   
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
								}
							else
								{
								alertify.error(data.msj);
							}
						}, 'json'); 				
				}
			});
			//FIN REGISTRAR REPRODUCCION 
			$("#no").trigger("click");
});