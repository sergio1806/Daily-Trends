<?php
require_once 'modelo/database.php';


   if(isset($_REQUEST['a']))
{       echo 'recibe a'.$_REQUEST['a'];
    $accion = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'Index';
    
    // Instanciamos el controlador
    require_once "controlador/FeedController.php";
    $controller = 'FeedController';
    $controller = new $controller;
    
    // Llama la funcion deseada del controlador 
    call_user_func( array( $controller, $accion ) );
}else
{
      require_once "controlador/FeedController.php";
    $controller = 'FeedController';
    $controller = new $controller;
    $controller->Index(); 
}
