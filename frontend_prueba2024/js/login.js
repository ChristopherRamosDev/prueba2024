const loginButtonn = document.querySelector("#loginButtonn");
//funcion que ejecuta el inicio de sesion del usuario
loginButtonn.addEventListener("click", async function (e) {
    e.preventDefault()
    const password = document.querySelector("#password").value;
    const dni = document.querySelector("#dni").value;
    if (
        password.trim() !== "" &&
        dni.trim() !== ""
    ) {
        if (dni.trim().length != 8) {
            showMessage("Dni debe de tener 8 caracteres");
            return;
        }
        try {
            let dataSend = {
                password,
                dni,
            };
            const response = await _post("auth/logIn", dataSend);
            console.log(response);
            if (response.Codigo == 1) {
                localStorage.setItem('token', response.token)
                window.location.href = './index.php'
            } else {
                alert("Credenciales incorrectas");
            }
        } catch (error) {
            console.log(error);
        }
    } else {
        showMessage("Complete todo el formulario");
    }
});



function showMessage(message = "") {
    alert(message);
}
