/* ============ TITLE TOOLTIP TOGGLE ============== */
$(function () {
    $('[data-toggle="tooltip"]').tooltip();
});

/*
    ============================

    VALIDAR FORMULARIO DE INICIO DE SESIÓN
    
    ============================
*/

function validateLogInForm() {
    var username_input = document.forms["login-form"]["username"].value;
    var password_input = document.forms["login-form"]["password"].value;

    if (username_input == "" && password_input == "") {
        document.getElementById('required_username').style.display = 'initial';
        document.getElementById('required_password').style.display = 'initial';
        return false;
    }

    if (username_input == "") {
        document.getElementById('required_username').style.display = 'initial';
        return false;
    }
    if (password_input == "") {
        document.getElementById('required_password').style.display = 'initial';
        return false;
    }
}

/*
    ======================================
    
    PÁGINA DEL PANEL ==== > CANCELAR CITA CUANDO SE HACE CLIC EN EL BOTÓN DE CANCELAR

    ========================================
*/
$('.cancel_appointment_button').click(function() {
    var appointment_id = $(this).data('id');
    var cancellation_reason = $('#appointment_cancellation_reason_' + appointment_id).val();
    var do_ = 'Cancelar Cita';

    console.log("Enviando solicitud AJAX:", {
        do: do_,
        appointment_id: appointment_id,
        cancellation_reason: cancellation_reason
    });

    $.ajax({
        url: "ajax_files/appointments_ajax.php",
        type: "POST",
        data: { do: do_, appointment_id: appointment_id, cancellation_reason: cancellation_reason },
        dataType: "json",
        success: function(data) {
            console.log("Respuesta recibida:", data);
            if (data.status === "success") {
                $('#cancel_appointment_' + appointment_id).modal('hide');
                swal("Cita Cancelada", "¡La cita ha sido cancelada exitosamente!", "success")
                .then((value) => {
                    window.location.replace("index.php");
                });
            } else {
                alert('Error: No se pudo cancelar la cita.');
            }
        },
        error: function(xhr, status, error) {
            console.error("Error en AJAX:", error);
            alert('¡ERROR AL PROCESAR LA SOLICITUD!');
        }
    });
});

/*
    ======================================
    
    PÁGINA DE CATEGORÍAS DE SERVICIOS ==== > BOTÓN PARA AGREGAR CATEGORÍA DE SERVICIO

    ========================================
*/
$(document).ready(function() {
    $('#add_category_bttn').click(function() {
        var category_name = $("#category_name_input").val();
        var do_ = "Agregar";

        if ($.trim(category_name) == "") {
            $('#required_category_name').css('display', 'block');
        } else {
            $.ajax({
                url: "ajax_files/service_categories_ajax.php",
                method: "POST",
                data: { category_name: category_name, do: do_ },
                dataType: "JSON",
                success: function(data) {
                    if (data['alert'] == "Advertencia") {
                        swal("Advertencia", data['message'], "warning");
                    }
                    if (data['alert'] == "Éxito") {
                        $('#add_new_category').modal('hide');
                        swal("Nueva Categoría", data['message'], "success").then(() => {
                            location.reload();
                        });
                    }
                },
                error: function(xhr, status, error) {
                    // Mostrar mensaje de error en caso de fallo
                    alert("Error al agg categoria: " + error);
                }
            });
        }
    });
});

/*
    ======================================
    
    PÁGINA DE CATEGORÍAS DE SERVICIOS ==== > BOTÓN PARA ELIMINAR CATEGORÍA DE SERVICIO

    ========================================
*/

$(document).ready(function() {
    // Manejar el clic en el botón de eliminar
    $('.delete_category_bttn').click(function() {
        var category_id = $(this).data('id'); // Obtener el ID de la categoría
        var do_ = "Eliminar"; // Acción a realizar

        // Enviar la solicitud AJAX
        $.ajax({
            url: "ajax_files/service_categories_ajax.php", // Ruta al archivo PHP que maneja la eliminación
            method: "POST",
            data: { category_id: category_id, do: do_ }, // Datos enviados al servidor
            dataType: "JSON",
            success: function(data) {
                if (data['alert'] == "Éxito") {
                    // Mostrar mensaje de éxito y recargar la página
                    swal("Categoría Eliminada", data['message'], "success").then((value) => {
                        window.location.reload(); // Recargar la página para reflejar los cambios
                    });
                } else if (data['alert'] == "Advertencia") {
                    // Mostrar mensaje de advertencia
                    swal("Advertencia", data['message'], "warning");
                }
            },
            error: function(xhr, status, error) {
                // Mostrar mensaje de error en caso de fallo
                alert("Error al eliminar la categoría: " + error);
            }
        });
    });
});

/*
    ======================================
    
    PÁGINA DE CATEGORÍAS DE SERVICIOS ==== > BOTÓN PARA EDITAR CATEGORÍA DE SERVICIO

    ========================================
*/

$(document).ready(function() {
    // Manejar el clic en el botón de editar
    $(document).on('click', '.edit_category_bttn', function() {
        var category_id = $(this).data('id'); // Obtener el ID de la categoría
        var category_name = $("#input_category_name_" + category_id).val(); // Obtener el nombre de la categoría
        var do_ = "Editar"; // Acción a realizar

        // Validar que el nombre no esté vacío
        if ($.trim(category_name) == "") {
            $('#invalid_input_' + category_id).css('display', 'block'); // Mostrar mensaje de error
            return; // Detener la ejecución
        }

        $.ajax({
            url: "ajax_files/service_categories_ajax.php",
            method: "POST",
            data: { category_id: category_id, category_name: category_name, do: do_ }, // Cambia 'action' a 'do'
            dataType: "JSON",
            success: function(data) {
                if (data['alert'] == "Advertencia") {
                    swal("Advertencia", data['message'], "warning");
                } else if (data['alert'] == "Éxito") {
                    swal("Categoría Actualizada", data['message'], "success").then((value) => {
                        window.location.reload(); // Recargar la página para reflejar los cambios
                    });
                }
            },
            error: function(xhr, status, error) {
                alert("Error al actualizar la categoría: " + error);
            }
        });
    });
});

/*
    ======================================
    
    PÁGINA DE SERVICIOS ==== > BOTÓN PARA ELIMINAR SERVICIO

    ========================================
*/

$('.delete_service_bttn').click(function() {
    // Usar esta ruta base que funciona en cualquier entorno
    var baseUrl = window.location.origin + '/webmaquillaje/admin';
    
    $.ajax({
        url: baseUrl + "/ajax_files/services_ajax.php",
        method: "POST",
        dataType: 'json',
        data: { 
            service_id: $(this).data('id'), 
            do: "Delete" 
        },
        success: function(response) {
            if(response.status === 'success') {
                swal("Éxito", response.message, "success").then(() => {
                    location.reload();
                });
            } else {
                swal("Error", response.message, "error");
            }
        },
        error: function(xhr, status, error) {
            console.error("Error completo:", xhr.responseText);
            swal("Error", "No se pudo conectar al servidor", "error");
        }
    });
});