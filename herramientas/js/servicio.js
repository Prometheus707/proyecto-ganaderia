$(document).ready(function(){  

    /*$('##divChekeo').on('click', function(){
      alert('entramos desde servicio');
    });*/
    
    $(document).on("click", "#divChekeo",function (){	
      $("#codigoToro").hide(500),
      $("#metodo").hide(500),
      $("#nombreToro").hide(500),
      $("#razaToro").hide(500),
      $("#btnPajila").hide(500);
      //$("#metodos").val(""),
      //$("#codigoRegistroT").val(""),
      //$("#nomToro").val(""),
      //$("#razToro").val("");
    });	
    
    $("#servido").val(0);
    $("#metodos").val(0); 
    //$("#fechaCeloVaca").datepicker();
    $("#no").click(function() {
      $("#codigoToro").hide(500),
      $("#metodo").hide(500),
      $("#nombreToro").hide(500),
      $("#razaToro").hide(500),
      ////idToroServ idRazaServ
      $("#observacionesRep").show("slow"),
      $("#btnPajila").hide(500);
      $("#codigoRegistroT").val()==""
      $("#metodos").val(""),
      $("#codigoRegistroT").val(""),
      $("#nomToro").val(""),
      $("#razToro").val(""),
      $("#idRazaServ").val(""),
      $("#idToroServ").val("");
    });

    $("#si").click(function() {
      $("#codigoToro").show("slow"),
      $("#metodo").show("slow")
      $("#nombreToro").show("slow"),
      $("#razaToro").show("slow"),
      $("#fechaChequeo").show("slow"),
      $("#fechaProbableP").show("slow"),
      $("#fechaRealP").show("slow"),
      $("#sexoCria").show("slow"),
      $("#tituloParto").show("slow"),
      $("#numeroServicios").show(1000);
      $("#metodos").val(0) 
      $("#btnPajila").show("slow");
    });
    
    $.post("../controlador/reproduccionctrl.php", {
        action:'codigoVaca'
          }, function(data){
          $("#codigoVaca").html(data.codigoVaca);		
          }, 'json');

    $.post("../controlador/reproduccionctrl.php", {
        action:'raza'
          }, function(data){
          $("#razaPajilla").html(data.raza);
          $("#idRazaP").val(data.idRazaP);
          }, 'json');
  
    $("#btnMonta").click(function() {
      $.post("../controlador/reproduccionctrl.php", {
          action:'monta'
            }, function(data){
              $("#codigoRegistroT").html(data.monta);		
            }, 'json');
      $("#btnPajila").hide(1500);
    });

    //COMPLETAR INFORMACION DE LA VACA DEPENDIENDO DE QUE SELECCIONE
    $('#animals').on('change', function() {
      $("#mdreproduccion").modal("show");  
      //$("#codigoVaca").val("025");
      //$("#nombreVacaR").val("la dura") ; 
      $.post("../controlador/reproduccionctrl.php", {
          action:'cargarServicio',
          idanimals:$("#animals").val()
            }, function(data){
              $("#codigoVaca").val(data.codAnimal);
              $("#nombreVacaR").val(data.nombreAnimal);	
              $("#idAnimal").val(data.idAnimal);	  
              $("#razaVacaR").val(data.nombreRaza);	
              $("#idRazaV").val(data.idRaza_FK);	
             //
            }, 'json');              
    });



    //COMPLETAR INFORMACION DE LA VACA DEPENDIENDO DE QUE SELECCIONE
    $('#persons').on('change', function() {
      $("#mdreproduccion").modal("show");  
      //$("#codigoVaca").val("025");
      //$("#nombreVacaR").val("la dura") ; 
      $.post("../controlador/reproduccionctrl.php", {
          action:'cargarPerson',
          idPersons:$("#persons").val()
            }, function(data){
              $("#responsableRep").val(data.nombrePerson);
              $("#idresponsableRep").val(data.idPersonaS);
            }, 'json');              
    });


    $('#metodos').on('change', function() {

        $.post("../controlador/reproduccionctrl.php", {
          action:'listarTipo',
          tipoEnsiminacion:$("#metodos").val()
            }, function(data){
              $("#codigoRegistroT").html(data.tipo);		
            }, 'json');
        
        if ($("#metodos").val() == 1 || $("#metodos").val() == 2 || $("#metodos").val() == 0){

          $("#nomToro").val(""),
          $("#razToro").val(""),
          $("#idRazaServ").val(""),
          $("#idToroServ").val("");
        }
    }); 

    $('#razaPajilla').on('change', function() {
        $.post("../controlador/reproduccionctrl.php", {
          action:'cargarRazaPaj',
          idRazaPaji:$("#razaPajilla").val()
            }, function(data){
              $("#idRazaP").val(data.idPajillaPaj);		
            }, 'json');
    }); 
        //MIRAR QUE METODO ESCOGIO MONTA/INSEMINACION
    $('#codigoRegistroT').on('change', function() {
          var estado = $('#metodos').val();
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


    ///////////////////////////GUARDAR PAJILLA////////////////////////////////////
    $('#btnGuardarPajilla').on('click', function() {
      if($("#numeroRegistroR").val()=="")
          {
            alertify.error('campo obligatorio')
            $("#numeroRegistroR").focus().css("background-color", "pink");
            setTimeout(function(){
              $("#numeroRegistroR").focus().css("background-color", "white");
            },2000);
          }
        else
          {
              if($("#nombreToroR").val()=="")
                {
                  alertify.error('campo obligatorio')
                  $("#nombreToroR").focus().css("background-color", "pink");
                  setTimeout(function(){
                    $("#nombreToroR").focus().css("background-color", "white");
                  },2000);
                } 
              else
              {
                  if($("#razaPajilla").val()=="0")
                    {
                      alertify.error('campo obligatorio')
                      $("#razaPajilla").focus().css("background-color", "pink");
                      setTimeout(function(){
                        $("#razaPajilla").focus().css("background-color", "white");
                      },2000);
                    } 
                  else
                    {
                      $.post("../controlador/reproduccionctrl.php", {
                        action:'guardarPajilla',
                        // se envia al controlador
                        codToro:$("#numeroRegistroR").val(),
                        nombeToro:$("#nombreToroR").val(),
                        razaToro:$("#idRazaP").val()
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
                            }
                          else
                            {
                              alertify.error(data.msj);
                            }
                        }, 'json');                   
                    }    
              }       
          } 
        
      });

      ////////////////////////////GUARDAR CELO SERVICIOS////////////////////////
      $('#btnguardarCelo').on('click', function() { 
        if($("#servido").val()=="0")
              {
                alertify.error('DEBE SELECCIONAR SI ESTA SERVIDO O NO')
                $("#servido").focus().css("background-color", "pink");
                      setTimeout(function(){
                        $("#servido").focus().css("background-color", "white");
                      },2000);
              }   
        if($("#servido").val()=="1")
              {
                if($("#fechaCeloVaca").val()==""){ 
                  alertify.error('DEBE SELECCIONAR LA FECHA')
                  $("#fechaCeloVaca").focus().css("background-color", "pink");
                      setTimeout(function(){
                        $("#fechaCeloVaca").focus().css("background-color", "white");
                      },2000);
                }
                else{
                  if( $("#metodos").val()=="0"){
                    alertify.error('DEBE SELECCIONAR EL METODO MONTA/INSEMINACION')
                    $("#metodos").focus().css("background-color", "pink");
                      setTimeout(function(){
                        $("#metodos").focus().css("background-color", "white");
                      },2000);
                  }
                  else
                  {
                    if($("#codigoRegistroT").val()=="0")
                    {
                      alertify.error('DEBE SELECCIONAR EL CODIGO DEL TORO')
                      $("#codigoRegistroT").focus().css("background-color", "pink");
                      setTimeout(function(){
                        $("#codigoRegistroT").focus().css("background-color", "white");
                      },2000);
                    }
                    else
                    {
                      $.post("../controlador/reproduccionctrl.php", {
                        action:'guardarCheckCompleto',
                        // se envia al controlador //idAnimal idRazaV  idRazaServ idAnimal idToroServ
                        codVaca:$("#idAnimal").val(),
                        nombeVaca:$("#nombreVacaR").val(),
                        razaVaca:$("#idRazaV").val(),
                        fechCelo:$("#fechaCeloVaca").val(),
                        servicio:$("#servido").val(),
                        metodoRep:$("#metodos").val(),
                        codigoTorP:$("#codigoRegistroT").val(),
                        nombreTorP:$("#nomToro").val(),
                        razaTorP:$("#idRazaServ").val(),
                        //ResponsableRep:$("#idresponsableRep").val(),
                        observacionesRep:$("#observacionesRep").val(),
                        }, function(data){
                          if(data.resultd=="1")
                            {   $("#codigoVaca").val(""),
                                $("#idAnimal").val(""),
                                $("#nombreVacaR").val(""),
                                $("#razaVacaR").val(""),//LIMPIAR CAJA DE TEXTO CUANDO SE GUARDE
                                $("#idRazaV").val(""),
                                $("#fechaCeloVaca").val(""),
                                $("#servido").val(""),
                                $("#metodos").val(""),
                                $("#codigoRegistroT").val(""),
                                $("#idToroServ").val(""),                                
                                $("#nomToro").val(""),
                                $("#razToro").val(""),
                                $("#idRazaServ").val(""),
                                $("#responsableRep").val(""),
                                $("#idresponsableRep").val(""),
                                $("#observacionesRep").val("");
                                alertify.success(data.msj);
                                setTimeout(function(){
                                  $("#btncerrarReproduccion").trigger("click");
                                },300);
                                listarServicioT();
                            }
                          else
                            {
                              alertify.error(data.msj);
                            }
                        }, 'json'); 
                    }                    
                  }                
				}
            }
        if($("#servido").val()=="2")
              { 
                if($("#observacionesRep").val()==""){
                  alertify.error('campo obligatorio')
                      $("#observacionesRep").focus().css("background-color", "pink");
                      setTimeout(function(){
                        $("#observacionesRep").focus().css("background-color", "white");
                      },2000);
                }
                else
                {                   
                  if($("#fechaCeloVaca").val()=="")
                  {
                    alertify.error('DEBE SELECCIONAR LA FECHA')
                    $("#fechaCeloVaca").focus().css("background-color", "pink");
                      setTimeout(function(){
                        $("#fechaCeloVaca").focus().css("background-color", "white");
                      },2000);
                  }
                  else
                  {
                    $.post("../controlador/reproduccionctrl.php", {
                    action:'guardarCheck',
                    // se envia al controlador
                    codVaca:$("#idAnimal").val(),
                    nombeVaca:$("#nombreVacaR").val(),
                    razaVaca:$("#idRazaV").val(),
                    fechCelo:$("#fechaCeloVaca").val(),
                    servicio:$("#servido").val(),
                    //ResponsableRep:$("#idresponsableRep").val(),
                    observacionesRep:$("#observacionesRep").val()
                    }, function(data){                      
                      if(data.resultd=="1")
                        {   $("#codigoVaca").val(""),
                            $("#nombreVacaR").val(""),
                            $("#idAnimal").val(""),
                            $("#razaVacaR").val(""),//LIMPIAR CAJA DE TEXTO CUANDO SE GUARDE
                            $("#idRazaV").val(""),
                            $("#fechaCeloVaca").val(""),
                            $("#servido").val(""),
                            $("#responsableRep").val(""),
                            $("#idresponsableRep").val(""),
                            $("#observacionesRep").val("");
                            alertify.success(data.msj);
                            setTimeout(function(){
                              $("#btncerrarReproduccion").trigger("click");
                            },300);
                            listarServicioT();
                        }
                      else
                        {
                          alertify.error(data.msj);
                        }
                    }, 'json'); 
                  }
                
                }
            }
        });
        //FIN REGISTRAR REPRODUCCION 
        $("#no").trigger("click");

        
  });