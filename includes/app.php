<?php 

require __DIR__ . '/../vendor/autoload.php';

// Creamos una instancia de Dotenv y le indicamos donde se encuentra el archivo .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);

// safeLoad() -> Si el archivo no existe, no nos va a marca un error. (es importante porque en el servidor el archivo no va a a exitir)
$dotenv->safeLoad();


require 'funciones.php';
require 'database.php';

// Conectarnos a la base de datos
use Model\ActiveRecord;
ActiveRecord::setDB($db);