<div class="bg-slate-400 py-12 px-8 mx-auto flex justify-between items-center">
    <div>
        <a href="index.php" class="font-bold text-white text-5xl">Sistema Transferencia</a>
    </div>
    <div>
        <button class="py-4 bg-white px-3 rounded-xl text-xl" type="button" id="cerrarSesion">Cerrar Sesion</button>
    </div>
</div>
<script>
     let btnLogout = document.querySelector('#cerrarSesion')
        btnLogout.addEventListener("click", async function() {
             localStorage.removeItem("token");
            window.location.href = 'login.php'
        });
</script>