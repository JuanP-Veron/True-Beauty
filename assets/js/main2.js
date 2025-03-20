
function vista() {
    var input = document.getElementById("password");
    var icon = document.getElementById("verPassword");
    input.type = input.type === "password" ? "text" : "password";
    icon.classList.toggle("fa-eye-slash");
}
