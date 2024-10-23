<!-- Modal -->
<style>
    #rounded-video-container {
        border-radius: 5px; /* Radio del borde redondeado */
        width: 100%; /* Asegura que el contenedor se ajuste a la pantalla */
        height: calc(100vh - 200px); /* Ajusta la altura del contenedor a casi toda la pantalla */
        overflow: hidden; /* Asegura que el contenido no se desborde */
    }
    #rounded-video-container video {
        border-radius: 5px; /* Asegura que el video también tenga el borde redondeado */
        width: 100%; /* Asegura que el video se ajuste al contenedor */
        height: 100%; /* Asegura que el video se ajuste al contenedor */
        object-fit: cover; /* Asegura que el video se cubra completamente el contenedor */
    }
    @media (max-width: 767px) {
        .modal-dialog {
            margin: 0;
            max-width: 100%;
            height: 100%;
        }
        .modal-content {
            height: 100%;
            border: none;
            border-radius: 0;
        }
        .modal-header, .modal-body {
            padding: 10px;
        }
    }
</style>
<div class="modal fade" id="modalCameraAnimal" tabindex="-1" aria-labelledby="cameraModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-fullscreen-sm-down"> <!-- Ajuste para pantalla completa en dispositivos pequeños -->
        <div class="modal-content">
            <div class="modal-body">
                <input type="text" id="idAnimalImagenes" hidden>
                <div class="ratio ratio-16x9 mb-3" id="rounded-video-container">
                    <video id="video" autoplay playsinline></video>
                </div>
                <canvas id="canvas" style="display:none;"></canvas>
                <!-- Agrega este div para mostrar el mensaje de instrucciones -->
                <div id="mensajeInstruccion" class="text-center mb-3">
                    <strong>Posiciónate para la primera foto: Perfil derecho.</strong>
                </div>
                <div style="display:flex; justify-content:center; margin-bottom: 1rem;">
                    <button id="flipButton" class="btn btn-warning w-25" style="margin-right: 1rem; color:white;"><i class="fa-solid fa-rotate"></i></button>
                    <button id="tomarFoto" class="btn btn-success w-25" style="margin-right: 1rem;"><i class="fa-regular fa-circle"></i>
                    </button>
                    <button type="button" class="btn btn-danger w-25" data-dismiss="modal"><i class="fa-solid fa-arrow-left"></i></button>
                </div>
                <div id="contenedorDeTarjetas"></div>
                <div id="overlay" class="d-none position-fixed top-0 start-0 w-100 h-100 bg-dark bg-opacity-75 d-flex align-items-center justify-content-center">
                    <div class="text-center text-white">
                        <div class="spinner-grow text-light" style="width: 15rem; height: 15rem;" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-3"><strong>Eliminando imagen, por favor espere...</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="imageViewer" class="viewer" style="display: none; align-content:center; justify-content:center; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.8); justify-content: center; align-items: center; flex-direction: column; z-index: 1000;">
    <span class="close" style="position: absolute; top: 20px; right: 30px; font-size: 40px; color: white; cursor: pointer;">&times;</span>
    <img class="viewer-content" id="viewerImage" style="width: auto; height: 80%; max-width: 90%;">
    <div class="viewer-controls" style="margin-top: 20px; display: flex; gap: 10px;">
        <a id="viewFullImage" href="#" target="_blank" style="background-color: #FFC300; color: black; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-size: 16px;">Ver en otra página</a>
        <a id="downloadImage" href="#" download style="background-color: #FFC300; color: black; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-size: 16px;">Descargar</a>
    </div>
</div>
</div>


