$(document).ready(function(){	
	function ocultarHistorialClinico(){
		$("#containerCarpetaHistorial").hide();
		$("#containerBqd").show();
	}
	function presentarHistorialClinico(){
		$("#containerCarpetaHistorial").show();
		$("#containerBqd").hide();
	}
	$(document).on("click", "#btn_Buscar",function (){
		if($("#dato_txt").val()==""){
			alertify.error("DEBE INGRESAR TEXTO A BUSCAR.");
		}else{
			$.post("../controlador/historial_ctrl.php", {
				action:'listarAnimales',
				dato_txt:$("#dato_txt").val(),
				selectVM:$("#selectVM").val()
			}, function(data){ 
				if(data.result==1){ $("#example").html(data.listaAnimales);}
				else { alertify.error(data.msj);  }		
			}, 'json');
		}	
	});
	
	$(document).on("click", "#divChekeo",function (){ $("#crearReproduccion").show();	});	
	$(document).on("click", "#divVacunas",function (){		});	
	$(document).on("click", "#divDesparacitar",function (){		});	
	$(document).on("click", "#divPartos",function (){	});	
	
	$(document).on("click", "#btnVerHC",function (){
		var idanimal = $(this).data('idanimal');	
		$("#idAnimalBusqueda").val(idanimal);
		$.post("../controlador/historial_ctrl.php", {
			action:'buscarID',
			idAnimalBusqueda:$("#idAnimalBusqueda").val()
			}, function(data){
				$("#codAnimalBuscado").val(data.codAnimal);
				$("#codAnimalBuscadoCheq").val(data.codAnimal);
				$("#nomAnimalBuscado").val(data.nombreAnimal);
				$("#unidadBuscado").val(data.nombreUnidadPro);							
				$("#idUnidadBuscado").val(data.idUnidad_FK);
				$("#nombreAnimal").text(data.nombreAnimal);
				
				$("#CodigoAnimal").text(data.codAnimal);
				$("#nombreUnidad").text(data.nombreUnidadPro);
				$("#idAnimal2").val(data.idAnimal2); 		//FORMULARIO FALLECIMIENTOS
				$("#totalServicio").text(data.ttlServicio);  	//TOTAL SERVICIOS
                $("#codigoVaca").val(data.codAnimal); 		//FORMULARIO
				$("#idAnimal").val(data.idAnimalHistorial);	//FORMULARIO	
				$("#idAnimalFK").val(data.idAnimalFK);//FORMULARIO VACUNACION		
				$("#idVacaForm").val(data.idAnimalCelo_fk);	
				$("#idVacaFormUpdate").val(data.idAnimalCelo_fk);	

				alert(data.idAnimalCelo_fk)

			}, 'json');			
		// $('[data-widget="pushmenu"]').PushMenu('toggle');
		// launchFullScreen(document.documentElement);
		presentarHistorialClinico()		
	});	
	$(document).on("focus", "#dato_txt",function (){
		$("#example").html("<thead><tr><th scope='col'>Codigo</th><th scope='col'>Nombre</th><th scope='col'>Op</th></tr></thead>");
		// <thead><tr><th scope='col'>&nbsp;&nbsp&nbsp;&nbsp;NO EXISTEN COINCIDIENCIAS</th></tr></thead>
	});
	$(document).on("click", "#pruebaMenu",function (){	$('[data-widget="pushmenu"]').PushMenu('toggle');	});	
	$.datepicker.setDefaults($.datepicker.regional["es"]);
	$("#fechaNacimientoRegistro").datepicker({dateFormat: "yy/mm/dd"});	
	
	function launchFullScreen(element) {
		if(element.requestFullScreen) {
			element.requestFullScreen();
			} else if(element.mozRequestFullScreen) {
			element.mozRequestFullScreen();
			} else if(element.webkitRequestFullScreen) {
			element.webkitRequestFullScreen();
		}
	}
	function cancelFullScreen() {
		if(document.cancelFullScreen) {
				document.cancelFullScreen();
			} else if(document.mozCancelFullScreen) {
				document.mozCancelFullScreen();
			} else if(document.webkitCancelFullScreen) {
				document.webkitCancelFullScreen();
			}
	}
	ocultarHistorialClinico();
});	