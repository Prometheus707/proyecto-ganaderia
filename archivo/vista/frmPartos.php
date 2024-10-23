<!----REGISTRO PARTOS---->
<div class="container">
    <div class="modal fade" id="mdPartos" tabindex="-1" role="dialog" aria-labelledby="exampleModalabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <!-- cabecera del diálogo -->
                <div class="modal-header">
                    <h4 class="modal-title mr-5" id="exampleModalLabel">
                        Registro de Partos
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <!-- cuerpo del diálogo -->
                <div class="modal-body">
                    <div class="container">
                        <form class="row g-3">
                            <div class="col-md-4" id="divFechParto">
                                <h6 for="ciudad" class="form-label">Fecha del parto</h6>
                                <input type="text" class="form-control" id="fechaParto"
                                value="<?php echo date("Y-m-d");?>">
                            </div>
                            <div class="col-md-4">
                                <h6  class="form-label">Estado</h6>
                                <select id="estadoCria" name="estadoCria" type="text" class="form-control"
                                    title="peso del novillo">
                                    <option value="0" selected>Seleccione...</option>
                                    <option value="1">Vivo</option>
                                    <option value="2">Muerto</option>
                                    <option value="3">Aborto</option>
                                    <option value="4">Perdida hembrionaria</option>
                                </select>
                            </div>
                            <div class="col-md-4" id="divSexoCria">
                                <h6 for="provincia" class="form-label">Sexo de la cria</h6>
                                <select id="sexocria" name="sexocria" type="text" class="form-control"
                                    title="sexo del novillo">
                                    <option value="0" selected>Seleccione...</option>
                                    <option value="1">Macho</option>
                                    <option value="2">Hembra</option>
                                </select>
                            </div>
                            <div class="col-md-4" id="divPesoNacer">
                                <h6 for="ciudad" class="form-label">peso al nacer</h6>
                                <input type="number" class="form-control" id="pesoNacido"
                                    onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                            </div>
                            <div class="col-md-4" id="divUnidadPeso">
                                <h6 for="provincia" class="form-label">Unidad peso</h6>
                                <select id="unidadPeso" name="unidadPeso" type="text" class="form-control"
                                    title="peso del novillo">
                                    <option value="0" selected>Seleccione...</option>
                                    <option value="1">Gr</option>
                                    <option value="2">Kg</option>
                                </select>
                            </div>
                            <div class="col-md-4" id="divCodioSisPart">
                                <h6  class="form-label">Codigo sistema</h6>
                                <input type="text" class="form-control" id="codigoSistemParto"
                                value="" readonly>
                            </div>
                            <div class="col-md-4">
                                <label for="provincia" class="form-label" hidden>Responsable</label>
                                <input id="idRespParto" class="form-select" value="<?php echo $_SESSION['id_Usu']; ?>" hidden>
                                </input>
                            </div>
                            <div class="col-md-12">
                                <h6 for="observacionParto" class="form-label">Observaciones</h6>
                                <textarea class="form-control" rows="5" id="observacionParto" name="observacionParto"></textarea>
                            </div>
                            <button type="button" id="btnAbrirFromAnimalPart"  name="btnAbrirFromAnimalPart" <?php echo $var_class_button_popup;  ?>  data-toggle="modal" data-target="#ppNuevoRegistro" hidden>modal</button> 

                            <div id="listPartos">

                            </div>
                        </form>
                    </div>
                </div>
                <!-- pie del diálogo -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btnGuardarParto"
                        name="btnGuardarParto">Guardar</button>
                    <button type="button" class="btn btn-danger" id="btnCancelar" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!----ACTUALIZAR PARTOS---->
<div class="container">
    <div class="modal fade" id="mdPartosUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- cabecera del diálogo -->
                <div class="modal-header">
                    <h4 class="modal-title mr-5" id="exampleModalLabel">
                        Actualizar Partos
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <!-- cuerpo del diálogo -->
                <div class="modal-body">
                    <div class="container">
                        <form class="row g-3">
                            <div class="col-md-4">
                                <input type="text" id="idCardPartoUpdate" value="" hidden>
                                <h6  class="form-label">Fecha del parto</h6>
                                <input type="text" class="form-control" id="fechaPartoUpdate" name="fechaPartoUpdate"
                                    value="<?php echo date("Y-m-d");?>">
                            </div>
                            <div class="col-md-4">
                                <h6 for="sexocriaUpdate" class="form-label">Sexo de la cria</h6>
                                <select id="sexocriaUpdate" name="sexocriaUpdate" type="text" class="form-control"
                                    title="sexo del novillo">
                                    <option value="0" selected>Seleccione...</option>
                                    <option value="1">Macho</option>
                                    <option value="2">Hembra</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <h6  class="form-label">peso al nacer</h6>
                                <input type="number" class="form-control" id="pesoNacidoUpdate"
                                    onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                            </div>
                            <div class="col-md-4">
                                <h6  class="form-label">Unidad peso</h6>
                                <select id="unidadPesoUpdate" name="unidadPesoUpdate" type="text" class="form-control"
                                    title="peso del novillo">
                                    <option value="0" selected>Seleccione...</option>
                                    <option value="1">Gr</option>
                                    <option value="2">Kg</option>
                                </select>
                            </div>
                            
                            <div class="col-md-4">
                                <label  class="form-label" hidden>Responsable</label>
                                <input id="idRespPartoUpdate" class="form-select" value="<?php echo $_SESSION['id_Usu']; ?>" hidden>
                                </input>
                            </div>
                            <div class="col-md-12">
                                <h6 for="observacionPartoUpdate" class="form-label">Observaciones</h6>
                                <textarea class="form-control" rows="5" id="observacionPartoUpdate" name="observacionPartoUpdate"></textarea>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- pie del diálogo -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btnUpdateParto"
                        name="btnUpdateParto">Actualizar</button>
                    <button type="button" class="btn btn-danger" id="btnCancelarUpdate" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>