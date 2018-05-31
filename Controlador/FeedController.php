<?php

require_once 'Modelo/Feed.php';

class FeedController {

    private $modelo;

    public function __CONSTRUCT() {
        $this->modelo = new Feed();
    }

    public function Index() {
        require_once 'vista/Feed.php';
    }

    public function Crud() {
        $Feed = new Feed();

        if (isset($_REQUEST['id'])) {
            $Feed = $this->modelo->Obtener($_REQUEST['id']);
        }

        require_once 'Vista/Feed-editar.php';
    }

    public function Guardar() {
        $Feed = new Feed();

        $Feed->id = $_REQUEST['id'];
        $Feed->titulo = $_REQUEST['Titulo'];
        $Feed->descripcion = $_REQUEST['Descripcion'];
        $Feed->fuente = $_REQUEST['Fuente'];
        $Feed->periodico = $_REQUEST['Periodico'];

        $Feed->id > 0 ? $this->modelo->Actualizar($Feed) : $this->modelo->Registrar($Feed);

        header('Location: index.php');
    }

    public function Eliminar() {
        $this->modelo->Eliminar($_REQUEST['id']);
        header('Location: index.php');
    }

    public function DescargarFeed() {

        $handler = curl_init("https://elpais.com/");
        curl_setopt($handler, CURLOPT_SSL_VERIFYPEER, false); // Configura cURL para que no verifique el peer del certificado dado que nuestra URL utiliza el protocolo HTTPS
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, true); //configura cURL para que no muestre los datos recibidos
        $response = curl_exec($handler); // ejecuta la peticion
        curl_close($handler); //cerramos conexion curl
        $doc = new DOMDocument(); //creamos referencia DOMDocument para acceder a los elemento del DOM
        libxml_use_internal_errors(true); // evita que se muestren warning de DOMDocument
        $doc->loadHTML($response); //cargamos el contenido de la web en $doc
        $fci = $doc->getElementById('bloque_actualidad_cuerpo'); //obtenemos referencia a la seccion de articulos de la portada
        $articulos = $fci->getElementsByTagName('article'); // agrupapos en $articulos todos los elementos article
        $c = 0; // contador para extraer solo 5 articulos
        for ($i = 0; $i < 100; ++$i) { //contador para llegar a los 5 articulos en caso de que alguno falle
            $Feed = new Feed();

            $titulos = $articulos[$i]->getElementsByTagName("h2");
            foreach ($titulos as $titulo) {


                if ($titulo->attributes->getNamedItem('class')->nodeValue == "articulo-titulo") { // obtenemos los contenidos de la clase articulo-titulo
                    $Feed->titulo = $titulo->nodeValue;
                }
            }
            $fotos = $articulos[$i]->getElementsByTagName('img');
            foreach ($fotos as $foto) {

                if ($foto->attributes->getNamedItem('data-src')->nodeValue) {
                    $Feed->imagen = $foto->attributes->getNamedItem('data-src')->nodeValue; // obtenemos el src de las imagenes de cada articulo
                }
                $spans = $articulos[$i]->getElementsByTagName('span'); //obtenemos los span de cada articulo
            }
            if (!$Feed->imagen) {
                $Feed->imagen = "no existe"; // si no se recupera una src correcta carga no existente
            }
            foreach ($spans as $span) {
                if ($span->attributes->getNamedItem('class')->nodeValue == "autor-nombre") {// obtenemos el contenido de la clase autor-nombre
                    if ($span->nodeValue) {
                        $Feed->fuente = $span->nodeValue;
                    }
                }
                if ($span->attributes->getNamedItem('class')->nodeValue == "foto-texto") { //obtenemos la descripcion de la foto de portada
                    if ($span->nodeValue) {
                        $Feed->descripcion = $span->nodeValue;
                    }
                }
            }
            if (!$Feed->descripcion) {
                $Feed->descripcion = "no existe";
            }
            if (!$Feed->fuente) {
                $Feed->fuente = "no existe";
            }
            $Feed->periodico = "El Pais";
            if ($Feed->imagen != "no existe") { // en caso de no obtener imagen no contamos este articulo para el total de 5
                $this->modelo->Registrar($Feed);
                ++$c;
                if ($c > 4) { // en caso de tener 5 articulos completos cerramos el bucle
                    break;
                }
            }
        }



        header('Location: index.php');
    }

}
