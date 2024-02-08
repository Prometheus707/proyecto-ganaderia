
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
				dato_txt:$("#dato_txt").val()
			}, function(data){ 
				if(data.result==1){ $("#example").html(data.listaAnimales);}
				else { alertify.error(data.msj);  }		
			}, 'json');
		}	
	});	
	


	$(document).on("click", "#divChekeo",function (){
		alert("LIMPIANDO!!!!!!!!!!!!!!!!!!!")
		$("#servido").val(0),
		$("#metodos").val(0),
		$("#codigoRegistroT").val(""),
		$("#nomToro").val(""),
		$("#razToro").val(""),
		$("#idRazaServ").val(""),
		$("#idToroServ").val("");
	});	

	$(document).on("click", "#divVacunas",function (){
		alert('nada');
	});	
	$(document).on("click", "#divDesparacitar",function (){
		alert('nada');
	});	
	$(document).on("click", "#divPartos",function (){
		alert('nada');
	});		

	//animal encontrado
	$(document).on("click", "#btnVerHC",function (){		
		var idanimal = $(this).data('idanimal');		
		$("#idAnimalBusqueda").val(idanimal);	
		$.post("../controlador/historial_ctrl.php", {
				action:'buscarID',
				idAnimalBusqueda:$("#idAnimalBusqueda").val()
			}, function(data){
				$("#codAnimalBuscado").val(data.codAnimal);
				$("#codigoVaca").val(data.codAnimal); //FORMULARIO
				$("#idAnimal").val(data.idAnimalHistorial);//FORMULARIO
				$("#nomAnimalBuscado").val(data.nombreAnimal);
				$("#nombreVacaR").val(data.nombreAnimal);//FORMULARIO
				$("#unidadBuscado").val(data.nombreUnidadPro);							
				$("#idUnidadBuscado").val(data.idUnidad_FK);
				$("#idrazaAnimalBuscado").val(data.idnombreRazaHistorial);
				$("#idRazaV").val(data.idnombreRazaHistorial);//FORMULARIO
				$("#razaAnimalBuscado").val(data.nombreRazaHistorial);
				$("#razaVacaR").val(data.nombreRazaHistorial);//FORMULARIO
			}, 'json');			
		// $('[data-widget="pushmenu"]').PushMenu('toggle');
		// launchFullScreen(document.documentElement);
		presentarHistorialClinico()		
	});	
	
		
	$(document).on("focus", "#dato_txt",function (){
		$("#example").html("<thead><tr><th scope='col'>Codigo</th><th scope='col'>Nombre</th><th scope='col'>Op</th></tr></thead>");
		// <thead><tr><th scope='col'>&nbsp;&nbsp&nbsp;&nbsp;NO EXISTEN COINCIDIENCIAS</th></tr></thead>
	});
	
	$(document).on("click", "#pruebaMenu",function (){
		$('[data-widget="pushmenu"]').PushMenu('toggle')
	});	
	// $(document).on("click", "#btnDellRaza",function () {
		
	// }); 

	// $('.solo-numero').keyup(function (){
		// this.value = (this.value + '').replace(/[^0-9]/g, '');
	// });

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
	// Lanza en pantalla completa en navegadores que lo soporten
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