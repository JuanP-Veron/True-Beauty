document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("appointment_form").addEventListener("submit", function (event) {
        let valid = true;
        
        // Obtener los campos del formulario
        const firstName = document.getElementById("client_first_name");
        const lastName = document.getElementById("client_last_name");
        const email = document.getElementById("client_email");
        const phone = document.getElementById("client_phone_number");
        const services = document.querySelectorAll("input[name='selected_services[]']:checked");
        
        // Validación de servicios
        if (services.length === 0) {
            document.getElementById("service_alert").style.display = "block";
            valid = false;
        } else {
            document.getElementById("service_alert").style.display = "none";
        }
        
        // Validación de campos
        [firstName, lastName, email, phone].forEach(field => {
            if (field.value.trim() === "") {
                field.classList.add("is-invalid");
                valid = false;
            } else {
                field.classList.remove("is-invalid");
            }
        });
        
        if (!valid) {
            event.preventDefault(); // Evitar el envío si hay errores
        }
    });
});

