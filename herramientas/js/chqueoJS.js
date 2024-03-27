
$(document).ready(function(){
    
    $("#fechaPosibleParto").datepicker();
    $("#fechaChequeo").datepicker();
    $("#fecServi").datepicker();
    $("#fechaAlerta").datepicker();

    //$("#fechUltSer").val("<?php echo $ultimaFecha; ?>");

         //CODIGO PARA LIMPIAR EL CAMPO AL RECARGAR
        $("#fechaPosibleParto").val("");
        $("#selectResponsable").val("");
        $("#comentariosCheq").val("");

        // CODIGO PARA QUE APARESCA POR DEFECTO EL SELECCIONE VALUE 0
        $("#estGestCheq").val(0);

        // CODIGO PARA INICIAR CON ESTOS CONTENEDORES OCULTOS  
        $("#divGestacion").hide();
        $("#divFechParto").hide();
        $("#divDiasAlert").hide();
        $("#divFechAlert").hide();
        $("#divCelo").hide();
        $("#divSemanasGest").hide();
        $("#divFecServi").hide();
        $("#divBtnAlarmas").hide();
        $("#divFechSecado").hide();
        $("#divFecServi").hide();

        // CODIGO PARA HABILITAR CALENDARIO SI ESTA PREÑADA  estGestCheq
        //$("#diasAlert").prop('disabled', true);
        $("#estGestCheq").on("click", function () {
            if ($("#estGestCheq").val()!="1")
                {
                    //$("#diasAlert").prop('disabled', true); //CODIGO PARA BLOQUEAR EL CONTENEDOR
                    $("#fechaPosibleParto").val("");
                    $("#fechaAlerta").val("");
                    $("#diasAlert").val("");
                }

            else
                {
                    // $("#contfechaPosibleParto").show();
                    // $("#fechaAlerta").show();
                    // $("#diasAlert").show();
                    //$("#diasAlert").prop('disabled', false);
                     //$(varPosibPart);
                }
        });
        // CODIGO PARA OCULTAR O MOSTRAR EL CELO DEPENDIENDO EL TIPO DE CHEQUEO
        $("#tipoCheq").on("click", function () {
            if ($("#tipoCheq").val()=="0")
                {
                    //$("#diasAlert").prop('disabled', true); //CODIGO PARA BLOQUEAR EL CONTENEDOR
                    // $("#contfechaPosibleParto").hide();
                    $("#divCelo").hide();
                    $("#divGestacion").hide();
                    $("#divFechParto").hide();
                    $("#divDiasAlert").hide();
                    $("#divFechAlert").hide();
                    $("#divSemanasGest").hide();
                    $("#divFecServi").hide();
                }
            else if ($("#tipoCheq").val()=="1")
                {
                    //$("#diasAlert").prop('disabled', true); //CODIGO PARA BLOQUEAR EL CONTENEDOR
                    // $("#contfechaPosibleParto").hide();
                    $("#divCelo").show();
                    $("#divGestacion").hide();
                    $("#divFechParto").hide();
                    $("#divDiasAlert").hide();
                    $("#divFechAlert").hide();
                    $("#divSemanasGest").hide();
                    $("#divFecServi").hide();
                }

            else
                {
                    // $("#contfechaPosibleParto").show();
                    $("#divCelo").hide();
                    $("#divGestacion").show();
                }
        });
        // CODIGO PARA MOSTRAR Y OCULTAR CAMPOS DEPENDIENTO EL ESTADO DE GESTACION
        $("#estGestCheq").on("click", function () {
            if ($("#estGestCheq").val()=="0")
                {
                    //$("#diasAlert").prop('disabled', true); //CODIGO PARA BLOQUEAR EL CONTENEDOR
                    // $("#contfechaPosibleParto").hide(); 
                    $("#divFechParto").hide();
                    $("#divDiasAlert").hide();
                    $("#divFechAlert").hide();
                    $("#divSemanasGest").hide();
                    $("#divBtnAlarmas").hide();
                    $("#divFechParto").hide();
                    $("#divFechSecado").hide();
                }
            else if ($("#estGestCheq").val()=="1")
                {
                    //$("#diasAlert").prop('disabled', true); //CODIGO PARA BLOQUEAR EL CONTENEDOR
                    // $("#contfechaPosibleParto").hide();
                    $("#divFechParto").show();
                    $("#divDiasAlert").show();
                    $("#divFechAlert").show();
                    $("#divSemanasGest").show();
                    $("#divFecServi").show();
                    $("#divBtnAlarmas").show();
                    $("#divFechSecado").show();

                    $.post("../../archivo/controlador/chequeoPartos_ctrl.php", {
                        action:'fechUltmServ',
                        //idanimalCheq:$("#codAnimalBuscadoCheq").val()
                        }, function(data){
                            $("#fechUltSer").val(data.fechaCeloV);	
                        }, 'json');

                    //CODIGO PARA AUMENTAR MESES A UNA FECHA
                    /*var cambio = $("#estGestCheq").val();
                    if (cambio == "1"){
                        const fecha = new Date(document.getElementById("fechUltSer").value);
                        fecha.setMonth(fecha.getMonth() + 9);
                        const fechaNueva = fecha.toISOString().slice(0,10);
                        document.getElementById("fechaPosibleParto").value = fechaNueva;                
                    }
                    var cambio = $("#estGestCheq").val();
                    if (cambio == "1"){
                        const fecha = new Date(document.getElementById("fechaPosibleParto").value);
                        fecha.setMonth(fecha.getMonth() - 2);
                        const fechaNueva = fecha.toISOString().slice(0,10);
                        document.getElementById("fechSecado").value = fechaNueva;                
                    }*/
                }

            else
                {
                    // $("#contfechaPosibleParto").show();
                    $("#divFechParto").hide();
                    $("#divDiasAlert").hide();
                    $("#divFechAlert").hide();
                    $("#divSemanasGest").hide();
                    $("#divBtnAlarmas").hide();
                    $("#divFechParto").hide();
                    $("#divFechSecado").hide();
                }
        });
        $("#estGestCheq").on("change", function () {
            if ($("#estGestCheq").val == "1")
            {
                const fecha = new Date(document.getElementById("fechUltSer").value);
                fecha.setMonth(fecha.getMonth() + 9);
                const fechaNueva = fecha.toISOString().slice(0,10);
                document.getElementById("fechaPosibleParto").value = fechaNueva; 
            }
            /*if ($("#estGestCheq").val == "1"){
                const fecha = new Date(document.getElementById("fechaPosibleParto").value);
                fecha.setMonth(fecha.getMonth() - 2);
                const fechaNueva = fecha.toISOString().slice(0,10);
                document.getElementById("fechSecado").value = fechaNueva;            
            }*/
        });
        // CODIGO PARA AUMENTAR DIAS A UNA FECHA 
        /*$("#diasAlert").on('change', function(){
            var alerta = $("#diasAlert").val();
            if (alerta =! 0){
                const fechaInicial = new Date(document.getElementById("fechaPosibleParto").value);
                const diasARestar = document.getElementById("diasAlert");
                fechaInicial.setDate(fechaInicial.getDate() - parseInt(diasARestar.value));
                const fechaResultado = fechaInicial.toISOString().slice(0,10);
                document.getElementById("fechaAlerta").value = fechaResultado;
            } 
        });*/

        // CODIGO PARA GUARDAR CHEQUEO
        $("#btnGuardarCheque").on("click", function () {
            var estado = $("#estGestCheq").val();
            if ($("#fechaChequeo").val() =="") {
                alertify.error("Debe ingresar la fecha de chequeo");
                $("#fechaChequeo").focus();
                
            }
            else if ($("#tipoCheq").val() == "0")
            {
                alertify.error("Debe seleccionar el tipo de chequeo");
                $("#tipoCheq").focus();
            }
            else if ($("#tipoCheq").val() == "1" && $("#Celo").val() == "0")
            {
                alertify.error("Debe seleccionar un dato");
            }
            else if ($("#tipoCheq").val() != "1" && $("#estGestCheq").val() == "0")
            {
                alertify.error("Debe seleccionar un estado");
                $("#estGestCheq").focus();
            }
            else {
                $.post("../../archivo/controlador/chequeoPartos_ctrl.php", {
                action:'GuardarChequeo',

                estGestacion:$("#estGestCheq").val(),
                fechPosibParto:$("#fechaPosibleParto").val(),
                obsrvChequeo:$("#comentariosCheq").val(),
                fechaDCheq:$("#fechaChequeo").val(),
                fechaRegisCheq:$("#fechRegChequeo").val(),
                semanasDGestacion:$("#tmpGestacion").val(),
                nomUsuRegis:$("#nombreUsuRegistro").val(),
                idUsuarioRegis:$("#idUsuRegistro").val(),
                idRazVacaCheq:$("#idAnimalBusqueda").val(),
                fechSecJs:$("#fechSecado").val(),
                fechUltSerJs:$("#fechUltSer").val(),
                celoCheqJs:$("#CeloCheq").val(),
                RespCheq:$("#selectResponsable").val()

                }, 
                function(data){
                    alertify.success("DATOS GUARDADOS CORECTAMENTE");
                //alert(data.msj)
                },
                "json");
                }
            

                $("#estGestCheq").val("");
                $("#fechaPosibleParto").val("");
                $("#comentariosCheq").val("");
                $("#diasAlert").val("");
                //$("#nombreUsuRegistro").val("");
                //$("#idUsuRegistro").val(""); 
                // CODIGO PARA QUE APARESCA POR DEFECTO EL SELECCIONE VALUE 0
                $("#estGestCheq").val(0);
        });

        //CODIGO PARA LIMPIAR LAS CAJAS AL CERRAR CON LA X
        $("#btnCancelar").on("click", function () {
            
            $("#CodVacaCheq").val("");
            $("#razaVacaCheq").val("");
            $("#estGestCheq").val("");

            $("#fechaPosibleParto").val("");
            $("#selectResponsable").val("");
            $("#comentariosCheq").val("");

            // CODIGO PARA QUE APARESCA POR DEFECTO EL SELECCIONE VALUE 0
            $("#estGestCheq").val(0);

        });

         // CODIGO PARA MOSTRAR INFORMACION AUTOMATICA DEPENDIENDO LA VACA QUE SELECCIONE
        /*$("#listAnimal").on('change', function() {
            $("#Chequeo").modal("show");

            $.post("../../archivo/controlador/chequeoPartos_ctrl.php", {
            action:'cargarParto',
            idAnimal: $("#listAnimal").val()
            },
            function(data){
            $("#CodVacaCheq").val(data.codAnimal);
            $("#nameVacaCheq").val(data.nombreAnimal);
            $("#razaVacaCheq").val(data.nombreRaza);
            $("#idVacaCheq").val(data.idAnimal);
            $("#idRazaCheq").val(data.idRaza_FK);
            },
            "json");
        }) */
            
        function ok(msj){
            alertify.success(msj); 
            return false;
        }
        
        function error(msj){
            alertify.error(msj); 
            return false; 
        }

    });