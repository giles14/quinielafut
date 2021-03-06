<?php

ini_set('display_errors', 1);
ini_set('display_starup_error', 1);
error_reporting(E_ALL);

require_once '../vendor/autoload.php';

session_start();

if (file_exists('../.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
    $dotenv->load();
}

use Illuminate\Database\Capsule\Manager as Capsule;
use Aura\Router\RouterContainer;
//use App\Controllers\IndexController;

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => $_ENV['DB_DRIVER'],
    'host'      => $_ENV['DB_HOST'],
    'database'  => $_ENV['DB_NAME'],
    'username'  => $_ENV['DB_USERNAME'],
    'password'  => $_ENV['DB_PASSWORD'],
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
$map->get('muestraFiltroEquipos', '/equipos/filtrado', [
    'controller' => 'App\Controllers\EquipoController',
    'action' => 'mostrarFormularioFiltrado'
]);
$map->post('procesaEquipos', '/equipos/agregar', [
    'controller' => 'App\Controllers\EquipoController',
    'action' => 'procesarFormulario'
]);
$map->get('borraEquipos', '/equipos/borrar/{id}', [
    'controller' => 'App\Controllers\EquipoController',
    'action' => 'borrarEquipo'
]);
$map->get('modificaEquipo', '/equipos/modificar/{id}', [
    'controller' => 'App\Controllers\EquipoController',
    'action' => 'modificarEquipo'
]);
$map->post('procesaModificarEquipo', '/equipos/modificar/{id}', [
    'controller' => 'App\Controllers\EquipoController',
    'action' => 'procesaModificarEquipo'
]);
$map->get('adminUsuarios', '/admin/usuarios', [
    'controller' => 'App\Controllers\UsuarioController',
    'action' => 'indexAction'
]);
$map->post('agregaUsuario', '/admin/usuarios', [
    'controller' => 'App\Controllers\UsuarioController',
    'action' => 'addUser'
]);
$map->get('formhLogin', '/login', [
    'controller' => 'App\Controllers\AuthController',
    'action' => 'formLoad'
]);
$map->get('formhLogout', '/logout', [
    'controller' => 'App\Controllers\AuthController',
    'action' => 'authLogout'
]);
$map->post('authLogin', '/auth', [
    'controller' => 'App\Controllers\AuthController',
    'action' => 'authLogin'
]);
$map->get('admin', '/admin', [
    'controller' => 'App\Controllers\AdminController',
    'action' => 'indexAction',
    'auth' => true
]);
$map->get('prueba', '/prueba/{ides}/{mama}' , [
    'controller' => 'App\Controllers\PruebaController',
    'action' => 'getVar',
]);

$matcher = $routerContainer->getMatcher();
$route = $matcher->match($request);


if(!$route){
    echo 'No se encontró Ruta';
}else{
    
    //agregamos (si hay) los valores de la ruta
    foreach ($route->attributes as $key => $val) {
        $request = $request->withAttribute($key, $val);
    }

    $handlerData = $route->handler;
    $controllerName = $handlerData['controller'];
    $actionName = $handlerData['action'];
    $authenticationNeeded = $handlerData['auth'] ?? false;

    $sessionUserId = $_SESSION['userId'] ?? null;
    if ($authenticationNeeded && !$sessionUserId){
        echo 'protegido, necesitas logearte';
        die;
    }

    //Controller crea una nueva instancia de lo contenido en el arreglo HandlerData->Controller que viene dado desde el Mapeo pues $route->$handler se le dió de argumento
    //el Arreglo, en éste caso cargará el Contenido de 'controller' es decir: App\Controllers\IndexController y esa es la clase que se instanciará en $controller
    $controller = new $controllerName;
    $response = $controller->$actionName($request);
   
    foreach($response->getHeaders()as $name => $values)
    {
        foreach($values as $value) 
        {
            header(sprintf('%s: %s' , $name , $value), false);
        }

    }
        http_response_code($response->getStatusCode());
        echo $response->getBody();    
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
