
<!doctype html>

<html lang="en">
    <head>
      <title>Title</title>
      <!-- Required meta tags -->
      <title>REPRODUCCION</title>
      <meta http-equiv='X-UA-compatible' content='IE=edge'>
      <meta http-equiv='content-type' content='text/html; charset=utf-8'>
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <script src='https://kit.fontawesome.com/459929adcc.js' crossorigin='anonymous'></script>
      <link   href='https://fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet'>
      <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
      <script src='https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/jquery-ui.min.js'></script>
      <link   href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT' crossorigin='anonymous'>
      <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <script src='https://code.jquery.com/jquery-3.7.0.js'></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
      <script src='https://kit.fontawesome.com/459929adcc.js' crossorigin='anonymous'></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.26.10/dist/sweetalert2.all.min.js"></script>
      <script type="text/javascript" src="../../herramientas/alertify.js/lib/alertify.js"></script>
      <link rel="stylesheet" href="../../herramientas/alertify.js/themes/alertify.core.css" />
      <link rel="stylesheet" href="../../herramientas/alertify.js/themes/alertify.default.css" />
      <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
      <!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->
      <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
      <script src="../../herramientas/js/servicio.js" type="text/javascript" ></script>
    </head>

    <body>
       
      <header>

      </header>
      <main>

        <div class="col-sm-2">
          <button type="button" name="btnNuevo" id="btnNuevo" class="btn btn-block btn-warning btn-sm btn-sm; cursor:pointer;" data-toggle="modal" data-target="#mdreproduccion">
          <i class="fa fa-registered" aria-hidden="true"></i>Registro</i></button>
        </div>

        <div class="col-sm-2">
          <button type="button" name="btnN" id="btnNu" class="btn btn-block btn-warning btn-sm btn-sm; cursor:pointer;" data-toggle="modal" data-target="#mdreproduccionActualizar">
          <i class="fa fa-registered" aria-hidden="true"></i>Actualizar</i></button>
        </div><br><br>
        <label>vaca automatico</label>
        <select class="form-select" aria-label="Default select example" id="animals" name="animals">
            <option value="0">Seleccione</option>
            <option value="1" id="btnMonta">la dura</option>
            <option value="2" id="btnInseminacion">chirapa coneja</option>
            <option value="5" id="btnInseminacion">PRUEBA ANIMAL</option>
            <option value="6" id="btnInseminacion">carmelita</option>
        </select><br>
        <label>responsable automatico</label>
        <select class="form-select" aria-label="Default select example" id="persons" name="persons">
            <option value="0">Seleccione</option>
            <option value="16" id="btnMonta">prueba apellido</option>
            <option value="1" id="btnInseminacion">juana maria</option>
            <option value="15" id="btnInseminacion">wilmer peña</option>
        </select>


        <table class="table caption-top" id="tableServicios">
            <caption>posible celo</caption>
            <thead>
              <tr>

                <th scope="col">Codigo vaca</th>
                <th scope="col">Nombre vaca</th>
                <th scope="col">Raza vaca</th>
              </tr>
            </thead>
            <tbody>
            <?php
                include('../../include/conex.php');
                $conn=Conectarse();	
                // Realizar la consulta a la base de datos
                $query = "SELECT * FROM servicio ";
                $result = mysqli_query($conn, $query);

                // Mostrar los resultados en la tabla
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>{$row['codigoVacaRep']}</td>";
                    echo "<td>{$row['nombreVacaRep']}</td>";
                    echo "<td>{$row['razaVacaRep']}</td>";
                    echo "</tr>";
                }

                // Liberar el resultado
                mysqli_free_result($result);

                // Cerrar la conexión a la base de datos
                mysqli_close($conn);
            ?>

          </tbody>
        </table>
        <!-- Inicio -->
        <div class="container"> 
          <div class="modal fade" id="mdreproduccion" tabindex="-1" role="dialog" aria-labelledby="exampleModalabel" aria-hidden="true" >
              <div class="modal-dialog modal-dialog-scrollable">
                      <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" >REGISTRO DE SERVICIOS</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">X</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                      <div class="row">
                                                <div class="col-lg-4">
                                                  <h6 class="modal-title">Codigo vaca</h6>  
                                                  <input type="text" class="form-control" id="codigoVaca" aria-describedby="emailHelp"  readonly>
                                                  <input type="text" class="form-control" id="idAnimal" aria-describedby="emailHelp" name="idAnimal" readonly/>
                                                </div>
                                                <div class="col-lg-4">
                                                  <h6 class="modal-title">Nombre vaca</h6>  
                                                  <input type="text" class="form-control" id="nombreVacaR" aria-describedby="emailHelp" readonly>
                                                </div>
                                                <div class="col-lg-4">
                                                  <h6 class="modal-title">Raza vaca</h6>  
                                                  <input type="text" class="form-control" id="razaVacaR" aria-describedby="emailHelp" readonly>
                                                  <input type="text" class="form-control" id="idRazaV" aria-describedby="emailHelp" name="idAnimal" readonly/>
                                                </div>
                                        </div><br>
                                      
                                        <div class="row">
                                                <div class="col-lg-6">
                                                  <h6 class="modal-title">Fecha de celo</h6>
                                                  <input type="text" id="fechaCeloVaca" class="form-control" required  >
                                                </div>
                                                <div class="col-lg-6">
                                                  <h6 class="modal-title">Servido</h6> 
                                                  <select class="form-select" aria-label="Default select example" id="servido">
                                                    <option value="0">Seleccione</option>
                                                    <option value="1" id="si">Si</option>
                                                    <option value="2" id="no">No</option>
                                                  </select>
                                                </div>
                                        </div><br>
                                        <div class="row">
                
                                                <div class="col-lg-12" id="metodo">
                                                  <h6 class="modal-title">Monta/inseminacion</h6> 
                                                  <select class="form-select" aria-label="Default select example" id="metodos" name="metodos">
                                                    <option value="0">Seleccione</option>
                                                    <option value="1" >Monta</option>
                                                    <option value="2" >Inseminacion</option>
                                                  </select>
                                                </div>
                                        </div><br>
                                        <div class="row">
                                            <div class="col-lg-4" id="codigoToro">
                                              <h6 class="modal-title" >Codigo registro Toro</h6>  
                                              <select class="form-select" aria-label="Default select example" id="codigoRegistroT"  >
                                              </select>
                                              <input type="text" class="form-control" id="idToroServ" aria-describedby="emailHelp" name="idAnimal" readonly/>
                                            </div>
                                            <div class="col-lg-4" id="nombreToro">
                                              <h6 class="modal-title">Nombre toro</h6>  
                                              <input type="text" class="form-control" id="nomToro" aria-describedby="emailHelp" readonly>
                                            </div>
                                            <div class="col-lg-4" id="razaToro">
                                              <h6 class="modal-title">Raza toro</h6>  
                                              <input type="text" class="form-control" id="razToro" aria-describedby="emailHelp"  readonly>
                                              <input type="text" class="form-control" id="idRazaServ" aria-describedby="emailHelp" name="idRazaServ" readonly/>
                                            </div>
                                          </div><br>
                                          <div class="row" >
                                              <div class="col-sm-4">
                                                <button type="button" name="btnPajila" id="btnPajila" class="btn btn-block btn-warning btn-sm btn-sm; cursor:pointer;" data-toggle="modal" data-target="#modalPajilla">
                                                <i class="fa fa-registered" aria-hidden="true"></i>pajilla</i></button>
                                              </div>
                                          </div><br>
                                          <div class="row" >
                                              <div class="col-lg-6" id="responsableR">
                                                  <h6 class="modal-title">Responsable</h6> 
                                                  <input type="text" class="form-control" id="responsableRep" aria-describedby="emailHelp"  >
                                                  <input type="text" class="form-control" id="idresponsableRep" aria-describedby="emailHelp"  >
                                              </div>
                                              <div class="col-lg-6">
                                                    <div class="form-group"> 
                                                        <h6 class="modal-title" id="observaciones">Observaciones</h6> 
                                                        <textarea style="width:95%" class="form-control" rows="5" id="observacionesRep"></textarea>
                                                    </div> 
                                              </div>
                                          </div>
                              </div>
                              <div class="modal-footer">
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" id="btnguardarCelo">GUARDAR</button>
                                    <button type="button" class="btn btn-danger"   id="btncerrarReproduccion" data-dismiss="modal">CERRAR</button>
                                  </div>
                              </div>
                      </div>
                      
              </div>	
          </div>

        </div>
          <!-- Inicio Modal pajilla-->
              <div class="modal fade" id="modalPajilla" role="dialog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                <div class="modal-dialog modal-dialog-scrollable">
                  <div class="modal-content">	
                  
                    <!-- inicio cabecera del diálogo -->
                    <div class="modal-header">
                      <h6 class="modal-title">REGISTRO DE PAJILLA</h6>
                      <button type="button" class="close" data-dismiss="modal">X</button>
                    </div>
                    
                
                    <!-- el cuerpo del modal -->
                    <div class="modal-body">
                          <div class="row-12">
                              <div class="col-sm-12" >
                                <h6 class="modal-title" >Numero de registro</h6>
                                <input  type="text" class="form-control" id="numeroRegistroR" >
                              </div>
                          </div><br><br><br>
                          <div class="row-12">
                              <div class="col-sm-12" >
                                <h6 class="modal-title" >Nombre toro</h6>
                                <input  type="text"  class="form-control" id="nombreToroR">
                              </div>
                          </div><br><br><br>
                          <div class="row-12">
                              <div class="col-sm-12" >
                                <h6 class="modal-title" >Raza toro</h6>
                                <select class="form-select" aria-label="Default select example" id="razaPajilla" >

                                </select>
                                <input  type="hidden"  class="form-control" id="idRazaP" aria-describedby="emailHelp" >
                              </div>
                          </div><br><br><br>      
                    <!-- donde se ubican los botones y demas -->
                      <div class="modal-footer">
                        <div class="modal-footer">
                          <button type="button" class="btn btn-primary" id="btnGuardarPajilla" >GUARDAR</button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal" id="cerrarPajilla">CERRAR</button>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
            </div>
            <!-- Cierre Modal pajilla-->		
      </main>

      <footer>
        <!-- place footer here -->
      </footer>
      
      
    </body>
    
</html>
