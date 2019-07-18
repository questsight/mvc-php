<?php

// Показ ошибок
ini_set( 'display_errors', 1 );
error_reporting( E_ALL );

// Подключение файлов системы
define( 'ROOT', dirname( __FILE__ ) );
require_once( ROOT . '/components/router.php' );
require_once( ROOT . '/components/functions.php' );
require_once( ROOT . '/components/pagination.php' );

// Установка соединения с БД
require_once( ROOT . '/config/database.php' );

// Объект (экземпляр) класса Router
$router = new Router();
$router -> run();

?>
