document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".select_item_bttn").forEach(button => {
        button.addEventListener("click", function () {
            let serviceId = this.getAttribute("data-service-id");
            let hiddenInput = document.getElementById("service_" + serviceId);

            if (hiddenInput.value === "") {
                hiddenInput.value = serviceId;
                this.classList.add("selected");
                this.innerText = "Quitar"; 
            } else {
                hiddenInput.value = "";
                this.classList.remove("selected");
                this.innerText = "Fijar"; 
            }
        });
    });

    document.getElementById('appointment_form').addEventListener('submit', function(event) {
        let selectedServices = Array.from(document.querySelectorAll('input[name="selected_services[]"]'))
            .filter(input => input.value.trim() !== "").length;

        if (selectedServices === 0) {
            alert("Por favor, selecciona al menos un servicio.");
            event.preventDefault();
            return;
        }

        let desiredDateTime = document.getElementById("desired_date_time").value.trim();
        if (!desiredDateTime) {
            alert("Por favor, selecciona una fecha y hora.");
            event.preventDefault();
            return;
        }

        let clientFirstName = document.getElementById('client_first_name');
        let clientLastName = document.getElementById('client_last_name');
        let clientEmail = document.getElementById('client_email');
        let clientPhone = document.getElementById('client_phone_number');

        const namePattern = /^[a-zA-Z\s]+$/;
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const phonePattern = /^\d{10}$/;

        if (!namePattern.test(clientFirstName.value.trim())) {
            alert("El nombre solo puede contener letras y espacios.");
            event.preventDefault();
            return;
        }

        if (!namePattern.test(clientLastName.value.trim())) {
            alert("El apellido solo puede contener letras y espacios.");
            event.preventDefault();
            return;
        }

        if (!emailPattern.test(clientEmail.value.trim())) {
            alert("Por favor, ingresa un correo válido.");
            event.preventDefault();
            return;
        }

        if (!phonePattern.test(clientPhone.value.trim())) {
            alert("El número de teléfono debe tener 10 dígitos.");
            event.preventDefault();
            return;
        }
    });
});
