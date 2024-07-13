<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::defaultRouteClass(DashedRoute::class);
Router::connect('/user/add', ['controller' => 'Users', 'action' => 'add']);
// Router::scope('/api', function (RouteBuilder $routes) {    
//     $routes->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);
//     $routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);
//     $routes->connect('/user/add', ['controller'=> 'Users', 'action' => 'add']);
//     $routes->fallbacks(DashedRoute::class);
// });