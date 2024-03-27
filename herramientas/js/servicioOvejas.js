$(document).ready(function(){
	$(document).on("click", "#divChekeo",function () {
		var idAnimalFk = $("#idAnimalBusqueda").val();	
		$("#idOvejaForm").val(idAnimalFk);
		$("#infoMachoOvj").hide(500);
		$("#codigoCordero").hide(500);
		$("#selectMetodosOvejas").hide(500);
		$("#selectServidoOveja").val(0);
		$("#selectMetodosOvejas").val(0);
		$("#nomCordero").hide(500);
		$("#razCordero").hide(500);
		$("#codigoRegistroCordero").find('option').remove().end();
		$("#divBtnPajillaCordero").hide(500);
		//CAMPOS DE PAJILLA
		$("#numeroRegistroR").val("");
		$("#nombreToroR").val("");
		$("#razaPajilla").val("");
	});		
	$(document).on("change", "#selectServidoOveja",function (){  //YO NO TOQUE NADA
		var varservido = $(this).val();
		if(varservido==1){ 
			$("#DivMetodoOvejas").show('slow');
			$("#selectMetodosOvejas").show('slow'); 
		}else{ 
			$("#DivMetodoOvejas").hide(500);
			$("#selectMetodos").hide(500); 
			$("#infoToro").hide(500);
			$("#codigoToro").hide(500);
			$("#metodo").hide(500);
			$("#nombreToro").hide(500);
			$("#razaToro").hide(500);
			$("#codigoRegistroCordero").find('option').remove().end();
			$("#codigoRegistroCordero").val()=="";
			$("#codigoRegistroCordero").val("");
			$("#nomCordero").val("");
			$("#razCordero").val("");
		}
	});

	$('#selectMetodosOvejas').on('change', function() {
		opcionCelInsm = $('#selectMetodosOvejas').val()
		if (opcionCelInsm == 1){
			$('#divBtnPajillaCordero').hide(500);
			$('#infoMachoOvj').show('slow');
			$('#codigoCordero').show('slow');
			$('#nomCordero').show('slow');
			$('#razCordero').show('slow');
		}
		else{
			if(opcionCelInsm == 2){
				$('#divBtnPajillaCordero').show('slow');
				$('#btnPajilaCordero').show('slow');
				$('#infoMachoOvj').show('slow');
				$('#codigoCordero').show('slow');
			}
			else{
				if(opcionCelInsm == 0){
					$('#infoMachoOvj').hide(500);
					$('#codigoCordero').hide(500);
				}
			}
		}
	});

	$(document).on("change", "#selectMetodosOvejas",function (){ //YO NO TOQUE NADA
		var metodosRep = $(this).val();
		// alert(metodosRep);
		$.post("../controlador/reproduccionOvejasCtrl.php", {
		action:'listarTipo',
		tipoEnsiminacion: metodosRep 
			}, function(data){
			$("#codigoRegistroCordero").html(data.tipo);		
			}, 'json');
		if ( metodosRep == 1 || metodosRep == 2 || metodosRep == 0 ){
			$("#nomCordero").val("");
			$("#razCordero").val("");
			$("#idRazaServ").val("");
			$("#idToroServ").val("");
		}       
	});


	$('#codigoRegistroCordero').on('change', function() {
		var estado = $('#selectMetodosOvejas').val();
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
		$.post("../controlador/reproduccionCtrl.php", {
		action:'cargarServicio',
		idanimals:$("#codigoRegistroCordero").val()
		}, function(data){
			$("#nomCordero").val(data.nombreAnimal);	
			$("#idCorderoServ").val(data.idAnimal);	  
			$("#razCordero").val(data.nombreRaza);	
			$("#idRazaServCordero").val(data.idRaza_FK);	
		}, 'json'); 
    }
	function cargarSelectPajilla(){
		//alert("llenar con inseminacion");
		$.post("../controlador/reproduccionCtrl.php", {
		action:'cargarServicioPjailla',
		numReg:$("#codigoRegistroCordero").val()
		}, function(data){
			$("#nomCordero").val(data.nombrePajilla);	
			$("#idCorderoServ").val(data.idPajilla);	  
			$("#razCordero").val(data.nombreRazaP);	
			$("#idRazaServCordero").val(data.numrazaPajilla);	
		}, 'json');
	}
});