<?php
require_once './includes/head.php';
require_once './includes/topbar.php';
?>

<div class="w-10/12 xl:w-4/6 px-8 xl:px-96 mx-auto h-screen mt-10 xl:mt-36">
    <div>
        <form class="bg-indigo-800 py-4 px-12 mx-auto px-auto">
            <div>
                <h4 class="text-center text-white font-bold text-2xl">Iniciar Sesion</h4>
            </div>
            <div class="mt-2 block">
                <label class="block text-white font-bold mb-2 text-lg" for="dni">Dni</label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline text-md"
                    id="dni" name="dni" type="text" placeholder="dni">
            </div>
            <div class="mt-4">
                <label class="block text-white font-bold mb-2 text-lg" for="password">Clave</label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline text-dm"
                    id="password" name="password" type="password" placeholder="********">
            </div>
            <div class="mt-8 text-end mb-4"><button type="submit" id="loginButtonn"
                    class="bg-white p-2 rounded-xl">Inciar Sesion</button>
            </div>

        </form>
    </div>
    <h2 class="text-3xl"></h2>
</div>
<script src="./js/login.js"></script>
<?php require_once './includes/footer.php';