
$(document).ready(function(){
    //$("#fechaPosibleParto").datepicker();
    $("#fechaChequeo").datepicker();
    $("#fecServi").datepicker();
    $("#fechaAlertaSec").datepicker();
    $("#fechaAlertaPart").datepicker();
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
        $("#divDiasGest").hide();
        $("#divFecServi").hide();
        $("#divBtnAlarmas").hide();
        $("#divFechSecado").hide();
        // CODIGO PARA HABILITAR CALENDARIO SI ESTA PREÑADA  estGestCheq
        //$("#diasAlert").prop('disabled', true);
        /*$("#estGestCheq").on("click", function () {
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
        });*/
        // CODIGO PARA OCULTAR O MOSTRAR EL CELO DEPENDIENDO EL TIPO DE CHEQUEO
        $("#tipoCheq").on("change", function () {
            if ($("#tipoCheq").val()=="0")
                {
                    //$("#diasAlert").prop('disabled', true); //CODIGO PARA BLOQUEAR EL CONTENEDOR
                    // $("#contfechaPosibleParto").hide();
                    $("#divCelo").hide();
                    $("#divGestacion").hide();
                    $("#divFechParto").hide();
                    $("#divDiasAlert").hide();
                    $("#divFechAlert").hide();
                    $("#divDiasGest").hide();
                    $("#divFecServi").hide();
                    $("#divFechSecado").hide();
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
                    $("#divDiasGest").hide();
                    $("#divFecServi").hide();
                    $("#divFechSecado").hide();
                    $("#divBtnAlarmas").hide();
                    $("#estGestCheq").val(0);
                }
            else
                {
                    // $("#contfechaPosibleParto").show();
                    $("#divCelo").hide();
                    $("#divGestacion").show();
                    var idVaca = $("#idAnimalBusqueda").val();
                    //alert(idVaca)
                    $.post("../../archivo/controlador/chequeoPartos_ctrl.php", {
                        action:'fechUltmServ',
                        idanimalCheq:$("#idAnimalBusqueda").val()
                        }, function(data){
                            $("#fechUltSer").val(data.fechaCeloV);	
                        }, 'json');
                }
        });
        // CODIGO PARA MOSTRAR Y OCULTAR CAMPOS DEPENDIENTO EL ESTADO DE GESTACION
        $("#estGestCheq").on("change", function () {
            if ($("#estGestCheq").val()=="1")
                {
                    $("#divFechParto").show();
                    $("#divDiasAlert").show();
                    $("#divFechAlert").show();
                    $("#divDiasGest").show();
                    $("#divFecServi").show();
                    $("#divBtnAlarmas").show();
                    $("#divFechSecado").show();

                        const fechaInicial = new Date(document.getElementById("fechUltSer").value);
                        //const diasARestar = document.getElementById("diasAlert");
                        fechaInicial.setMonth(fechaInicial.getMonth() + 9);
                        const fechaResultado = fechaInicial.toISOString().slice(0,10);
                        document.getElementById("fechaPosibleParto").value = fechaResultado;

                        const fechaEntrada = new Date(document.getElementById("fechaPosibleParto").value);
                        //const diasARestar = document.getElementById("diasAlert");
                        fechaEntrada.setMonth(fechaEntrada.getMonth() - 2);
                        const fechaSalida = fechaEntrada.toISOString().slice(0,10);
                        document.getElementById("fechSecado").value = fechaSalida;
            }
            else{
                $("#divFechParto").hide();
                $("#divCelo").hide();
                $("#divDiasGest").hide();
                $("#divFecServi").hide();
                $("#divBtnAlarmas").hide();
                $("#divFechSecado").hide();
                }
        });
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
            else if ($("#tipoCheq").val() == "1" && $("#CeloCheq").val() == "0")
            {
                alertify.error("Debe seleccionar un dato");
                $("#CeloCheq").focus();
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
                    if (data.result == 1)
                    {
                        alertify.success("DATOS GUARDADOS CORECTAMENTE");
                        $("#mdChequeo").modal("hide");
                    }
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

         //CODIGO PARA LIMPIAR LAS CAJAS AL CERRAR CON LA X MODAL REGISTRO DE CHEQUOE
        $("#cerrarForm").on("click", function () {
            $("#fechaChequeo").val("");
            $("#tipoCheq").val(0);
            $("#CeloCheq").val("");
            $("#fechUltSer").val("");
            $("#tmpGestacion").val("");
            $("#fechSecado").val("");
            $("#fechaPosibleParto").val("");
            $("#comentariosCheq").val("");
            $("#estGestCheq").val(0);

            $("#divGestacion").hide();
            $("#divFechParto").hide();
            $("#divCelo").hide();
            $("#divDiasGest").hide();
            $("#divFecServi").hide();
            $("#divBtnAlarmas").hide();
            $("#divFechSecado").hide();
        });
        //CODIGO PARA LIMPIAR LAS CAJAS AL CERRAR CON CANCELAR MODAL REGISTRO DE CHEQUOE
        $("#btnCancelarCheq").on("click", function () {
            $("#fechaChequeo").val("");
            $("#tipoCheq").val(0);
            $("#CeloCheq").val("");
            $("#fechUltSer").val("");
            $("#tmpGestacion").val("");
            $("#fechSecado").val("");
            $("#fechaPosibleParto").val("");
            $("#comentariosCheq").val("");
            $("#estGestCheq").val(0);

            $("#divGestacion").hide();
            $("#divFechParto").hide();
            $("#divCelo").hide();
            $("#divDiasGest").hide();
            $("#divFecServi").hide();
            $("#divBtnAlarmas").hide();
            $("#divFechSecado").hide();
        });

        // CODIGO PARA GUARDAR ALARMAS 
        const checkboxsec = document.getElementById("checkSecado");
        const checkboxpart = document.getElementById("checkParto");
        const checkboxLu = document.getElementById("checkboxL");
        const checkboxMa = document.getElementById("checkboxM");
        const checkboxMie = document.getElementById("checkboxMi");
        const checkboxJu = document.getElementById("checkboxJ");
        const checkboxVi = document.getElementById("checkboxV");
        const checkboxSa = document.getElementById("checkboxS");
        $("#btnGuardarAlarm").on("click", function () {
            if (!$("#checkSecado").prop("checked") && !$("#checkParto").prop("checked")) 
            {
                // código a ejecutar si alguno de los dos no está seleccionado 
                alertify.error("DEBE SELECCIONAR UNA ALERTA");
            }
            else if ($("#fechaAlerta").val() == "") 
            {
                // código a ejecutar si alguno de los dos no está seleccionado 
                alertify.error("DEBE SELECCIONAR UNA FECHA");
                $("#fechaAlerta").focus();
            }
            else if ($("#reloj").val() == "") 
            {
                // código a ejecutar si alguno de los dos no está seleccionado 
                alertify.error("DEBE SELECCIONAR UNA HORA");
                $("#reloj").focus();
            }
            else 
            {
                $.post("../../archivo/controlador/chequeoPartos_ctrl.php", {
                    action:'GuardarAlarma',
                    secadoAlarmJs:$("#checkSecado").val(),
                    partoAlarmJs:$("#checkParto").val(),
                    fechAlarmSecJs:$("#fechaAlertaSec").val(),
                    fechAlarmPartJs:$("#fechaAlertaPart").val(),
                    lunAlarmSecJs:$("#checkboxL").val(),
                    marAlarmSecJs:$("#checkboxM").val(),
                    mierAlarmSecJs:$("#checkboxMi").val(),
                    jueAlarmSecJs:$("#checkboxJ").val(),
                    vierAlarmSecJs:$("#checkboxV").val(),
                    sabAlarmSecJs:$("#checkboxS").val(),
                    relojAlarmSecJs:$("#reloj").val(),
                    idRazVacaCheqAlarm:$("#idAnimalBusqueda").val(),
                    }, 
                    function(data){
                        if (data.resultad == 1)
                        {
                            alertify.success("DATOS GUARDADOS CORECTAMENTE");
                            setTimeout(function(){
                                $("#btnCancelarAlarm").trigger("click");
                                checkboxsec.checked = false;
                                checkboxpart.checked = false;
                                $("#fechaAlerta").val("");
                                checkboxLu.checked = false;
                                checkboxMa.checked = false;
                                checkboxMie.checked = false;
                                checkboxJu.checked = false;
                                checkboxVi.checked = false;
                                checkboxSa.checked = false;
                                $("#reloj").val("");
                                },300);
                        }
                    //alert(data.msj)
                    },
                    "json");
            }
        });
        // CODIGO PARA APARECER FECHA DE SECADO DENTRO DE ALARMA
        $("#checkSecado").on("change", function () {
            var fecSec = $("#fechSecado").val(); 
            if ($("#checkSecado").prop("checked"))
            {
                $('#fechaAlertaSec').val(fecSec);
                //alert(fecSec);
            }
            else {
                $("#fechaAlertaSec").val("");
            }
        });
        // CODIGO PARA APARECER FECHA DE PARTO DENTRO DE ALARMA
        $("#checkParto").on("change", function () {
            var fecSec = $("#fechaPosibleParto").val(); 
            if ($("#checkParto").prop("checked"))
            {
                $('#fechaAlertaPart').val(fecSec);
                //alert(fecSec);
            }
            else {
                $("#fechaAlertaPart").val("");
            }
        });

        $("#btnCerrar").on("click", function () {
            $('#checkSecado').prop('checked', false)
            $('#checkParto').prop('checked', false)
            $("#fechaAlertaSec").val("");
            $("#fechaAlertaPart").val("");
            $('#checkboxL').prop('checked', false)
            $('#checkboxM').prop('checked', false)
            $('#checkboxMi').prop('checked', false)
            $('#checkboxJ').prop('checked', false)
            $('#checkboxV').prop('checked', false)
            $('#checkboxS').prop('checked', false)
            $("#reloj").val("");
        });
        $("#btnCancelarAlarm").on("click", function () {
            $('#checkSecado').prop('checked', false)
            $('#checkParto').prop('checked', false)
            $("#fechaAlertaSec").val("");
            $("#fechaAlertaPart").val("");
            $('#checkboxL').prop('checked', false)
            $('#checkboxM').prop('checked', false)
            $('#checkboxMi').prop('checked', false)
            $('#checkboxJ').prop('checked', false)
            $('#checkboxV').prop('checked', false)
            $('#checkboxS').prop('checked', false)
            $("#reloj").val("");
        });
        function ok(msj){
            alertify.success(msj); 
            return false;
        }
        
        function error(msj){
            alertify.error(msj); 
            return false; 
        }

        $("#editarCheq").on("click", function() {
            alert("dentro de Borrar Chequeo")
            // ... (código existente)
        });

    });