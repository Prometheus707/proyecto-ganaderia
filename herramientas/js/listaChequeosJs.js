$(document).ready(function() {
    $("#divListCheq").on("click", function() {
        $.post("../../archivo/controlador/chequeoPartos_ctrl.php", {
            action: 'listChequeo',
            idanimalCheq: $("#idAnimalBusqueda").val()
        }, function(data) {
            $("#tablaChequeos").empty(); // Limpiar filas existentes

            // Crear nuevas filas para cada registro
            $.each(data.rows, function(index, row) {
                var newRow = $("<tr></tr>");
                newRow.append("<td>" + row.fechaRegBar + "</td>");
                newRow.append("<td>" + row.chequeosBase + "</td>");
                newRow.append("<td>" + row.estadoGestBar + "</td>");
                newRow.append("<td>" + row.idestadoGestBar + "</td>");
                newRow.append("<td>  <button type='button' class='btn bg-success'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button></td>");
                newRow.append("<td>  <button class='btn' id='btnEliminarCardPajilla' style='background-color: red; color: #fff; margin-right: 1rem;' ><i class='fa-solid fa-trash'></i></button></td>");
                $("#tablaChequeos").append(newRow);
            });
        }, 'json');
    });
    $("#btnEliminarCardPajilla").on("click", function() {
        alert('Borrar');
        // ... (código existente)
    });
});