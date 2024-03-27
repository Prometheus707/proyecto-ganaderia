$(document).ready(function(){
	
	// function checkDevice() { 
	// 	if( typeof cordova == 'undefined' || !cordova
	// 	){
	// 		alert("navegador")

	// 	}else{
	// 		alert("celular")
	// 	}
	// }
	////**////// camara inicio //////////////////////////
	$("#mdlCamera").on('shown.bs.modal', function() {
		const video = document.getElementById('video');
		const snap = document.getElementById('snap'); 
		const canvas = document.getElementById('canvas');
		const imageInput = document.getElementById('imageInput');
		// Acceder a la cámara
		navigator.mediaDevices.getUserMedia({video:true})
		.then(stream => {
			video.srcObject = stream;
			video.play(); // Comenzar la reproducción del video
		})
		.catch(error => {
			console.error('Error accessing the camera:', error);
		});

		// Tomar una foto y mostrarla en el canvas
		snap.onclick = function() {
			if (video.srcObject) {
				if (video.srcObject) {
					canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
					// Mostrar imagen tomada    
					canvas.style.display = "block";
					canvas.toBlob(function(blob) {
						const file = new File([blob], "photo.jpg", { type: "image/jpeg" });
						// Guardar la imagen en el input oculto
						const reader = new FileReader();
						reader.onload = function() {
							imageInput.value = reader.result;
							console.log('Imagen guardada en input:', imageInput.value);
						};
						reader.readAsDataURL(file);
					}, 'image/jpeg');
				}
			}
		};
	});

	$(document).on("click", "#GuardarFoto", function(){
		$.post("../controlador/perdidaCtrl.php", {
			action:'guardarImagen',
			imagenMuerte:file
			}, function(data){  
				alertify.success("DATO GUARDADO GUARDADO CORRECTAMENTE...");
			}, 'json');   
	});
	////**////// camara cierre //////////////////////////
	$( function() {
		$( "#fechaPerd" ).datepicker();
	});        
	/*  inicio recibe el codigo del anibal seleccionado  */		 	
	$(document).on("click", "#divPerdidas",function () {
		var idAnimalFk = $("#idAnimalBusqueda").val();	
		alert("id animal: "+idAnimalFk);
		$("#idAnimalFKPerdidas").val(idAnimalFk);
	});		
	/*  cierre recibe el codigo del anibal seleccionado  */		
	$(document).on("click", "#btncerrarperdida", function () {
		$("#guardaperdi").show();
		$("#fechaPerd").val("");
		$("#comentariospernamdi").val(""); 
	});
	$("#comentariospernamdi").val("");
	$("#fechaPerd").val("");
	$(document).on("click", "#guardaperdi", function (){
		if($("#fechaPerd").val()==""){
				alertify.error("DEBE INGRESAR LA FECHA DE LA PERDIDA...")
				$("#fechaPerd").focus().css("background-color", "pink");
				setTimeout(function(){
				$("#fechaPerd").focus().css("background-color", "white");
				},2000);
			}else{
				if($("#comentariospernamdi").val()=="")
					{
						alertify.error("DEBE INGRESAR UNA OBSERVACION...");
						$("#comentariospernamdi").focus().css("background-color", "pink");
							setTimeout(function(){
								$("#comentariospernamdi").focus().css("background-color", "white");
							},2000);
					}else{
							$.post("../controlador/perdidaCtrl.php", {
								action:'guardarperdida',
								fechaPerd:$("#fechaPerd").val(),
								idAnimalFK:$("#idAnimalFK").val(),
								comentariospernamdi:$("#comentariospernamdi").val()
								}, function(data){  
									alertify.success("DATO GUARDADO GUARDADO CORRECTAMENTE...");
									$("#guardaperdi").hide();	
								}, 'json');     
						}
			} 
	}); 
	
});
                            