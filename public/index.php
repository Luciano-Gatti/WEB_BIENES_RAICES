<?php
require_once __DIR__.'/../includes/app.php';
use MVC\Router;
use Controllers\LoginControllers;
use Controllers\PaginasControllers;
use Controllers\VendedorControllers;
use Controllers\PropiedadControllers;

$router = new Router();

$router->get('/admin', [PropiedadControllers::class, 'index']);

//Admin
//Propiedades 
$router->get('/propiedades/crear', [PropiedadControllers::class, 'crear']);
$router->post('/propiedades/crear', [PropiedadControllers::class, 'crear']);
$router->get('/propiedades/actualizar', [PropiedadControllers::class, 'actualizar']);
$router->post('/propiedades/actualizar', [PropiedadControllers::class, 'actualizar']);
$router->post('/propiedades/eliminar', [PropiedadControllers::class, 'eliminar']);

//Vendedores
$router->get('/vendedores/crear', [VendedorControllers::class, 'crear']);
$router->post('/vendedores/crear', [VendedorControllers::class, 'crear']);
$router->get('/vendedores/actualizar', [VendedorControllers::class, 'actualizar']);
$router->post('/vendedores/actualizar', [VendedorControllers::class, 'actualizar']);
$router->post('/vendedores/eliminar', [VendedorControllers::class, 'eliminar']);

//Todos
//Paginas 
$router->get('/', [PaginasControllers::class, 'index']);
$router->get('/nosotros', [PaginasControllers::class, 'nosotros']);
$router->get('/anuncios', [PaginasControllers::class, 'anuncios']);
$router->get('/anuncio', [PaginasControllers::class, 'anuncio']);
$router->get('/blog', [PaginasControllers::class, 'blog']);
$router->get('/entrada', [PaginasControllers::class, 'entrada']);
$router->get('/contacto', [PaginasControllers::class, 'contacto']);
$router->post('/contacto', [PaginasControllers::class, 'contacto']);

//Login
$router->get('/login', [LoginControllers::class, 'login']);
$router->post('/login', [LoginControllers::class, 'login']);
$router->get('/logout', [LoginControllers::class, 'logout']);


$router->comprobarRutas();