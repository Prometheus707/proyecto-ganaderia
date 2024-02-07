$(document).ready(function(){
	
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
	$("body").on("focus","input",function(event){
		$(this).attr('autocomplete', 'off')
	});
	function validaNumericos(event) { if(event.charCode >= 48 && event.charCode <= 57){  return true;	 } return false; }
	$("#identificacion_registro").on("input", function () {	this.value = this.value.replace(/[^0-9]/g,''); }); 
	$("#telefono_registro").on("input", function () { this.value = this.value.replace(/[^0-9]/g,'');	});
	
	// function listarAreas(){ 
	// $.post("include/ctrlindex.php",{
		// action:'gestionarAreas'
		// }, function(data){
			// $("#listaArea_usuario").empty();
			// $("#listaArea_usuario").html(data.listaAreas);
		// }, 'json');
	// }	
	
	$("#fecha").attr('disabled','disabled');
	
	function limpiarCajas(){
		$('#identificacion_registro').val("");
		$('#nombre_registro').val("");
		$('#apellido_registro').val("");
		$('#correo_registro').val("");
		$('#telefono_registro').val("");
		$('#clave_registro').val("");
		//listarAreas();
	}
	$('#identificacion_registro').on('focus', function () {$("#divRespuestasRegistoUsu").empty();});
	$('#nombre_registro').on('focus', function () {$("#divRespuestasRegistoUsu").empty();});
	$('#apellido_registro').on('focus', function () {$("#divRespuestasRegistoUsu").empty();});
	$('#correo_registro').on('focus', function () {$("#divRespuestasRegistoUsu").empty();});
	$('#telefono_registro').on('focus', function () {$("#divRespuestasRegistoUsu").empty();});
	$('#clave_registro').on('focus', function () {$("#divRespuestasRegistoUsu").empty();});
	$('#inputUsuario').on('focus', function () {$("#divRespuestas").empty();});
	$('#inputClave').on('focus', function () {$("#divRespuestas").empty(); });
	
	function limpiar(){
		$('#inputUsuario').empty();
		$('#inputClave').empty(); }

	$("#btnNuevaClave").click(function(){
		if($('#inputUsuario').val()=="") {	error("DEBE INGRESAR EL USUARIO.");	}
		else{
				$.post("include/ctrlindex.php", {
					action:'asignarNuevaClave',
					inputUsuario:$('#inputUsuario').val()
				}, function(data){
					if (data.Resultado == '1'){	ok(data.msj_DelSistema); }else{	error(data.msj_DelSistema);	}
				}, 'json');
			}							
	});
	
	$(document).on("click", "#btn_Registrar_Usuario",function () {
		var identificacion = document.getElementById('identificacion_registro').value;
		var cant = $('#correo_registro').val().length;
		var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
		if (regex.test($('#correo_registro').val().trim())) 
			{
				$.post("include/ctrlindex.php", {
					action: 'registrarUsuario',
					fecha_Registro: $('#fecha').val(),
					identificacion_Registro: $('#identificacion_registro').val(),
					nombre_Registro: $('#nombre_registro').val(),
					apellido_Registro: $('#apellido_registro').val(),
					correo_Registro: $('#correo_registro').val(),
					telefono_Registro: $('#telefono_registro').val(),
					clave_Registro: $('#clave_registro').val()
				}, function(data){
					if (data.Resultado == '1'){
						ok(data.msj_DelSistema);
						limpiarCajas();
						setTimeout(function(){
							location.reload(true);							
						}, 1000);
					}else{	error(data.msj_DelSistema);   }
				}, 'json');
			}
		else 
			{
				error("DIRECCION DE CORREO NO VALIDA");
			}					
	});
	
	// $("#inputUsuario").keypress(function(e) {var code = (e.keyCode ? e.keyCode : e.which);if(code==13){entrar(); } });
	// $("#inputClave").keypress(function(e) {var code = (e.keyCode ? e.keyCode : e.which);if(code==13){entrar();} });
	$("#btnEntrar").click(function(){entrar();});				
	function entrar(){
		if($('#inputUsuario').val()==""){error("DEBE INGRESAR EL USUARIO"); }
		else{
			if($('#inputClave').val()==""){error("DEBE INGRESAR LA CLAVE"); }
			else
				{
					$.post("include/ctrlindex.php", {
						action: 'inicioSesion',
						inputusuario:$('#inputUsuario').val(),
						inputclave:$('#inputClave').val()
					}, function(data){
						if (data.Resultado == '1'){ 
						ok("Entrando al sistema..")
						ok("Credenciales correctas...")
						//setTimeout(function(){
							location.href="../../../ganaderia2023/archivo/vista/inicio.php";
							//alert('../../../ganaderia2023/archivo/vista/inicio.php');
						//}, 2000);
						}else{	error(data.msj_DelSistema);	}
					}, 'json');	
				}
			}
	}
	limpiar();
	//listarAreas();
	//limpiarRegistro();
});