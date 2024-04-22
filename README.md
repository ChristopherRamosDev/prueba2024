Prueba técnica para Senior Backend Developer
//BACKEND
En la carpeta de backend_prueba2004 se encuentra el codigo para ejecutar el servidor que es una API, ejecutelo mediante la linea de comandos mediante
php -S localhost:EL PUERTO QUE DESEE USAR, por ejemplo
php -S localhost:8000

ejecutar el script de database.sql en la raiz en su respectivo SGBD, en mi caso use MYSQLWORKBENCH

dentro de .env configurar los valores respectivos a su conexion a la bd y una PRIVATE_KEY que desee usar



//FONTEND


LUEGO ENTRAR EN la carpeta de frontend_prueba2024 y dentro de la carpeta de js/utils.js cambiar el valor de la variable de url, si ejecuto la api en el puerto 8000 entonces el valor de la variable deberia ser 

const url = 'http://localhost:8000/'  con todo y / al final

recordar que todo se ejecuta con php y apache, por lo que deberia estar en su carpeta respectiva de php, en el caso de usar XAMPP seria dentro de htdocs


