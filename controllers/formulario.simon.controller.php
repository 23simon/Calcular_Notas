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
        foreach ($valor as $alumno => $notas){
            $media=0;
            $contador=0;
            foreach ($notas as $nota){
                $media+=$nota;
                $contador++;
            }
            $resultado[$materia][$alumno]= round(($media/$contador) , 2);
        }
    }
    var_dump($resultado=arrayFinal($resultado));
}

function arrayFinal($resultado){
    foreach ($resultado as $materia => $alumnos){
        $media=0;
        $suspenso=0;
        $aprobado=0;
        $contador=0;
        $alumnoMin="";
        $minima=10;
        $alumnoMax="";
        $maxima=0;
        $_resultado[]=$materia;
        
        foreach ($resultado[$materia] as $alumno => $nota){
            $media+= $nota;
            $contador++;
            $nota=$nota;
            if($nota<5){
                $suspenso++;
            }else{
                $aprobado++;
            }
            
            if($nota>$maxima){
                $maxima = $nota;
                $alumnoMax=$alumno;
            }
            if($nota<$minima){
                $minima=$nota;
                $alumnoMin=$alumno;
            }
        }
        $media=$media/$contador;
        
        $_resultado[$materia]['media']= $media;
        $_resultado[$materia]["suspensos"]= $suspenso;
        $_resultado[$materia]["aprobados"]= $aprobado;
        $_resultado[$materia]["max"]["alumno"]=$alumnoMax;
        $_resultado[$materia]["max"]["nota"]=$maxima;
        $_resultado[$materia]["min"]["alumno"]=$alumnoMin;
        $_resultado[$materia]["min"]["nota"]=$minima;
    }
    
    return $_resultado;
}

include 'views/templates/header.php';
include 'views/formulario.simon.view.php';
include 'views/templates/footer.php';