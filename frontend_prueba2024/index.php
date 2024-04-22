<?php
require_once './includes/head.php';
require_once './includes/topbar.session.php';
?>

<div class="w-10/12 xl:w-4/5 px-8 xl:px-96 mx-auto h-screen mt-10 xl:mt-16">
    <h2 class="text-3xl text-center">Tu saldo restante es: <span id="saldoRestante" class="font-bold"></span></h2>
    <div class="mt-10"  >
        <form class="bg-indigo-800 py-4 px-12 mx-auto px-auto">
            <div class="mt-2 block">
                <label class="block text-white font-bold mb-2 text-lg" for="dni">Dni</label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline text-md"
                    id="dni" name="dni" type="text" placeholder="12345678">
            </div>
            <div class="mt-4">
                <label class="block text-white font-bold mb-2 text-lg" for="monto">Monto</label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline text-dm"
                    id="monto" name="monto" type="text" placeholder="0.00"
            </div>
            <div class="mt-8 text-end mb-4"><button type="submit" id="enviarDinero"
                    class="bg-white p-2 rounded-xl">Enviar Dinero</button>
            </div>

        </form>
    </div>
</div>
<?php
require_once './includes/footer.php';
require_once './includes/footer.session.php';
?>
<script src="./js/index.js"></script>