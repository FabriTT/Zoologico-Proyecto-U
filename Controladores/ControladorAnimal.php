<?php
include_once '../Modelos/Conexion.php';
include_once '../Modelos/Animal.php';

$animal = new Animal();
    
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

switch($accion){

    case 'btnGuardar':
        $animal->setNombre((isset($_POST['animal']))?$_POST['animal']:"");
        $animal->setNombreC((isset($_POST['nombreC']))?$_POST['nombreC']:"");
        $animal->setEspecie((isset($_POST['especie']))?$_POST['especie']:"");
        $animal->setApodo((isset($_POST['apodo']))?$_POST['apodo']:"");
        $animal->setHabitat((isset($_POST['habitat']))?$_POST['habitat']:"");
        $animal->setClasificacion((isset($_POST['clasificacion']))?$_POST['clasificacion']:"");
        $animal->setTipoAlimentacion((isset($_POST['alimentacion']))?$_POST['alimentacion']:"");
        $animal->setFechaNacimiento((isset($_POST['nacimiento']))?$_POST['nacimiento']:"");
        $animal->setImagen((isset($_POST['imagen']))?$_POST['imagen']:"");
        echo AgregarAnimal($animal);

    break;
    case 'btnModificar':
        $animal->setId((isset($_POST['id']))?$_POST['id']:"");
        $animal->setNombre((isset($_POST['animal']))?$_POST['animal']:"");
        $animal->setNombreC((isset($_POST['nombreC']))?$_POST['nombreC']:"");
        $animal->setEspecie((isset($_POST['especie']))?$_POST['especie']:"");
        $animal->setApodo((isset($_POST['apodo']))?$_POST['apodo']:"");
        $animal->setHabitat((isset($_POST['habitat']))?$_POST['habitat']:"");
        $animal->setClasificacion((isset($_POST['clasificacion']))?$_POST['clasificacion']:"");
        $animal->setTipoAlimentacion((isset($_POST['alimentacion']))?$_POST['alimentacion']:"");
        $animal->setFechaNacimiento((isset($_POST['nacimiento']))?$_POST['nacimiento']:"");
        echo ModificarAnimal($animal);
    break;
    case 'btnModificarImg':
        $animal->setId((isset($_POST['id']))?$_POST['id']:"");
        $animal->setNombre((isset($_POST['animal']))?$_POST['animal']:"");
        $animal->setNombreC((isset($_POST['nombreC']))?$_POST['nombreC']:"");
        $animal->setEspecie((isset($_POST['especie']))?$_POST['especie']:"");
        $animal->setApodo((isset($_POST['apodo']))?$_POST['apodo']:"");
        $animal->setHabitat((isset($_POST['habitat']))?$_POST['habitat']:"");
        $animal->setClasificacion((isset($_POST['clasificacion']))?$_POST['clasificacion']:"");
        $animal->setTipoAlimentacion((isset($_POST['alimentacion']))?$_POST['alimentacion']:"");
        $animal->setFechaNacimiento((isset($_POST['nacimiento']))?$_POST['nacimiento']:"");
        $animal->setImagen((isset($_POST['imagen']))?$_POST['imagen']:"");
        echo ModificarAnimalImg($animal);
    break;
    case 'btnEliminar':

        $animal->setId((isset($_POST['id']))?$_POST['id']:"");
        echo EliminarAnimal($animal);
    break;
    case 'btnReactivar':

        $animal->setId((isset($_POST['id']))?$_POST['id']:"");
        echo ReactivarAnimal($animal);
    break;

}


function TodosAnimal(){
    $conexion = new Conexion();
    $sql="SELECT * FROM ani_hab WHERE ani_estado=1 ORDER BY 1";
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return $resultado;

}


function ContarAnimal($estado){
    $conexion = new Conexion();
    $sql="SELECT * FROM ani_hab WHERE ani_estado=".$estado." ORDER BY 1";
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return count($resultado);

}

function ContarAnimalB($buscar,$estado){
    $conexion = new Conexion();
    $sql="SELECT * FROM ani_hab WHERE  ani_apodo like ('%".$buscar."%') and ani_estado=".$estado." ORDER BY 1";
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return count($resultado);

}


function MostrarAnimal($inicio,$fin,$estado){
    $conexion = new Conexion();
    $sql="SELECT * FROM ani_hab WHERE ani_estado= ".$estado." ORDER BY 1"." LIMIT ".$inicio.",".$fin;
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return $resultado;

}

function BuscarAnimal($buscar,$inicio,$fin,$estado){
    $conexion = new Conexion();
    $sql="SELECT * FROM ani_hab WHERE  ani_apodo like ('%".$buscar."%') and ani_estado=".$estado." ORDER BY 1"." LIMIT ".$inicio.",".$fin;
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return $resultado;

}


