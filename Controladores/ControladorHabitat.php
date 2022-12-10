<?php
include_once '../Modelos/Conexion.php';
include_once '../Modelos/Habitat.php';

$habitat = new Habitat();
    
$accion=(isset($_POST['accion']))?$_POST['accion']:"";




switch($accion){

    case 'btnGuardar':
        $habitat->setNombre((isset($_POST['nombre']))?$_POST['nombre']:"");
        $habitat->setNombreAnimal((isset($_POST['nombreA']))?$_POST['nombreA']:"");
        $habitat->setClasificacion((isset($_POST['clasificacion']))?$_POST['clasificacion']:"");
        $habitat->setCapacidad((isset($_POST['capacidad']))?$_POST['capacidad']:"");
        $habitat->setHorarioLimpieza((isset($_POST['limpieza']))?$_POST['limpieza']:"");
        $habitat->setHorarioAlimentacion((isset($_POST['alimentacion']))?$_POST['alimentacion']:"");
        echo AgregarHabitat($habitat);

    break;
    case 'btnModificar':
        $habitat->setId((isset($_POST['id']))?$_POST['id']:"");
        $habitat->setNombre((isset($_POST['nombre']))?$_POST['nombre']:"");
        $habitat->setNombreAnimal((isset($_POST['nombreA']))?$_POST['nombreA']:"");
        $habitat->setClasificacion((isset($_POST['clasificacion']))?$_POST['clasificacion']:"");
        $habitat->setCapacidad((isset($_POST['capacidad']))?$_POST['capacidad']:"");
        $habitat->setHorarioLimpieza((isset($_POST['limpieza']))?$_POST['limpieza']:"");
        $habitat->setHorarioAlimentacion((isset($_POST['alimentacion']))?$_POST['alimentacion']:"");
        echo ModificarHabitat($habitat);
    break;
    case 'btnEliminar':

        $habitat->setId((isset($_POST['id']))?$_POST['id']:"");
        echo EliminarHabitat($habitat);
    break;
    case 'btnReactivar':

        $habitat->setId((isset($_POST['id']))?$_POST['id']:"");
        echo ReactivarHabitat($habitat);
    break;

}




function TodosHabitat(){
    $conexion = new Conexion();
    $sql="SELECT * FROM $"."habitats WHERE hab_estado=1";
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return $resultado;

}

function ContarHabitat($estado){
    $conexion = new Conexion();
    $sql="SELECT * FROM $"."habitats WHERE hab_estado=".$estado;
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return count($resultado);

}

function ContarHabitatB($buscar,$estado){
    $conexion = new Conexion();
    $sql="SELECT * FROM $"."habitats WHERE  hab_nombre like ('%".$buscar."%') and hab_estado=".$estado;
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return count($resultado);

}


function MostrarHabitat($inicio,$fin,$estado){
    $conexion = new Conexion();
    $sql="SELECT * FROM $"."habitats WHERE hab_estado= ".$estado." LIMIT ".$inicio.",".$fin;
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return $resultado;

}

function BuscarHabitat($buscar,$inicio,$fin,$estado){
    $conexion = new Conexion();
    $sql="SELECT * FROM $"."habitats WHERE  hab_nombre like ('%".$buscar."%') and hab_estado=".$estado." LIMIT ".$inicio.",".$fin;
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return $resultado;

}


function AgregarHabitat(Habitat $hab){
    $conexion = new Conexion();
    $hab->setEstado(1);
    try {
        $sql="INSERT INTO $"."habitats (hab_nombre,hab_nombreA,hab_clasificacionAmbiente,hab_capacidad,hab_horarioLimpieza,hab_horarioAlimentacion,hab_estado) VALUES ('".$hab->getNombre()."','".$hab->getNombreAnimal()."','".$hab->getClasificacion()."',".$hab->getCapacidad().",'".$hab->getHorarioLimpieza()."','".$hab->getHorarioAlimentacion()."',".$hab->getEstado().")";

        $sentencia = $conexion->conect->prepare($sql);


        $sentencia->execute();
        return 1;
        
    } catch (Exception $e) {
        return 'error al guardar en la base de datos'.$e;
    }
    
}

function ModificarHabitat(Habitat $hab){
    $conexion = new Conexion();
    try {
        $sql="UPDATE $"."habitats SET hab_nombre='".$hab->getNombre()."',hab_nombreA='".$hab->getNombreAnimal()."',hab_clasificacionAmbiente='".$hab->getClasificacion()."',hab_capacidad=".$hab->getCapacidad().",hab_horarioLimpieza='".$hab->getHorarioLimpieza()."',hab_horarioAlimentacion='".$hab->getHorarioAlimentacion()."' WHERE hab_id = ".$hab->getId();

        $sentencia = $conexion->conect->prepare($sql);


        $sentencia->execute();
        return 1;
        
    } catch (Exception $e) {
        return 'error al guardar en la base de datos'.$e;
    }
}


function EliminarHabitat(Habitat $hab){
    $conexion = new Conexion();
    $hab->setEstado(0);
    try {
        $sql="UPDATE $"."habitats SET hab_estado = ".$hab->getEstado()." WHERE hab_id = ".$hab->getId();

        $sentencia = $conexion->conect->prepare($sql);


        $sentencia->execute();
        return 1;
        
    } catch (Exception $e) {
        return 'error al guardar en la base de datos'.$e;
    }
}


function ReactivarHabitat(Habitat $hab){
    $conexion = new Conexion();
    $hab->setEstado(1);
    try {
        $sql="UPDATE $"."habitats SET hab_estado = ".$hab->getEstado()." WHERE hab_id = ".$hab->getId();

        $sentencia = $conexion->conect->prepare($sql);


        $sentencia->execute();
        return 1;
        
    } catch (Exception $e) {
        return 'error al guardar en la base de datos'.$e;
    }
}

function ContarAuditoriaHabitat(){
    $conexion = new Conexion();
    $sql="SELECT * FROM auditoria_hab";
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return count($resultado);

}

function ContarAuditoriaHabitatB($buscar){
    $conexion = new Conexion();
    $sql="SELECT * FROM auditoria_hab WHERE  audi_hab_nombre like ('%".$buscar."%') ";
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return count($resultado);

}


function MostrarAuditoriaHabitat($inicio,$fin){
    $conexion = new Conexion();
    $sql="SELECT * FROM auditoria_hab LIMIT ".$inicio.",".$fin;
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return $resultado;

}

function TodosAuditoriaHabitat(){
    $conexion = new Conexion();
    $sql="SELECT * FROM auditoria_hab";
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return $resultado;

}



function BuscarAuditoriaHabitat($buscar,$inicio,$fin){
    $conexion = new Conexion();
    $sql="SELECT * FROM auditoria_hab WHERE  audi_hab_nombre like ('%".$buscar."%') LIMIT ".$inicio.",".$fin;
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return $resultado;

}

function Habitat($id){
    $conexion = new Conexion();
    $sql="SELECT * FROM $"."habitats WHERE hab_id=".$id; 
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    foreach($resultado as $dato){
        return $dato;
    }

}


?>


