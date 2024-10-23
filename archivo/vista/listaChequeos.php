
<div class="container"> 
    <div class="modal fade" id="listaChequeo">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- cabecera del diálogo -->
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Chequeos Registrados</h5>
            <button type="button" class="btn-close" data-dismiss="modal"></button>
          </div>
          <!-- cuerpo del diálogo -->
          <div class="modal-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Fecha Registro</th>
                        <th scope="col">Fecha Chequeo</th>
                        <th scope="col">Estado</th>
                        <!--<th scope="col">id Chequeo</th>-->
                    </tr>
                </thead>
                <tbody id="tablaChequeos">
                    <!-- Las filas se crearán dinámicamente con jQuery -->
                </tbody>
            </table>
          </div>
          <!-- pie del diálogo -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
  </div>  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>  