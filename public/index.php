<?php

ini_set('display_errors', 1);
ini_set('display_starup_error', 1);
error_reporting(E_ALL);

require_once '../vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;
use Aura\Router\RouterContainer;
//use App\Controllers\IndexController;

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'quinielafut',
    'username'  => 'root',
    'password'  => 'lucky',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);
// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();
// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();

$request = Zend\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);

$routerContainer = new RouterContainer();
$map = $routerContainer->getMap();

//Estructura del map: ->get (metodo por el cual se llega). ('NombreDeRuta', 'rutaSolicitada PATH', 'archivoCargadoRegresado Handler')
$map->get('index', '/', [
    'controller' => 'App\Controllers\IndexController',
    'action' => 'indexAction'
]);
$map->get('jornada', '/jornadas/ver', [
    'controller' => 'App\Controllers\JornadaController',
    'action' => 'verJornadas'
]);
$map->get('agregaEquipos', '/equipos/agregar', [
    'controller' => 'App\Controllers\EquipoController',
    'action' => 'mostrarFormulario'
]);
$map->post('procesaEquipos', '/equipos/agregar', [
    'controller' => 'App\Controllers\EquipoController',
    'action' => 'procesarFormulario'
]);
$map->get('borraEquipos', '/equipos/borrar/{id}', [
    'controller' => 'App\Controllers\EquipoController',
    'action' => 'borrarEquipo'
]);
$map->get('adminUsuarios', '/admin/usuarios', [
    'controller' => 'App\Controllers\usuarioController',
    'action' => 'indexAction'
]);
$map->post('agregaUsuario', '/admin/usuarios', [
    'controller' => 'App\Controllers\usuarioController',
    'action' => 'addUser'
]);

$matcher = $routerContainer->getMatcher();
$route = $matcher->match($request);

if(!$route){
    echo 'No se encontró Ruta';
}else{
    $handlerData = $route->handler;
    $controllerName = $handlerData['controller'];
    $actionName = $handlerData['action'];
    //Controller crea una nueva instancia de lo contenido en el arreglo HandlerData->Controller que viene dado desde el Mapeo pues $route->$handler se le dió de argumento
    //el Arreglo, en éste caso cargará el Contenido de 'controller' es decir: App\Controllers\IndexController y esa es la clase que se instanciará en $controller
    $controller = new $controllerName;
    $controller->$actionName($request);
    
    
    //require $route->handler;
    
}

function printElement($job){
    echo $job->title;
    echo ' ';
    echo $job->description;
    echo '<br>';
}



// $route = $_GET['route'] ?? '/';
// if ($route == '/'){
//     require '../index.php';
// }elseif ($route == 'addJob'){
//     require '../addJob.php';
// }
