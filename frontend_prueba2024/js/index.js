let montoRestante = 0
//AL CARGAR EL DOM SE EJECUTA UNA FUNCION QUE OBTEIENE EL DINERO ACTUAL DEL USUARIO
document.addEventListener('DOMContentLoaded', async function () {
    try {
        await getMontoRestante()
    } catch (error) {
        console.log(error);
    }
})

const enviarDinero = document.querySelector('#enviarDinero')

//FUNCION PARA LA EJECUCION DE LA TRANSFERENCIA
enviarDinero.addEventListener('click', async function (e) {
    e.preventDefault()
    const dni = document.querySelector("#dni").value;
    const monto = document.querySelector("#monto").value;
    let parsedData = parseJwt()
    console.log(parsedData.type_user_id);
    if (montoRestante == 0) {
        showMessage("No tiene saldo disponible para hacer transferencia")
        return
    }
    if (parsedData.type_user_id == 1) {
        if (dni.trim() !== '' && monto.trim() !== '') {
            if (parseFloat(monto) > parseFloat(montoRestante)) {
                showMessage("No puede enviar mas monto del que tiene")
                return
            }
            try {
                const simulateTrans = await simulateTransaction()
                if (simulateTrans.status == 200) {
                    try {
                        let dataSend = {
                            pagador: parsedData.id_usuario,
                            pagado: dni,
                            monto: parseFloat(monto)
                        }
                        const response = await _post('transaction/generate', dataSend)
                        if (response.Codigo == 1) {
                            await getMontoRestante()
                            showMessage("Transaccion correcta")
                        }
                    } catch (error) {

                    }
                }
            } catch (error) {
                showMessage('Ocurrio un error')
            }
        } else {
            showMessage("Complete todo el formulario")
        }
    } else {
        showMessage("Los usuarios comerciantes no pueden hacer transferencias")
    }
})

//FUNCION QUE OBTEIENE EL TOKEN DEL LOCALSTORAGE Y OBTIENE SUS VALORES PARSEADOS
function parseJwt() {
    var base64Url = jwt.split(".")[1];
    var base64 = base64Url.replace(/-/g, "+").replace(/_/g, "/");
    var jsonPayload = decodeURIComponent(
        window
            .atob(base64)
            .split("")
            .map(function (c) {
                return "%" + ("00" + c.charCodeAt(0).toString(16)).slice(-2);
            })
            .join("")
    );

    return JSON.parse(jsonPayload);
}

//UTILITARIO PARA MOSTRAR MENSAJES
function showMessage(message = "") {
    alert(message);
}
//SIMULACION DE LA TRANSACCION PEDIDA
async function simulateTransaction() {
    let response = ''
    try {
        const res = await fetch("https://run.mocky.io/v3/1f94933c-353c-4ad1-a6a5-a1a5ce2a7abe");
        response = res
    } catch (error) {
        alert("Ocurrio un error");
    }
    return response
}
//FUNCION QUE OBTEIENE EL DINERO ACTUAL DEL USUARIO
async function getMontoRestante() {
    try {
        const response = await _get("user/get/monto/restante");
        if (response.Codigo == 1) {
            const saldoRestante = document.querySelector('#saldoRestante')
            console.log('object');
            montoRestante = response.saldo
            saldoRestante.innerHTML = montoRestante
        }
    } catch (error) {
        console.log(error);
    }
}