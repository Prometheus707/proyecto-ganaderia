$(document).ready(function() {
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
});