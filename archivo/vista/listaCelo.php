<?php include('head.php');?>
<div class="modal fade"  tabindex="-1" aria-hidden="true" id="mdListarCelo">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h1>LISTA POSIBLE CELO: <span id='nombreHembraC' style="color:  #08bb13
;"></span></h1>

            <div class="col-sm-2">
							<!-- <input type='text' name='nombreHembraC' id='nombreHembraC' title='Dato a buscar' placeholder="codigo vaca" class="form-control mb-2 mr-sm-2 mb-sm-0" style="border: none; font-size:3rem;" > -->
						</div>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="table-responsive">
                <table class="table" id="listadoDelCelo">
                    <!-- Aquí va el contenido de tu tabla -->
                </table>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
          </div>
        </div>
    </div>
</div>