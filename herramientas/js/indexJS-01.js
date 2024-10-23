$(function(){
	$(document).on('click', '#pagActualizarUsu', function(){
		alert("borrar campo de clave persona");
		$("#inputClaveUpdate").val("");
	})
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
	$("#identificacion_update_user").on("input", function () {	this.value = this.value.replace(/[^0-9]/g,''); }); 
	$("#telefono_registro").on("input", function () { this.value = this.value.replace(/[^0-9]/g,'');	});
	$("#telefono_update_user").on("input", function () { this.value = this.value.replace(/[^0-9]/g,'');	});
	///////////////////////////////LISTAR REGIONAL USUARIO////////////////////
	function listarReginal(regional){
		$.post("include/ctrlindex.php",{
			action:'listarRegionalUsuario'
			}, function(data){
				$(regional).html(data.listaRegionalUs);
						
			}, 'json');
	}	
	$('#popupRegistro').on('shown.bs.modal', function() {
        listarReginal("#slctRegionalUsuario");
    });
	$(document).on('change', '#slctRegionalUsuario', function(){
		var idRegional = $(this).val();
		$("#idReginalUsu").val(idRegional);
		$.post("include/ctrlindex.php",{
			action:'listarCentroUsuario',
			idReginalUsu:idRegional
			}, function(data){
				$("#slctCentroUsuario").html(data.listaCentroUs);
			}, 'json');
	})
	$(document).on('change', '#slctCentroUsuario', function(){
		var idCentro = $(this).val()
		$("#idCentroUsu").val(idCentro);
		$.post("include/ctrlindex.php",{
			action:'listarAreasUsu',
			idCentroUsu:idCentro
			}, function(data){
					$("#areaUsu").html(data.listaAreasUs);
			}, 'json');
	})
	$(document).on('change', '#areaUsu', function(){
		var idAreaU = $(this).val()
		$("#idAreaUsu").val(idAreaU);
	})
	/////////////////////////////////////////////////////////////
	$("#fecha").attr('disabled','disabled');
	function limpiarCajas(){
		$('#identificacion_registro').val("");
		$('#nombre_registro').val("");
		$('#apellido_registro').val("");
		$('#correo_registro').val("");
		$('#telefono_registro').val("");
		$('#clave_registro').val("");
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
		$('#inputClave').empty(); 
	}
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
					regional_usuario: $('#idReginalUsu').val(),
					centro_usuario: $('#idCentroUsu').val(),
					idAreaUsua: $('#idAreaUsu').val(),
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
						setTimeout(function(){
							location.href="../../../ganaderiaCamara23072024/archivo/vista/inicio.php";
							//alert('../../../ganaderia2023/archivo/vista/inicio.php');
						}, 2000);
						}else{	error(data.msj_DelSistema);	}
					}, 'json');	
				}
			}
	}
	limpiar();
	function recargarFormUpdate(){
		$.post("../../include/ctrlindex.php", {
			action: 'buscarUsuarioInicio',
		}, function(data){
			$("#identificacion_update_user").val(data.numero_identificacion);
			$("#nombre_update_user").val(data.nombre);
			$("#apellido_update_user").val(data.apellido);
			$("#telefono_update_user").val(data.telefono);
			$("#correo_update_user").val(data.email);
			setTimeout(() => {
				$("#slctRegionalUsuarioUptd").val(data.idRegPerson).trigger('change');
			}, 300);
			setTimeout(() => {
				$("#slctCentroUsuarioUptd").val(data.idCentPerson).trigger('change');
			}, 350);
			$("#slctAreaUsuarioUptd").val(data.id_area_FK).trigger('change');
			setTimeout(() => {
				$("#slctAreaUsuarioUptd").val(data.id_area_FK).trigger('change');
			}, 400);
		}, 'json');
	}
	/////////////////ACTUALIZAR PERSONA/////////////
	$(document).on('click', "#validUsuUp", function(){
		$.post("../../include/ctrlindex.php",{
			action:'vericarUsuUp',
			idVeriUsu: $("#idUsVerifiUp").val(),
			claveVeriForm: $("#inputClaveUpdate").val()
			}, function(data){
				if(data.resultd == "1"){
					alertify.success(data.msj);
					$("#inputClaveUpdate").val("");
					setTimeout(() => {
						$("#updateUser").modal("show");
					}, 1000);
				}else{
					alertify.error(data.msj);
				}
			}, 'json');
	})
	$('#updateUser').on('shown.bs.modal', function() {	
			//listarReginal("#slctRegionalUsuarioUptd")
			$.post("../../include/ctrlindex.php",{
				action:'listarRegionalUsuario'
				}, function(data){
					$("#slctRegionalUsuarioUptd").html(data.listaRegionalUs);	
				}, 'json');
			recargarFormUpdate();
    });
	$(document).on('click', '#btnActualizarUsuario', function(){
		recargarFormUpdate();
		$.post("../../include/ctrlindex.php",{
			action:'listarRegionalUsuario'
			}, function(data){
				$("#slctRegionalUsuarioUptd").html(data.listaRegionalUs);
						
			}, 'json'); 
	})
	$(document).on('change', '#slctRegionalUsuarioUptd', function(){
		var idRegionalUpdat = $(this).val();
		$("#idReginalUsuUptd").val(idRegionalUpdat);
		$.post("../../include/ctrlindex.php",{
			action:'listarCentroUsuario',
			idReginalUsu:idRegionalUpdat
			}, function(data){
				$("#slctCentroUsuarioUptd").html(data.listaCentroUs);
			}, 'json');
	})
	$(document).on('change', '#slctCentroUsuarioUptd', function(){
		var idCentroUp = $(this).val()
		$("#idCentroUsuUptd").val(idCentroUp);
		$.post("../../include/ctrlindex.php",{
			action:'listarAreasUsu',
			idCentroUsu:idCentroUp
			}, function(data){
					$("#slctAreaUsuarioUptd").html(data.listaAreasUs);
			}, 'json');
	})
	$(document).on('change', '#slctAreaUsuarioUptd', function(){
		var idAreaUp = $(this).val();
		$("#idAreaUsuUptd").val(idAreaUp);
	})

	$(document).on('click', '#btn_Actualizar_Usuario', function(){
		idUsuUpdate = $('#idUserUpdate').val(); 
		$.post("../../include/ctrlindex.php", {
				action: 'actualizarUsuLog',
				docUpdate: $('#identificacion_update_user').val(),
				nombreUsuUpdate: $('#nombre_update_user').val(),
				apellidoUsuUpdate: $('#apellido_update_user').val(),
				numCelUsuUpdate: $('#telefono_update_user').val(), 
				correroUsuUpdate: $('#correo_update_user').val(),
				regionUsuUpdate: $('#idReginalUsuUptd').val(),
				centroUsuUpdate: $('#idCentroUsuUptd').val(),
				areaUpdate: $("#idAreaUsuUptd").val()
			}, function(data){
			if (data.resultd == '1'){
				alertify.success(data.msj);
					recargarFormUpdate();
			}else{	
				alertify.error(data.msj)
			}
		}, 'json');
	})

});