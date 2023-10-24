<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\LoginController;
use Controllers\HomeController;
use MVC\Router;

$router = new Router();

//iniciar sesion
$router-> get('/',[LoginController::class,'login']);
$router-> post('/',[LoginController::class,'login']);
$router->get('/logout',[LoginController::class,'logout']);


//recuperar password
$router-> get('/olvide',[LoginController::class,'olvide']);
$router-> post('/olvide',[LoginController::class,'olvide']);
$router-> get('/recuperar',[LoginController::class,'recuperar']);
$router-> post('/recuperar',[LoginController::class,'recuperar']);

//crear cuentas
$router-> get('/crear-cuenta',[LoginController::class,'crear']);
$router-> post('/crear-cuenta',[LoginController::class,'crear']);

//comfirmar cuenta 
$router->get('/confirmar-cuenta',[LoginController::class,'confirmar']);
$router->get('/mensaje',[LoginController::class,'mensaje']);


//area privada se devio iniciar secion para llegar a esta seccion

$router->get('/home',[HomeController::class,'index']);


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();