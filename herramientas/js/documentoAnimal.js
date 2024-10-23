$(function(){
    $(document).on('click', '#downloadDocumentAnimal', function(){
   
        var idAnimal = $('#idAnimalBusqueda').val();
        $('#idAnimaPdf').val(idAnimal);
        $('#pdfForm').submit();
        // alert($('#idAnimalBusqueda').val());
        // $.post("../controlador/generarPdfDocument.php", {
        //     action:'generarPdf',
        //     idAnimaPdf:$('#idAnimalBusqueda').val()
        //         }, function(data){
        //             $("#areasList").html(data.listaArea);
        //         }, 'json');
    })
})