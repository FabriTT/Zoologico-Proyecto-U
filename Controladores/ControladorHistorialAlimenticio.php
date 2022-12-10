<?php
include_once '../Modelos/Conexion.php';
include_once '../Modelos/HistorialAlimenticio.php';

$historial = new HistorialAlimenticio();
    
$accion=(isset($_POST['accion']))?$_POST['accion']:"";


switch($accion){

    case 'btnGuardar':
        $historial->setEmpleado((isset($_POST['empleado']))?$_POST['empleado']:"");
        $historial->setAnimal((isset($_POST['animal']))?$_POST['animal']:"");
        $historial->setAlimento((isset($_POST['alimento']))?$_POST['alimento']:"");
        $historial->setCantidad((isset($_POST['cantidad']))?$_POST['cantidad']:"");
        $historial->setFecha((isset($_POST['fecha']))?$_POST['fecha']:"");
        echo AgregarHistorial($historial);

    break;
    case 'btnModificar':
        $historial->setId((isset($_POST['id']))?$_POST['id']:"");
        $historial->setEmpleado((isset($_POST['empleado']))?$_POST['empleado']:"");
        $historial->setAnimal((isset($_POST['animal']))?$_POST['animal']:"");
        $historial->setAlimento((isset($_POST['alimento']))?$_POST['alimento']:"");
        $historial->setCantidad((isset($_POST['cantidad']))?$_POST['cantidad']:"");
        $historial->setFecha((isset($_POST['fecha']))?$_POST['fecha']:"");
        echo ModificarHistorial($historial);
    break;
    case 'btnEliminar':

        $historial->setId((isset($_POST['id']))?$_POST['id']:"");
        $historial->setAlimento((isset($_POST['alimento']))?$_POST['alimento']:"");
        echo EliminarHistorial($historial);
    break;
    case 'btnReactivar':

        $historial->setId((isset($_POST['id']))?$_POST['id']:"");
        echo ReactivarHistorial($historial);
    break;
    case 'Validar':

        $historial->setAlimento((isset($_POST['alimento']))?$_POST['alimento']:"");
        echo json_encode(ValidarStock($historial));
    break;

}


function TodosHistorialesAlimenticios(){
    $conexion = new Conexion();
    $sql="SELECT * FROM hali_detalle WHERE hali_estado=1";
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return $resultado;

}


function ContarHistorialesAlimenticios($estado){
    $conexion = new Conexion();
    $sql="SELECT * FROM hali_detalle WHERE hali_estado=".$estado." ORDER BY 1";
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return count($resultado);

}

function ContarHistorialesAlimenticiosB($buscar,$estado){
    $conexion = new Conexion();
    $sql="SELECT * FROM hali_detalle WHERE  ani_apodo like ('%".$buscar."%') and hali_estado=".$estado." ORDER BY 1";
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return count($resultado);

}


function MostrarHistorialesAlimenticios($inicio,$fin,$estado){
    $conexion = new Conexion();
    $sql="SELECT * FROM hali_detalle WHERE hali_estado= ".$estado." ORDER BY 1"." LIMIT ".$inicio.",".$fin;
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return $resultado;

}

function BuscarHistorialesAlimenticios($buscar,$inicio,$fin,$estado){
    $conexion = new Conexion();
    $sql="SELECT * FROM hali_detalle WHERE  ani_apodo like ('%".$buscar."%') and hali_estado=".$estado." ORDER BY 1"." LIMIT ".$inicio.",".$fin;
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return $resultado;

}


function ValidarStock(HistorialAlimenticio $histo){
    $conexion = new Conexion();
    $sql="SELECT ali_stock,ali_nombre FROM $"."alimentos WHERE  ali_id=".$histo->getAlimento();
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    foreach($resultado as $dato){
        return $dato;
    }


}



function AgregarHistorial(HistorialAlimenticio $histo){
    $conexion = new Conexion();
    $histo->setEstado(1);
    try {
        $sql="CALL agregar_hali(?,?,?,?,?)";

        $sentencia = $conexion->conect->prepare($sql);


        $sentencia->execute(array($histo->getAnimal(),$histo->getEmpleado(),$histo->getAlimento(),$histo->getCantidad(),$histo->getFecha()));
        return 1;
        
    } catch (Exception $e) {
        return 'error al guardar en la base de datos'.$e."---".$sql;
    }
    
}

function ModificarHistorial(HistorialAlimenticio $histo){
    $conexion = new Conexion();
    try {
        $sql="CALL modificar_hali(?,?,?,?,?,?)";

        $sentencia = $conexion->conect->prepare($sql);


        $sentencia->execute(array($histo->getId(),$histo->getAnimal(),$histo->getEmpleado(),$histo->getAlimento(),$histo->getCantidad(),$histo->getFecha()));
        return 1;
        
    } catch (Exception $e) {
        return 'error al guardar en la base de datos'.$e."---".$sql;
    }
}


function EliminarHistorial(HistorialAlimenticio $histo){
    $conexion = new Conexion();
    try {
        $sql="CALL eliminar_hali(?,?)";

        $sentencia = $conexion->conect->prepare($sql);


        $sentencia->execute(array($histo->getId(),$histo->getAlimento()));
        return 1;
        
    } catch (Exception $e) {
        return 'error al guardar en la base de datos'.$e."---".$sql;
    }
}


function ReactivarHistorial(HistorialAlimenticio $histo){
    $conexion = new Conexion();
    $histo->setEstado(1);
    try {
        $sql="UPDATE $"."historiales_alimenticios SET hali_estado = ".$histo->getEstado()." WHERE hali_id = ".$histo->getId();

        $sentencia = $conexion->conect->prepare($sql);


        $sentencia->execute();
        return 1;
        
    } catch (Exception $e) {
        return 'error al guardar en la base de datos'.$e;
    }
}


function ContarAuditoriaHistorialAlimenticio(){
    $conexion = new Conexion();
    $sql="SELECT * FROM audi_hali_detalle";
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return count($resultado);

}

function ContarAuditoriaHistorialAlimenticioB($buscar){
    $conexion = new Conexion();
    $sql="SELECT * FROM audi_hali_detalle WHERE  ani_apodo like ('%".$buscar."%') ";
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return count($resultado);

}


function MostrarAuditoriaHistorialAlimenticio($inicio,$fin){
    $conexion = new Conexion();
    $sql="SELECT * FROM audi_hali_detalle LIMIT ".$inicio.",".$fin;
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return $resultado;

}

function TodosAuditoriaHistorialAlimenticio(){
    $conexion = new Conexion();
    $sql="SELECT * FROM audi_hali_detalle";
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return $resultado;

}



function BuscarAuditoriaHistorialAlimenticio($buscar,$inicio,$fin){
    $conexion = new Conexion();
    $sql="SELECT * FROM audi_hali_detalle WHERE  ani_apodo like ('%".$buscar."%') LIMIT ".$inicio.",".$fin;
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return $resultado;

}

?>