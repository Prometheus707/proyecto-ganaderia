$(document).ready(function() {
    let fotoContador = 0;  // Contador de fotos
    const maxFotos = 3;    // Máximo de fotos permitidas
    const instruccionesFotos = [
        'Posiciónate para la primera foto: Perfil derecho.',
        'Posiciónate para la segunda foto: Perfil izquierdo.',
        'Posiciónate para la tercera foto: Frente.'
    ];

    // Mostrar la instrucción inicial
    $('#mensajeInstruccion').text(instruccionesFotos[fotoContador]);

    ////////////VISOR PARA IMAGENES////////////////
    function getFileName(url) {
        return url.substring(url.lastIndexOf('/') + 1);
    }
    // Mostrar el visor de imágenes al hacer clic en una miniatura
    $(document).on("click", ".zoom", function() {
        let src = $(this).attr("src");
        $("#viewerImage").attr("src", src);
        $("#viewFullImage").attr("href", src);
        $("#downloadImage").attr("href", src).attr("download", getFileName(src));
        $("#imageViewer").css("display", "flex");
    });
    // Cerrar el visor de imágenes al hacer clic en la "X" de cierre
    $(".close").click(function() {
        $("#imageViewer").css("display", "none");
    });
    // Evitar que el visor se cierre al hacer clic en la imagen o en los controles del visor
    $("#viewerImage, .viewer-controls a").click(function(event) {
        event.stopPropagation();
    });
    // Cerrar el visor al hacer clic fuera de la imagen
    $("#imageViewer").click(function() {
        $(this).css("display", "none");
    });
    ////////////FIN VISOR PARA IMAGENES////////////////
    function listarImagenesAnimal() {
        $.post("../controlador/camaraCtrl.php", {
            action: 'listarImagenesAnimal',
            idAnimalImg: $("#idAnimalImagenes").val()
        }, function(data) {
            if (data.success) {
                $('#contenedorDeTarjetas').html(data.tarjetasImagenes);
                $(".btnElimImagen").prop('disabled', true);
                if(data.numeroFotosAnimales==3){
                    $("#tomarFoto").prop('disabled', true);
                    $('#mensajeInstruccion').text('Has completado las 3 fotos.');
                }else{
                    $("#tomarFoto").prop('disabled', false);
                    
                }
            } else {
                console.error('Error: No se pudieron listar las imágenes.');
            }
        }, 'json');
    }
    $(document).on("click", "#tomarFoto", function() {
        if (fotoContador < maxFotos) {  // Verificar si se pueden tomar más fotos
            capturePhoto();
            fotoContador++;  // Incrementar el contador de fotos
            // Si hay más fotos por tomar, actualizar el mensaje
            if (fotoContador < maxFotos) {
                $('#mensajeInstruccion').text(instruccionesFotos[fotoContador]);
            } else {
                $('#mensajeInstruccion').text('Has completado las 3 fotos.');
                $("#tomarFoto").prop('disabled', true);  // Desactivar el botón de tomar foto
            }
        } else {
            alertify.error('Ya has tomado las 3 fotos requeridas.');
        }
    });
   
    $('#modalCameraAnimal').on('shown.bs.modal', function() {
        startCamera();
        listarImagenesAnimal();
    });
    $('#modalCameraAnimal').on('hidden.bs.modal', function() {
        stopCamera();
    });
    $(document).on("click", "#btnCamaraAnimal", function(){
        var idAnimalFoto = $(this).attr('data-idAnimalFoto');
        $("#idAnimalImagenes").val(idAnimalFoto);
    })
    $(document).on("click", "#btnEliminarCardImagen", function() {
        var imagenCardAnimal = $(this).attr('data-imagen');
        var imagenRuta = $(this).attr('data-rutaFoto');
        
        alertify.confirm("¿Está seguro de eliminar el registro?", function(e) {
            if (e) {
                // Mostrar overlay y barra de progreso
                $("#overlay").removeClass('d-none');
                
                $.post("../controlador/camaraCtrl.php", {
                    action: 'eliminarImagen', 
                    idImagen: imagenCardAnimal,
                    imagenRuta: imagenRuta
                }, function(data) {
                    $("#overlay").addClass('d-none'); // Ocultar overlay y barra de progreso
                    
                    if (data.resultd == "1") {
                        alertify.success(data.msj);
                        listarImagenesAnimal(); 
                    } else {
                        alertify.error(data.msj);
                    }
                }, 'json').fail(function() {
                    $("#overlay").addClass('d-none'); // Ocultar overlay en caso de error
                    alertify.error("Error al eliminar la imagen.");
                });
            } else {
                alertify.error("Cancelado el proceso de eliminación.");
            }
        });
        return false;
    });
    $(document).on("click", "#flipButton", function() {
        flipCamera();
    });
    let stream;
    let facingMode = "user";
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    async function startCamera() {
        try {
            stream = await navigator.mediaDevices.getUserMedia({
                video: { facingMode: facingMode }
            });
            video.srcObject = stream;
    
            // CAMBIO: Aplicar espejado horizontal si la cámara es la frontal (facingMode: "user")
            if (facingMode === "user") {
                video.style.transform = "scaleX(-1)";  // Espejado horizontal
            } else {
                video.style.transform = "scaleX(1)";   // Mantener la vista normal en la cámara trasera
            }
        } catch (err) {
            console.error("Error al acceder a la cámara: ", err);
            alert("Error al acceder a la cámara. Asegúrate de que tu dispositivo tiene una cámara y que has dado permiso para usarla.");
        }
    }
    
    function stopCamera() {
        if (stream) {
            stream.getTracks().forEach(track => track.stop());
        }
        if (video.srcObject) {
            video.srcObject = null;
        }
    }
    async function flipCamera() {
        facingMode = facingMode === "user" ? "environment" : "user";
        stopCamera();
        await new Promise(resolve => setTimeout(resolve, 1000)); // Espera un segundo antes de reiniciar la cámara
        startCamera();
    }
    function capturePhoto() {
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        const ctx = canvas.getContext('2d');
    
        // CAMBIO: Invertir el canvas horizontalmente cuando se usa la cámara frontal
        if (facingMode === "user") {
            ctx.translate(canvas.width, 0);  // Mover el contexto a la derecha
            ctx.scale(-1, 1);  // Invertir el eje X (espejado horizontal)
        }
    
        ctx.drawImage(video, 0, 0);  // Dibujar el video en el canvas (con o sin flip)
    
        const imageDataUrl = canvas.toDataURL('image/jpeg');
        // Enviar la imagen al servidor usando jQuery
        $.post("../controlador/camaraCtrl.php", {
            action: 'guardarImagen',
            imagen: imageDataUrl,
            idAnimalImg: $("#idAnimalImagenes").val()
        }, function(data) {
            if(data.resultd=="1") {   
                alertify.success(data.msj);
                listarImagenesAnimal();
            } else {	
                alertify.error(data.msj);		
            }
        }, 'json');
    }
    
});
