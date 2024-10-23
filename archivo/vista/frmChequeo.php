
        <main>
            <!--<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mdChequeo">Chequeo</button>
            <select id="listAnimal" class="form-select">
                <option selected>...</option>
            </select> -->
            <div class="modal fade" id="mdChequeo" tabindex="-1" role="dialog" aria-labelledby="exampleModalabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                    <!-- cabecera del diálogo -->
                        <div class="modal-header modal-header-imline">
                            <h4 class="modal-title mr-5" id="exampleModalLabel">
                                Registrar Chequeo
                            </h4>
                            <button type="button" id="cerrarForm" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" >X</span>
                            </button>
                        </div>
                        <!-- cuerpo del diálogo -->
                        <div class="modal-body">
                            <div class="container">

                                <form class="row g-3">
                                    <div class="col-md-4" hidden>
                                        <input type="text" class="form-control" id="idVacaCheq" name="CodVaca" >
                                        <label for="mail" class="form-label" hidden>Codigo vaca</label>
                                        <input type="email" class="form-control" id="codAnimalBuscado" name="codAnimalBuscado" hidden>
                                    </div>
                                    <!-- <div class="col-md-4">
                                        <label for="direccion" class="form-label">Fecha Registro</label>
                                        <input type="hidden" class="form-control" id="idUsuRegistro" name="idUsuRegistro" value='<?php echo $_SESSION['id_Usu']; ?>'  title='idUsu' >
                                        <input type="hidden" class="form-control" id="nombreUsuRegistro" name="nombreUsuRegistro" value='<?php echo $_SESSION['usuario_Logeado']; ?>' title='NombreUSu' >
                                        <input type="text" class="form-control" id="fechRegChequeo" readonly value="<?php echo $fecha; ?>" placeholder="" >
                                    </div> -->
                                    <div class="col-md-4">
                                        <label for="direccion" class="form-label">Fecha Chequeo</label>
                                        <input type="text" class="form-control" id="fechaChequeo" >
                                    </div>
                                    <div class="col-md-4">
                                        <label for="provincia" class="form-label">Tipo Chequeo</label>
                                        <select id="tipoCheq" class="form-select">
                                            <option value="0">Seleccione...</option>
                                            <option value="1">Visual</option>
                                            <option value="2">Ecografia</option>
                                            <option value="3">Palpacion</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4" id="divCelo">
                                        <label for="provincia" class="form-label">Celo</label>
                                        <select id="CeloCheq" class="form-select">
                                            <option value="0">Seleccione...</option>
                                            <option value="1">No repite Celo</option>
                                            <option value="2">Repite Celo</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4" id="divGestacion">
                                        <label for="provincia" class="form-label">Estado-Rep</label>
                                        <select id="estGestCheq" class="form-select">
                                            <option value="0">Seleccione...</option>
                                            <option value="1">Gestante</option>
                                            <option value="2">Vacia</option>
                                            <option value="3">Por Confirmar</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4" id="divFecServi">
                                        <label for="ciudad" class="form-label">F. ultimo Servicio</label>
                                        <input type="text" class="form-control" id="fechUltSer" name="fechUltSer" readonly>
                                    </div>
                                    <!--DIVICION PARA EL BOTON DEL MODAL DE AJUSTAR LAS ALERTAS-->
                                    <div class="col-md-4" id="divDiasGest">
                                        <label for="provincia" class="form-label">Tmp. Gest. días</label>
                                        <input type="number" class="form-control" id="tmpGestacion" >
                                    </div>
                                    <div class="col-md-4" id="divFechSecado">
                                        <label for="ciudad" class="form-label">F. secado</label>
                                        <input type="text" class="form-control" id="fechSecado" readonly>
                                    </div>
                                    <div class="col-md-4" id="divFechParto">
                                        <label for="ciudad" class="form-label">F. posible parto</label>
                                        <input type="text" class="form-control" id="fechaPosibleParto" name="fechaPosibleParto" readonly>
                                    </div>

                                    <!-- <div class="col-md-4" id="divFechCelo">
                                        <label for="ciudad" class="form-label">Pend. celo</label>
                                        <input type="text" class="form-control" id="" >
                                    </div> -->
                                    <div  class="info-box-content" id="divBtnAlarmas">
                                        <button id="divBtnAlarmas" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mdAlarmas">
                                            <i class="fa fa-bell-o" aria-hidden="true"></i>
                                            Alarmas
                                        </button>
									</div>
                        
                                    <div class="col-md-4" id="">
                                        <label for="provincia" class="form-label" hidden>Responsable</label>
                                        <select id="selectResponsable" class="form-select" hidden>
                                            <option selected>.....</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="comentarios" class="form-label">Observaciones</label>
                                        <textarea class="form-control" rows="5" id="comentariosCheq" name="comentariosCheq"></textarea>
                                    </div>
                                    <!--SECCION DEL MODAL DEL AJUSTE DE LAS ALARMAS-->
                                    <div class="modal fade" id="mdAlarmas">
                                        <div class="modal-dialog modal-sm modal-dialog-centered">
                                            <div class="modal-content">
                                        
                                            <!-- cabecera del diálogo -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">AJUSTE DE ALARMA</h4>
                                                <button type="button" id="btnCerrar" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                        
                                            <!-- cuerpo del diálogo -->
                                            <div class="row ml-3 mt-1">
                                                <div class="form-check form-switch col-md-6">
                                                    <input class="form-check-input" type="checkbox" value="scd" id="checkSecado" name="checkSecado">
                                                    <label class="form-check-label" for="checkSecado" id="secado">
                                                        Secado
                                                    </label>
                                                </div>
                                                <div class="form-check form-switch col-md-6">
                                                    <input class="form-check-input" type="checkbox" value="prt" id="checkParto" name="checkParto">
                                                    <label class="form-check-label" for="checkParto" id="parto">
                                                        Parto
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                <label for="ciudad" class="form-label">Fecha Alerta secado</label>
                                                <input type="text" class="form-control" id="fechaAlertaSec" readonly>
                                            </div>
                                            <div class="modal-body">
                                                <label for="ciudad" class="form-label">Fecha Alerta parto</label>
                                                <input type="text" class="form-control" id="fechaAlertaPart" readonly>
                                            </div>
                                            <div class="modal-body">
                                                <label for="provincia" class="form-label" >Repeticion</label>
                                                <br>
                                                <form>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" value="L" id="checkboxL" name="checkbox4">
                                                        <label class="form-check-label" for="checkbox4" id="lunes">
                                                        L
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" value="M" id="checkboxM" name="checkbox5">
                                                        <label class="form-check-label" for="checkbox5" id="martes">
                                                        M
                                                        </label>
                                                    </div>        
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" value="Mi" id="checkboxMi" name="checkbox6">
                                                        <label class="form-check-label" for="checkbox6" id="miercoles">
                                                        M
                                                        </label>
                                                    </div> 
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" value="J" id="checkboxJ" name="checkbox4">
                                                        <label class="form-check-label" for="checkbox4" id="jueves">
                                                        J
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" value="V" id="checkboxV" name="checkbox5">
                                                        <label class="form-check-label" for="checkbox5" id="viernes">
                                                        V
                                                        </label>
                                                    </div>        
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" value="S" id="checkboxS" name="checkbox6">
                                                        <label class="form-check-label" for="checkbox6" id="sabado">
                                                        S
                                                        </label>
                                                    </div> 
                                                </form>
                                            </div>
                                            <div class="modal-body">
                                                <label for="ciudad" class="form-label">Hora</label>
                                                <input id="reloj" type="time">
                                            </div>
                                            <div class="modal-body">
                                            </div>
                                            <!-- pie del diálogo -->
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" id="btnGuardarAlarm" name="btnGuardarAlarm">Guardar</button>
                                                <button type="button" class="btn btn-danger" id="btnCancelarAlarm" name="btnCancelarAlarm" data-bs-dismiss="modal">Cancelar</button>
                                            </div>
                                            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script> 
                                            </div>
                                        </div>
                                    </div>
                                    <!--FINAL DEL MODAL DE AJUSTE DE ALARMAS-->

                                </form>
                            </div>
                        </div>
                        <!-- pie del diálogo -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="btnGuardarCheque" name="btnGuardarCheque">Guardar</button>
                            <button type="button" class="btn btn-danger"   id="btnCancelarCheq" name="btnCancelarCheq" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- <footer>
            place footer here -->
            <!--
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span id="divChequeo" style="cursor:pointer" data-toggle="modal" data-target="#mdChequeo" class="info-box-icon bg-success elevation-1">
                                <i class="fa fa-venus-mars" aria-hidden="true"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">CHEQUEO</span>
                            </div>
                        </div>
                    </div>
                </div>

                - TENER EN CUENTA QUE EL ANIMAL YA PUEDE LLEVAR
                    TIEMPO DE GESTADA POR ENDE LA ALERTA AUTOMATICA DE LOS 9 MESES NO FERVIRIA
                - BOTON DONDE PUEDAN AJUSTAR EL TIEMPO DE LAS ALERTAS 

                - CUANDO SE SELECCIONE LA OPCION PREÑADA DEBE HABILITARSE LA OPCION DE SELECCIONAR LAS SEMANAS 
                DE GESTACION Y DEPENDIENDO LA CANTIDAD DE SEMANAS QUE SELECCIONE DEBERA OPERARSE CON LA FECHA DEL 
                SERVICIO Y DAR UNA POSIBLE FECHA DEL PARTO

                - que en este formulario se muestre la fecha del 
                - /*'".$_POST['idanimalCheq']."'*/
            -->
        <!-- </footer>
        
        
    </body>

</html>  -->