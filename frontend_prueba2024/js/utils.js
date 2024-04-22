//SE DEBE PONER EL LINK DE LA API EN EJECUCION
const url = 'http://localhost:8000/'
// SE OBTIENE EL VALOR DEL JWT
const jwt = localStorage.getItem("token");
//UTILITARIO PARA LAS FUNCIONES QUE USAN EL METODO POST USANDO FETCH, NO SE ESTA USANDO AXIOS
async function _post(urlSend, data) {
    try {
        const response = await fetch(url + urlSend, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        const responseData = await response.json();
        return responseData;
    } catch (error) {
        console.error('Error posting data:', error);
        throw error;
    }
}
//UTILITARIO PARA LAS FUNCIONES QUE USAN EL METODO GET USANDO FETCH, NO SE ESTA USANDO AXIOS
async function _get(urlSend) {
    try {
        const response = await fetch(url + urlSend,
            {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'access_token': jwt // Aquí se agrega el encabezado personalizado
                }
            });
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        const responseData = await response.json();
        return responseData;
    } catch (error) {
        console.error('Error posting data:', error);
        throw error;
    }
}
//UTILITARIO PARA VALIDAR SI LA SESION ESTA ACTIVA 
async function validarSesion() {
    try {
        const resp = await fetch(
            `${url}auth/validate/session/`,
            {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'access_token': jwt // Aquí se agrega el encabezado personalizado
                }
            }
        );
        const responseData = await resp.json();
        return responseData;
    } catch (error) {
        console.error('Error al validar sesión:', error);
        throw error;
    }
}
