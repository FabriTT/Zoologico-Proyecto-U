<?php
include_once '../Modelos/Conexion.php';
include_once '../Modelos/Venta.php';

$venta = new Venta();

    
$accion=(isset($_POST['accion']))?$_POST['accion']:"";




switch($accion){

    case 'Insertar':
        $venta->setPlanificacion((isset($_POST['plan']))?$_POST['plan']:"");
        echo AgregarVenta($venta);

    break;
    case 'Rmenor':
        $venta->setId((isset($_POST['venta']))?$_POST['venta']:"");
        echo ModificarRMenor($venta);
    break;
    case 'Smenor':
        $venta->setId((isset($_POST['venta']))?$_POST['venta']:"");
        echo ModificarSMenor($venta);
    break;
    case 'Rmayor':
        $venta->setId((isset($_POST['venta']))?$_POST['venta']:"");
        echo ModificarRMayor($venta);
    break;
    case 'Smayor':
        $venta->setId((isset($_POST['venta']))?$_POST['venta']:"");
        echo ModificarSMayor($venta);
    break;
    case 'RAmayor':
        $venta->setId((isset($_POST['venta']))?$_POST['venta']:"");
        echo ModificarRAMayor($venta);
    break;
    case 'SAmayor':
        $venta->setId((isset($_POST['venta']))?$_POST['venta']:"");
        echo ModificarSAMayor($venta);
    break;



}



function ContarVenta($id){
    $conexion = new Conexion();
    $sql="SELECT * FROM ven_reg_detalle WHERE plan_id=".$id;
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return count($resultado);

}

function ContarVentaB($buscar,$id){
    $conexion = new Conexion();
    $sql="SELECT * FROM ven_reg_detalle WHERE reg_fecha like ('%".$buscar."%') and plan_id=".$id;
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return count($resultado);

}


function MostrarVenta($inicio,$fin,$id){
    $conexion = new Conexion();
    $sql="SELECT * FROM ven_reg_detalle WHERE plan_id= ".$id." LIMIT ".$inicio.",".$fin;
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return $resultado;

}

function BuscarVenta($buscar,$inicio,$fin,$id){
    $conexion = new Conexion();
    $sql="SELECT * FROM ven_reg_detalle WHERE  reg_fecha like ('%".$buscar."%') and plan_id=".$id." LIMIT ".$inicio.",".$fin;
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return $resultado;

}


function AgregarVenta(Venta $ven){
    $conexion = new Conexion();
    try {
        $sql="INSERT INTO $"."registros_ventas (plan_id,reg_cantidad_EMenores,reg_cantidad_EMayores,reg_cantidad_EAMayores,reg_fecha) VALUES (".$ven->getPlanificacion().",0,0,0,now())";

        $sentencia = $conexion->conect->prepare($sql);


        $sentencia->execute();
        return 1;
        
    } catch (Exception $e) {
        return 'error al guardar en la base de datos'.$e;
    }
    
}


function ModificarRmenor(Venta $ven){
    $conexion = new Conexion();
    try {
        $sql="UPDATE $"."registros_ventas SET reg_cantidad_EMenores=(reg_cantidad_EMenores-1) WHERE reg_id = ".$ven->getId();

        $sentencia = $conexion->conect->prepare($sql);

        $sentencia->execute();
        return 1;
        
    } catch (Exception $e) {
        return 'error al guardar en la base de datos'.$e;
    }
}

function ModificarSmenor(Venta $ven){
    $conexion = new Conexion();
    try {
        $sql="UPDATE $"."registros_ventas SET reg_cantidad_EMenores=(reg_cantidad_EMenores+1) WHERE reg_id = ".$ven->getId();

        $sentencia = $conexion->conect->prepare($sql);

        $sentencia->execute();
        return 1;
        
    } catch (Exception $e) {
        return 'error al guardar en la base de datos'.$e;
    }
}


function ModificarRmayor(Venta $ven){
    $conexion = new Conexion();
    try {
        $sql="UPDATE $"."registros_ventas SET reg_cantidad_EMayores=(reg_cantidad_EMayores-1) WHERE reg_id = ".$ven->getId();

        $sentencia = $conexion->conect->prepare($sql);

        $sentencia->execute();
        return 1;
        
    } catch (Exception $e) {
        return 'error al guardar en la base de datos'.$e;
    }
}

function ModificarSmayor(Venta $ven){
    $conexion = new Conexion();
    try {
        $sql="UPDATE $"."registros_ventas SET reg_cantidad_EMayores=(reg_cantidad_EMayores+1) WHERE reg_id = ".$ven->getId();

        $sentencia = $conexion->conect->prepare($sql);

        $sentencia->execute();
        return 1;
        
    } catch (Exception $e) {
        return 'error al guardar en la base de datos'.$e;
    }
}

function ModificarRAmayor(Venta $ven){
    $conexion = new Conexion();
    try {
        $sql="UPDATE $"."registros_ventas SET reg_cantidad_EAMayores=(reg_cantidad_EAMayores-1) WHERE reg_id = ".$ven->getId();

        $sentencia = $conexion->conect->prepare($sql);

        $sentencia->execute();
        return 1;
        
    } catch (Exception $e) {
        return 'error al guardar en la base de datos'.$e;
    }
}

function ModificarSAmayor(Venta $ven){
    $conexion = new Conexion();
    try {
        $sql="UPDATE $"."registros_ventas SET reg_cantidad_EAMayores=(reg_cantidad_EAMayores+1) WHERE reg_id = ".$ven->getId();

        $sentencia = $conexion->conect->prepare($sql);

        $sentencia->execute();
        return 1;
        
    } catch (Exception $e) {
        return 'error al guardar en la base de datos'.$e;
    }
}




?>