function AgregarAnimal(Animal $ani){
    $conexion = new Conexion();
    $ani->setEstado(1);
    try {
        $sql="INSERT INTO $"."animales (ani_nombre,ani_nombreC,ani_especie,ani_apodo,hab_id,ani_clasificacionVertebral,ani_tipoAlimentacion,ani_fechaNacimiento,ani_imagen,ani_estado) VALUES ('".$ani->getNombre()."','".$ani->getNombreC()."','".$ani->getEspecie()."','".$ani->getApodo()."',".$ani->getHabitat().",'".$ani->getClasificacion()."','".$ani->getTipoAlimentacion()."','".$ani->getFechaNacimiento()."','".$ani->getImagen()."',".$ani->getEstado().")";

        $sentencia = $conexion->conect->prepare($sql);


        $sentencia->execute();
        return 1;
        
    } catch (Exception $e) {
        return 'error al guardar en la base de datos'.$e."---".$sql;
    }
    
}

function ModificarAnimal(Animal $ani){
    $conexion = new Conexion();
    try {
        $sql="UPDATE $"."animales SET ani_nombre='".$ani->getNombre()."',ani_nombreC='".$ani->getEspecie()."',ani_apodo='".$ani->getApodo()."',hab_id=".$ani->getHabitat().",ani_clasificacionVertebral='".$ani->getClasificacion()."',ani_tipoAlimentacion='".$ani->getTipoAlimentacion(). "',ani_fechaNacimiento='".$ani->getFechaNacimiento(). "' WHERE ani_id = ".$ani->getId();

        $sentencia = $conexion->conect->prepare($sql);


        $sentencia->execute();
        return 1;
        
    } catch (Exception $e) {
        return 'error al guardar en la base de datos'.$e."//////".$sql;
    }
}

function ModificarAnimalImg(Animal $ani){
    $conexion = new Conexion();
    try {
        $sql="UPDATE $"."animales SET ani_nombre='".$ani->getNombre()."',ani_nombreC='".$ani->getEspecie()."',ani_apodo='".$ani->getApodo()."',hab_id=".$ani->getHabitat().",ani_clasificacionVertebral='".$ani->getClasificacion()."',ani_tipoAlimentacion='".$ani->getTipoAlimentacion(). "',ani_fechaNacimiento='".$ani->getFechaNacimiento()."',ani_imagen='".$ani->getImagen(). "' WHERE ani_id = ".$ani->getId();

        $sentencia = $conexion->conect->prepare($sql);


        $sentencia->execute();
        return 1;
        
    } catch (Exception $e) {
        return 'error al guardar en la base de datos'.$e."//////".$sql;
    }
}


function EliminarAnimal(Animal $ani){
    $conexion = new Conexion();
    $ani->setEstado(0);
    try {
        $sql="UPDATE $"."animales SET ani_estado = ".$ani->getEstado()." WHERE ani_id = ".$ani->getId();

        $sentencia = $conexion->conect->prepare($sql);


        $sentencia->execute();
        return 1;
        
    } catch (Exception $e) {
        return 'error al guardar en la base de datos'.$e;
    }
}


function ReactivarAnimal(Animal $ani){
    $conexion = new Conexion();
    $ani->setEstado(1);
    try {
        $sql="UPDATE $"."animales SET ani_estado = ".$ani->getEstado()." WHERE ani_id = ".$ani->getId();

        $sentencia = $conexion->conect->prepare($sql);


        $sentencia->execute();
        return 1;
        
    } catch (Exception $e) {
        return 'error al guardar en la base de datos'.$e;
    }
}


function ContarAuditoriaAnimal(){
    $conexion = new Conexion();
    $sql="SELECT * FROM audi_ani_hab";
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return count($resultado);

}

function ContarAuditoriaAnimalB($buscar){
    $conexion = new Conexion();
    $sql="SELECT * FROM audi_ani_hab WHERE  audi_ani_apodo like ('%".$buscar."%') ";
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return count($resultado);

}


function MostrarAuditoriaAnimal($inicio,$fin){
    $conexion = new Conexion();
    $sql="SELECT * FROM audi_ani_hab LIMIT ".$inicio.",".$fin;
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return $resultado;

}

function TodosAuditoriaAnimal(){
    $conexion = new Conexion();
    $sql="SELECT * FROM audi_ani_hab";
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return $resultado;

}



function BuscarAuditoriaAnimal($buscar,$inicio,$fin){
    $conexion = new Conexion();
    $sql="SELECT * FROM audi_ani_hab WHERE  audi_ani_apodo like ('%".$buscar."%') LIMIT ".$inicio.",".$fin;
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return $resultado;

}


function HabitatAnimal($id){
    $conexion = new Conexion();
    $sql="SELECT * FROM ani_hab WHERE hab_id=".$id." ORDER BY 1 ";
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return $resultado;

}

function Animal($id){
    $conexion = new Conexion();
    $sql="SELECT * FROM $"."animales WHERE ani_id=".$id; 
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    foreach($resultado as $dato){
        return $dato;
    }
}

function Historiales($id){
    $conexion = new Conexion();
    $sql="SELECT * FROM hmed_detalle WHERE ani_id = ".$id." ORDER BY hmed_fecha"; 
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return $resultado;
}

?>
