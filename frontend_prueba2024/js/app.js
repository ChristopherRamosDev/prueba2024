const registerButton = document.querySelector("#registerButton");
//FUNCION QUE EJECUTA EL REGISTRO DEL USUARIO
registerButton.addEventListener("click", async function (e) {
    e.preventDefault()
    const username = document.querySelector("#username").value;
    const password = document.querySelector("#password").value;
    const tipoUsuario = document.querySelector("#tipoUsuario").value;
    const nombres = document.querySelector("#nombres").value;
    const apellidos = document.querySelector("#apellidos").value;
    const dni = document.querySelector("#dni").value;
    const correo = document.querySelector("#correo").value;
    if (
        username.trim() !== "" &&
        password.trim() !== "" &&
        tipoUsuario.trim() !== "" &&
        nombres.trim() !== "" &&
        dni.trim() !== "" &&
        apellidos.trim() !== "" &&
        correo.trim() !== ""
    ) {
        if (dni.trim().length != 8) {
            showMessage("Dni debe de tener 8 caracteres");
            return;
        }
        try {
            let dataSend = {
                username,
                password,
                tipoUsuario,
                nombres,
                dni,
                correo,
                apellidos
            };
            const response = await _post("auth/signUp", dataSend);
            if (response.Codigo == 1) {
                alert('Registro Correcto');
                window.location.href = 'login.php'
            } else {
                alert(response.msg);
            }
        } catch (error) {
            console.log(error);
        }
    } else {
        showMessage("Complete todo el formulario");
    }
});

//UTILITARIO PARA LANZAR UNA ALERTA

function showMessage(message = "") {
    alert(message);
}
