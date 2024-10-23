$(document).ready(function(){
  flatpickr('#fechaPartoUpdate', {});
  flatpickr('#fechaParto', {});
  /////////CODIGO PARA LIMPIAR EL CAMPO AL RECARGAR////////
  function limpiarCamposParto(){/////SE REUTILIZA PARA PODER LIMPIAR CUANDO SE NECESITE 
    $("#CodVaca").val("");
    $("#nameVaca").val("");
    $("#idRazaPart").val("");
    $("#razVacaParto").val("");
    $("#sexocria").val(0);
    $("#pesoNacido").val("");
    $("#unidadPeso").val(0);
    $("#codigoSistemParto").val("");
    $("#estadoCria").val(0)
    $("#observacionParto").val("");
    $("#divSexoCria").show();
    $("#divPesoNacer").show();
    $("#divUnidadPeso").show();
    $("#divCodioSisPart").show();
  }
  limpiarCamposParto();//SE LIMPIA EL FORMULARIO CUANDO CARGA EL DOCUMENTO JS
  function listarCardParto(){
    $.post("../../archivo/controlador/chequeoPartos_ctrl.php", {
      action:'listarCardParto',
      idAnimalParto:$("#idAnimalBusqueda").val()
    },
      function(data){
        $("#listPartos").html(data.tabsParto);
    }, "json")
  }
 
  function generarTokenCorto() {
    return Math.random().toString(36).substr(2, 8);
  }
  function genFechaTresDijitos() {  
      // Crear una nueva fecha
      const fecha = new Date();
      // Opciones para formatear la fecha
      const opciones = {
          year: 'numeric',
          month: '2-digit',
          day: '2-digit',
          hour: '2-digit',
          minute: '2-digit',
          second: '2-digit',
          hour12: false,
          timeZone: 'America/Bogota'
      };
      // Formatear la fecha
      const fechaFormateada = fecha.toLocaleString('es-CO', opciones);
      // Ajustar el formato a y-m-d-h-i-s
      const [dia, mes, año, hora, minuto, segundo] = fechaFormateada.match(/\d+/g);
      const horaMinSeg = `${hora}${minuto}${segundo}`;
      var ultimosTresDigitos = horaMinSeg.toString().slice(-3);
      return ultimosTresDigitos;

  }
  $(document).on('change', '#estadoCria', function(){
    //alertify.success($(this).val());
    if(($(this).val()==3) || ($(this).val()==4)){
      $("#sexocria").val(0);
      $("#divSexoCria").hide();
      $("#pesoNacido").val("");
      $("#divPesoNacer").hide();
      $("#unidadPeso").val(0);
      $("#divUnidadPeso").hide();
      $("#codigoSistemParto").val("");
      $("#divCodioSisParto").hide();
    }else{
      if($(this).val()==1){
        const ultimosTresDijitosFecha = genFechaTresDijitos(); 
        //GENERACION DE TOKEN
        const token = generarTokenCorto();
        //SE UNE TOKEN Y ULTIMOS TRES DIJITOS DE FECHA
        const unidoUnico = token + ultimosTresDijitosFecha;
        $("#divSexoCria").show();
        $("#divPesoNacer").show();
        $("#divUnidadPeso").show();
        $("#divCodioSisPart").show();
        setTimeout(() => {
          $("#codigoSistemParto").val(unidoUnico);
        }, 1000);
      }
      else{
        if($(this).val()==0){
          $("#codigoSistemParto").val("");
        }
        else{
          if($(this).val()==2){
            $("#codigoSistemParto").val("");
            $("#divCodioSisPart").hide();
            $("#divSexoCria").show();
            $("#divPesoNacer").show();
            $("#divUnidadPeso").show();
            $("#divCodioSisParto").show();
          }
        }
      }
    }
  })
  function ttlPartosAnimal(){
    $.post("../../archivo/controlador/chequeoPartos_ctrl.php", {
      action:'actualizarTttlPartosAnimal',
      ttlPartosAnimal:$("#ttlPartosAnimal").val(),
      idAnimalTtlPartos:$("#idAnimalBusqueda").val()
    }, 
      function(data){
     
    },"json");
  }
  function fechaUltimoParto(){
    $.post("../../archivo/controlador/chequeoPartos_ctrl.php", {
      action:'actualizarFechaUltimoParto',
      idAnimalFechUltPartos:$("#idAnimalBusqueda").val()
    }, 
      function(data){
     
    },"json");
  }
  //////////CODIGO PARA GUARDAR PARTOS///////////////////////
  $(document).on("click", "#btnGuardarParto", function () {
    if($("#estadoCria").val()==0){
      alertify.error("FALTAN CAMPOS POR LLENAR.")
    }else{
      if($("#estadoCria").val()==1){//SI LA CRIA ESTA VIVA 
          $.post("../../archivo/controlador/chequeoPartos_ctrl.php", {
            action:'GuardarParto',
            codiVacaPart:$("#idAnimalBusqueda").val(),
            fechPart:$("#fechaParto").val(),
            sexCriaP:$("#sexocria").val(),
            pesoNaceCria:$("#pesoNacido").val(),
            UnidPeso:$("#unidadPeso").val(),
            idRespPartCria:$("#idRespParto").val(),
            ObsevacionParto:$("#observacionParto").val(),
            estadCriaP:$("#estadoCria").val(),
            tokenFormPartosVivo:$("#codigoSistemParto").val()
          }, 
            function(data){
            if(data.resultd=='1'){
              alertify.success(data.msj);
              limpiarCamposParto();
              listarCardParto();
              ttlPartosAnimal();
              fechaUltimoParto();
              setTimeout(() => {
                alertify.success("DEBES REGISTRAR AL ANIMAL NACIDO");
                $("#btnAbrirFromAnimalPart").trigger('click');
              }, 2000);
            }else{
              alertify.error(data.msj);
            }
          },"json");
      }else if($("#estadoCria").val()==2){//SI LA CRIA ESTA MUERTA
          $.post("../../archivo/controlador/chequeoPartos_ctrl.php", {
            action:'GuardarParto',
            codiVacaPartP:$("#idAnimalBusqueda").val(),
            fechPerdidaC:$("#fechaParto").val(),
            sexCriaPerd:$("#sexocria").val(),
            pesoNaceCriaP:$("#pesoNacido").val(),
            UnidPesoP:$("#unidadPeso").val(),
            idRespPartCriaP:$("#idRespParto").val(),
            ObsevacionPartoP:$("#observacionParto").val(),
            estadCriaP:$("#estadoCria").val()
          }, 
            function(data){
            if(data.resultd=='1'){
              alertify.success(data.msj);
              limpiarCamposParto();
              listarCardParto();
            }else{
              alertify.error(data.msj);
            }
          },"json");
      }else if(($("#estadoCria").val()==3) || ($("#estadoCria").val()==4)){//SI ES ABORTO O PERDIDA HEMBRIONARIA
          $.post("../../archivo/controlador/chequeoPartos_ctrl.php", {
            action:'GuardarParto',
            fechPerdidaC:$("#fechaParto").val(),
            codiVacaPartP:$("#idAnimalBusqueda").val(),
            idRespPartCriaP:$("#idRespParto").val(),
            ObsevacionPartoP:$("#observacionParto").val(),
            estadCriaP:$("#estadoCria").val()
          }, 
            function(data){
            if(data.resultd=='1'){
              alertify.success(data.msj);
              limpiarCamposParto();
              listarCardParto();
            }else{
              alertify.error(data.msj);
            }
          },"json");
      }
    }
    
  })
  $("#mdPartos").on("shown.bs.modal", function(){//CUANDO APARESCA EL FORMULARIO SE LISTEN LAS CARD DE PARTO
    listarCardParto();
    limpiarCamposParto();
  })
  $(document).on("click", "#deleteParto", function(){
    var idPartoDelete = $(this).attr('data-idPartoDelete');
    alertify.confirm("¿stá seguro de eliminar el registro? ", function (e) {
			if(e){ 
        $.post("../../archivo/controlador/chequeoPartos_ctrl.php", {
          action:'deleteCardParto',
          idPartoDeleteAnimal: idPartoDelete
        },
          function(data){
            if(data.resultd=='1'){
              alertify.success(data.msj);
              listarCardParto();
            }else{
              alertify.error(data.msj);
            }
        }, "json")
      } else { error("Cancelado el proceso de eliminacion."); }
    }); 
    return false
  })
  ///CUANDO LE DA CLICK AL BOTON DE LA TARJETA ACTUALIZAR, VA I BUSCA LOS DATOS CON ESE ID Y RELLENA EL FORMULARIO
  $(document).on("click", "#updateParto", function(){
    var idCardParto = $(this).attr("data-idPartoUpdate");
    $("#idCardPartoUpdate").val(idCardParto);
    $.post("../../archivo/controlador/chequeoPartos_ctrl.php", {
      action:'llenarFormActuParto',
      idCardParto: idCardParto
    },
    function(data){
      $("#fechaPartoUpdate").val(data.fechaParto);
      $("#sexocriaUpdate").val(data.sexoCria).trigger('change');
      $("#pesoNacidoUpdate").val(data.pesoNacidoParto);
      $("#unidadPesoUpdate").val(data.unidadPeso).trigger('change');
      $("#observacionPartoUpdate").val(data.observacionesParto);
    }, "json")
  })
  //ACTUALIZAR CAMBIOS DE PARTOS
  $(document).on("click", "#btnUpdateParto", function(){
    $.post("../../archivo/controlador/chequeoPartos_ctrl.php", {
      action:'updateParto',
      codiPart:$("#idCardPartoUpdate").val(),
      fechPartUp:$("#fechaPartoUpdate").val(),
      sexCriaUp:$("#sexocriaUpdate").val(),
      pesoNaceCriaUp:$("#pesoNacidoUpdate").val(),
      UnidPesoUp:$("#unidadPesoUpdate").val(),
      idRespPartCriaUp:$("#idRespPartoUpdate").val(),
      ObsevacionPartoUp:$("#observacionPartoUpdate").val()
    }, 
      function(data){
      if(data.resultd=="1"){
        alertify.success(data.msj);
        listarCardParto();
      }else{
        alertify.error(data.msj);
      }
    },"json");
  })
});