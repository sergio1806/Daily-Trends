<?php
require_once 'Modelo/Feed.php';

class FeedController{
    
    private $modelo;
    
    public function __CONSTRUCT(){
        $this->modelo = new Feed();
    }
    public function Index(){
        require_once 'vista/Feed.php';
       
    }
    public function Crud(){
        $Feed = new Feed();
        
        if(isset($_REQUEST['id'])){
            $Feed = $this->modelo->Obtener($_REQUEST['id']);
        }

        require_once 'Vista/Feed-editar.php';
    }
    
    public function Guardar(){
        $Feed = new Feed();
        
        $Feed->id = $_REQUEST['id'];
        $Feed->titulo = $_REQUEST['Titulo'];
        $Feed->descripcion = $_REQUEST['Descripcion'];
        $Feed->imagen = $_REQUEST['imagen'];
        $Feed->fuente = $_REQUEST['Fuente'];
        $Feed->periodico = $_REQUEST['Periodico'];

        $Feed->id > 0 
            ? $this->modelo->Actualizar($Feed)
            : $this->modelo->Registrar($Feed);
        
        header('Location: index.php');
    }
    
    public function Eliminar(){
        $this->modelo->Eliminar($_REQUEST['id']);
        header('Location: index.php');
    }
}