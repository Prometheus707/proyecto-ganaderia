$(function(){
    function rellnarFotoPerfilAnimal(){
        var idAnimalImgHist = $("#idAnimalBusqueda").val();
        $.post("../controlador/camaraCtrl.php", {
			action:'llenarImgMain',
            idAnimalFhistory: idAnimalImgHist,
				}, function(data){
                    if(data.sin_img == false){
                        var imgSrc = data.file_path;
                        var imgElement = $('#imgAnimalH'); // Asegúrate de tener un elemento con este ID en tu HTML
                        imgElement.attr('src', imgSrc);
                        $('#idImgMain').val(data.idPhotoAnimal);
                    }
                    else{
                        var imgElement = $('#imgAnimalH'); // Asegúrate de tener un elemento con este ID en tu HTML
                        imgAtribute ='../../files/fotos/defaultPerfilAnimal.png';
                        imgElement.attr('src', imgAtribute);
                    }
				}, 'json');
    }
    $(document).on('shown.bs.modal', '#mdFotosHistory', function(){
        var idAnimalImgHist = $("#idAnimalBusqueda").val();
        $.post("../controlador/camaraCtrl.php", {
			action:'listImgHistory',
			idFotosH: idAnimalImgHist
				}, function(data){
						$("#imgsHistory").html(data.imgHistory);
				}, 'json');
    })  
    $(document).on('click', '#btnVerHC', function(){
      rellnarFotoPerfilAnimal();    
    })  
    $(document).on('click', '#imgHistory', function(){
        $(this).css({
            'transition': 'transform 0.2s ease', // Duración de 0.6s y suavidad
            'transform': 'scale(0.7)' // Reducir la escala
        });
         // Volver al tamaño original después de 1 segundo (1000 ms)
         setTimeout(() => {
            $(this).css(
                'transform', 'scale(1)');
        }, 1000);
        if ($("#idImgMain").val() === null || $("#idImgMain").val() === "") {
            $("#idImgMain").val(3);
        }
        var idImgH = $(this).attr('data-id-img');
        var idAnimalImgHist = $("#idAnimalBusqueda").val();
        var idImgMain = $("#idImgMain").val()
       // alertify.success(idImgH);
        $.post("../controlador/camaraCtrl.php", {
			action:'cambioImagenPrincipal',
			idDataFhistory: idImgH,
            idAnimalFhistory: idAnimalImgHist,
            idImgMain:idImgMain
				}, function(data){
						if(data.resultd == "1"){
                            alertify.success(data.msj);
                            rellnarFotoPerfilAnimal();
                        }else{
                            alertify.error(data.msj);
                        }
				}, 'json');
    })
})