<?php
include_once '../Modelos/Conexion.php';
include_once '../Modelos/Planificacion.php';

$planificacion = new Planificacion();
    
$accion=(isset($_POST['accion']))?$_POST['accion']:"";




switch($accion){

    case 'btnGuardar':
        $planificacion->setEmpleado((isset($_POST['empleado']))?$_POST['empleado']:"");
        $planificacion->setPrecioEMenores((isset($_POST['menores']))?$_POST['menores']:"");
        $planificacion->setPrecioEMayores((isset($_POST['mayores']))?$_POST['mayores']:"");
        $planificacion->setPrecioEAdultosMayores((isset($_POST['Amayores']))?$_POST['Amayores']:"");
        $planificacion->setCantidad((isset($_POST['cantidad']))?$_POST['cantidad']:"");
        echo AgregarPlanificacion($planificacion);

    break;
    case 'btnModificar':
        $planificacion->setId((isset($_POST['id']))?$_POST['id']:"");
        $planificacion->setEmpleado((isset($_POST['empleado']))?$_POST['empleado']:"");
        $planificacion->setPrecioEMenores((isset($_POST['menores']))?$_POST['menores']:"");
        $planificacion->setPrecioEMayores((isset($_POST['mayores']))?$_POST['mayores']:"");
        $planificacion->setPrecioEAdultosMayores((isset($_POST['Amayores']))?$_POST['Amayores']:"");
        $planificacion->setCantidad((isset($_POST['cantidad']))?$_POST['cantidad']:"");
        echo ModificarPlanificacion($planificacion);
    break;
    case 'btnEliminar':

        $planificacion->setId((isset($_POST['id']))?$_POST['id']:"");
        echo EliminarPlanificacion($planificacion);
    break;
    case 'btnReactivar':

        $planificacion->setId((isset($_POST['id']))?$_POST['id']:"");
        echo ReactivarPlanificacion($planificacion);
    break;
    case 'Validar':

        $planificacion->setId((isset($_POST['id']))?$_POST['id']:"");
        echo ValidarPlanificacion($planificacion);
    break;
    case 'Grafica':

        $inicio=(isset($_POST['inicio']))?$_POST['inicio']:"";
        $fin=(isset($_POST['fin']))?$_POST['fin']:"";
        echo json_encode(Grafica($inicio,$fin));
    break;

}




function TodosPlanificacion(){
    $conexion = new Conexion();
    $sql="SELECT * FROM plan_emp WHERE plan_estado=1";
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return $resultado;

}

function ContarPlanificacion($estado){
    $conexion = new Conexion();
    $sql="SELECT * FROM plan_emp WHERE plan_estado=".$estado;
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return count($resultado);

}

function ContarPlanificacionB($buscar,$estado){
    $conexion = new Conexion();
    $sql="SELECT * FROM plan_emp WHERE plan_fecha like ('%".$buscar."%') and plan_estado=".$estado;
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return count($resultado);

}


function MostrarPlanificacion($inicio,$fin,$estado){
    $conexion = new Conexion();
    $sql="SELECT * FROM plan_emp WHERE plan_estado= ".$estado." LIMIT ".$inicio.",".$fin;
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return $resultado;

}

function BuscarPlanificacion($buscar,$inicio,$fin,$estado){
    $conexion = new Conexion();
    $sql="SELECT * FROM plan_emp WHERE  plan_fecha like ('%".$buscar."%') and plan_estado=".$estado." LIMIT ".$inicio.",".$fin;
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return $resultado;

}


function AgregarPlanificacion(Planificacion $plan){
    $conexion = new Conexion();
    $plan->setEstado(1);
    try {
        $sql="INSERT INTO $"."planificaciones_ventas (emp_id,plan_precioEMenores,plan_precioEMayores,plan_precioEAMayores,plan_cantidad,plan_fecha,plan_estado) VALUES ('".$plan->getEmpleado()."',".$plan->getPrecioEMenores().",".$plan->getPrecioEMayores().",".$plan->getPrecioEAdultosMayores().",".$plan->getCantidad().",now(),".$plan->getEstado().")";

        $sentencia = $conexion->conect->prepare($sql);


        $sentencia->execute();
        return 1;
        
    } catch (Exception $e) {
        return 'error al guardar en la base de datos'.$e;
    }
    
}

function ModificarPlanificacion(Planificacion $plan){
    $conexion = new Conexion();
    try {
        $sql="UPDATE $"."planificaciones_ventas SET emp_id=".$plan->getEmpleado().",plan_precioEMenores=".$plan->getPrecioEMenores().",plan_precioEMayores=".$plan->getPrecioEMayores().",plan_precioEAMayores=".$plan->getPrecioEAdultosMayores().",plan_cantidad=".$plan->getCantidad()." WHERE plan_id = ".$plan->getId();

        $sentencia = $conexion->conect->prepare($sql);

        $sentencia->execute();
        return 1;
        
    } catch (Exception $e) {
        return 'error al guardar en la base de datos'.$e;
    }
}


function EliminarPlanificacion(Planificacion $plan){
    $conexion = new Conexion();
    $plan->setEstado(0);
    try {
        $sql="UPDATE $"."planificaciones_ventas SET plan_estado = ".$plan->getEstado()." WHERE plan_id = ".$plan->getId();

        $sentencia = $conexion->conect->prepare($sql);


        $sentencia->execute();
        return 1;
        
    } catch (Exception $e) {
        return 'error al guardar en la base de datos'.$e;
    }
}


function ReactivarPlanificacion(Planificacion $plan){
    $conexion = new Conexion();
    $plan->setEstado(1);
    try {
        $sql="UPDATE $"."planificaciones_ventas SET plan_estado = ".$plan->getEstado()." WHERE plan_id = ".$plan->getId();

        $sentencia = $conexion->conect->prepare($sql);


        $sentencia->execute();
        return 1;
        
    } catch (Exception $e) {
        return 'error al guardar en la base de datos'.$e;
    }
}

function ContarAuditoriaPlanificacion(){
    $conexion = new Conexion();
    $sql="SELECT * FROM audi_plan_emp";
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return count($resultado);

}

function ContarAuditoriaPlanificacionB($buscar){
    $conexion = new Conexion();
    $sql="SELECT * FROM audi_plan_emp WHERE  audi_plan_fecha like ('%".$buscar."%') ";
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return count($resultado);

}


function MostrarAuditoriaPlanificacion($inicio,$fin){
    $conexion = new Conexion();
    $sql="SELECT * FROM audi_plan_emp LIMIT ".$inicio.",".$fin;
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return $resultado;

}

function TodosAuditoriaPlanificacion(){
    $conexion = new Conexion();
    $sql="SELECT * FROM audi_plan_emp";
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return $resultado;

}



function BuscarAuditoriaPlanificacion($buscar,$inicio,$fin){
    $conexion = new Conexion();
    $sql="SELECT * FROM audi_plan_emp WHERE  audi_plan_fecha like ('%".$buscar."%') LIMIT ".$inicio.",".$fin;
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return $resultado;

}

function ValidarPlanificacion(Planificacion $plan){
    $conexion = new Conexion();
    $sql="SELECT * FROM $"."registros_ventas WHERE plan_id=".$plan->getId();
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return count($resultado);

}

function Grafica($inicio,$fin){
    $conexion = new Conexion();
    $sql="SELECT * FROM totales WHERE fecha BETWEEN date_format('".$inicio."', '%Y-%m') AND date_format('".$fin."', '%Y-%m') ORDER BY 2 DESC";
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return $resultado;

}


?>


