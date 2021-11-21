<?php
define('S_POST', 'sanitized_post');
$data['titulo'] = "Plantilla formulario";
$data["div_titulo"] = "Formulario";

$_customJs = array("vendor/summernote/summernote-bs4.min.js", "assets/pages/js/formulario.view.js");

//Por comodidad creamos arrays para las variables que se pueden recibir por post y son arrays
$data[S_POST]['selectmultiple'] = array();
$data[S_POST]['opcions'] = array();

//Comprobamos si se ha enviado el formulario y si es así, lo procesamos
if(isset($_POST['submit'])){
    $array = json_decode($_POST['textarea']);
    $resultado=array();
    foreach ($array as $materia => $valor){
        $resultado[]=$materia;
        foreach ($valor as $alumno => $nota){
            $resultado[$materia][]=$alumno;
            $resultado[$materia][$alumno]= $nota;
        }
    }
}

include 'views/templates/header.php';
include 'views/formulario.simon.view.php';
include 'views/templates/footer.php';