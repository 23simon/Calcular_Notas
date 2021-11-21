<?php
define('S_POST', 'sanitized_post');
$data['titulo'] = "Plantilla formulario";
$data["div_titulo"] = "Formulario";

$_customJs = array("vendor/summernote/summernote-bs4.min.js", "assets/pages/js/formulario.view.js");

//Comprobamos si se ha enviado el formulario y si es así, lo procesamos
if(isset($_POST['submit'])){
    $array = json_decode($_POST['textarea']);
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
    $_resultado=arrayFinal($resultado);
    $data['resultado']=creacionTabla($_resultado);
    $arrayAux=(promos($resultado));
    $data['todoAp']=$arrayAux["todoAp"];
    $data['suspensos']=$arrayAux["suspensos"];
    $data['promo']=$arrayAux["promo"];
    $data['noPromo']=$arrayAux["noPromo"];
}

function arrayFinal($resultado){
    $_resultado=array();
    foreach ($resultado as $materia => $alumnos){
        $media=0;
        $suspenso=0;
        $aprobado=0;
        $contador=0;
        $alumnoMin="";
        $minima=10;
        $alumnoMax="";
        $maxima=0;
        
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

function creacionTabla($resultado) {
    $tabla="<tr><th></th>";
    foreach ($resultado as $materia => $alumnos){
        foreach ($resultado[$materia] as $aux => $rando){
                $tabla.="<th>".$aux."</th>";
        }
        break;
    }
    $tabla.="</tr>";
    foreach ($resultado as $materia => $alumnos) {
        $tabla.="<tr><td>".$materia."</td>";
        
         foreach ($resultado[$materia] as $aux => $rando){
             
             if($aux=="min" || $aux=="max"){
                 $tabla.="<td>".$resultado[$materia][$aux]['alumno'] . " : " . $resultado[$materia][$aux]['nota'] ."</td>";
             }else{
                $tabla.="<td>".$rando."</td>";
             }
        }
        
        $tabla.="</tr>";
    }
    return $tabla;
}

function promos($resultado){
    
    foreach ($resultado as $materia => $value){
        foreach ($resultado[$materia] as $key => $nota) {
            $guardadoAlumnos[$key]=[];
        }
    }
    
    foreach ($resultado as $materia => $value) {
        foreach ($resultado[$materia] as $key => $nota) {
            
            if($nota<5){
                array_push($guardadoAlumnos[$key] , 1);
            }
        }
    }
    
    $todoAp="";
    $suspensos="";
    $promo="";
    $noPromo="";
    
    foreach ($guardadoAlumnos as $key => $value) {
        if(count($guardadoAlumnos[$key])<1){
            $todoAp.="[" .$key. "]";
        }elseif(count($guardadoAlumnos[$key])>0){
            $suspensos.="[" .$key. "]";
        }
        if(count($guardadoAlumnos[$key])<2){
            $promo.="[" .$key. "]";
        }elseif(count($guardadoAlumnos[$key])>1){
            $noPromo.="[" .$key . "]";
        }
    }
    $arrayAux["todoAp"]=$todoAp;
    $arrayAux["suspensos"]=$suspensos;
    $arrayAux["promo"]=$promo;
    $arrayAux["noPromo"]=$noPromo;
    return $arrayAux;
    
}

include 'views/templates/header.php';
include 'views/formulario.simon.view.php';
include 'views/templates/footer.php';