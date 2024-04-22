<!-- MIDDLEWARE QUE SE EJECUTA HACIENDO LA VERIFICACION DEL TOKEN EXISTENTE EN LOCALSTORAGE -->
<script>
   document.addEventListener('DOMContentLoaded', async function(){
    if(!jwt){
        location.href = "login.php";
        return
    }
    let validador = false
        const session = await validarSesion();
        if (session["Codigo"] == 1) {
            validador = true;
        }
        if (!validador) {
            localStorage.removeItem("jwt");
            location.href = "login.php";
        }
        console.log(session["Codigo"]);
     
   })
</script>