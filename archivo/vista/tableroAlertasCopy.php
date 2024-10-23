<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../herramientas/themes/tableroReproduccionCopy.css">
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
     <!-- Incluir jQuery desde el CDN de Google -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Incluir jQuery UI desde el CDN de Google -->
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
    <!-- Incluir el CSS de jQuery UI desde el CDN de Google -->
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.css">
    <script defer src="../../herramientas/js/tableroJS.js"></script>
    <title>Document</title>
</head>

<body>
    <div class="headerTablero">
        <h1 class="titleTablero">TABLERO REPRODUCCION</h1>
    </div>
    <main class="mainTabR">
       <div class="tabla">
           <div class="containerTabla" >
            <div class="card">
                
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                              <tr class="headNmaeR">
                                <th class="nomHead" style="width: 10px">#</th>
                                <th  class="nomHead">Cod animal</th>
                                <th  class="nomHead">Nom animal</th>
                                <th  class="nomHead">Estado reproductivo</th>
                                <th  class="nomHead">Fecha ultimo parto</th>
                                <th  class="nomHead">Fecha monta/ia</th>
                                <th  class="nomHead">Posible retorno</th>
                                <th  class="nomHead">Fecha posible parto</th>
                                <th  class="nomHead">Posible retorno</th>
                                <th  class="nomHead">Dias abiertos</th>
                              </tr>
                            </thead>
                            <tbody>
                              <!-- <tr>
                                <td>1.</td>
                                <td>Update software</td>
                                <td>
                                  <div class="progress progress-xs">
                                    <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                  </div>
                                </td>
                                <td><span class="badge bg-danger">55%</span></td>
                              </tr> -->
                            </tbody>
                          </table>
                    </div>
                </div>
                <!-- /.card-body -->
              </div>
           </div>
       </div>
      
    </main>
</body>
</html>