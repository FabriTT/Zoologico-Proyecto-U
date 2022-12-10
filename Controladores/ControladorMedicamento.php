<?php
include_once '../Modelos/Conexion.php';
include_once '../Modelos/Medicamento.php';

$medicamento = new Medicamento();
    
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

switch($accion){

    case 'btnGuardar':
        $medicamento->setNombre((isset($_POST['medicamento']))?$_POST['medicamento']:"");
        $medicamento->setEmpaque((isset($_POST['empaque']))?$_POST['empaque']:"");
        $medicamento->setTipoAdministracion((isset($_POST['administracion']))?$_POST['administracion']:"");
        $medicamento->setStock((isset($_POST['stock']))?$_POST['stock']:"");
        $medicamento->setFechaVencimiento((isset($_POST['vencimiento']))?$_POST['vencimiento']:"");
        echo AgregarMedicamento($medicamento);

    break;
    case 'btnModificar':
        $medicamento->setId((isset($_POST['id']))?$_POST['id']:"");
        $medicamento->setNombre((isset($_POST['medicamento']))?$_POST['medicamento']:"");
        $medicamento->setEmpaque((isset($_POST['empaque']))?$_POST['empaque']:"");
        $medicamento->setTipoAdministracion((isset($_POST['administracion']))?$_POST['administracion']:"");
        $medicamento->setStock((isset($_POST['stock']))?$_POST['stock']:"");
        $medicamento->setFechaVencimiento((isset($_POST['vencimiento']))?$_POST['vencimiento']:"");
        echo ModificarMedicamento($medicamento);
    break;
    case 'btnEliminar':

        $medicamento->setId((isset($_POST['id']))?$_POST['id']:"");
        echo EliminarMedicamento($medicamento);
    break;
    case 'btnReactivar':

        $medicamento->setId((isset($_POST['id']))?$_POST['id']:"");
        echo ReactivarMedicamento($medicamento);
    break;

}


function TodosMedicamentos(){
    $conexion = new Conexion();
    $sql="SELECT * FROM med_paq WHERE med_estado=1";
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return $resultado;

}


function ContarMedicamento($estado){
    $conexion = new Conexion();
    $sql="SELECT * FROM med_paq WHERE med_estado=".$estado." ORDER BY 1";
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return count($resultado);

}

function ContarMedicamentoB($buscar,$estado){
    $conexion = new Conexion();
    $sql="SELECT * FROM med_paq WHERE  med_nombre like ('%".$buscar."%') and med_estado=".$estado." ORDER BY 1";
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return count($resultado);

}


function MostrarMedicamentos($inicio,$fin,$estado){
    $conexion = new Conexion();
    $sql="SELECT * FROM med_paq WHERE med_estado= ".$estado." ORDER BY 1"." LIMIT ".$inicio.",".$fin;
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return $resultado;

}

function BuscarMedicamentos($buscar,$inicio,$fin,$estado){
    $conexion = new Conexion();
    $sql="SELECT * FROM med_paq WHERE  med_nombre like ('%".$buscar."%') and med_estado=".$estado." ORDER BY 1"." LIMIT ".$inicio.",".$fin;
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return $resultado;

}

function MostrarEmpaques(){
    $conexion = new Conexion();
    $sql="SELECT * FROM £paquetes_medicamentos";
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return $resultado;

}


function AgregarMedicamento(Medicamento $med){
    $conexion = new Conexion();
    $med->setEstado(1);
    try {
        $sql="INSERT INTO $"."medicamentos (med_nombre,PaqM_id,med_tipoAdministracion,med_stock,med_fechaVencimiento,med_estado) VALUES ('".$med->getNombre()."',".$med->getEmpaque().",'".$med->getTipoAdministracion()."',".$med->getStock().",'".$med->getFechaVencimiento()."',".$med->getEstado().")";

        $sentencia = $conexion->conect->prepare($sql);


        $sentencia->execute();
        return 1;
        
    } catch (Exception $e) {
        return 'error al guardar en la base de datos'.$e."---".$sql;
    }
    
}

function ModificarMedicamento(Medicamento $med){
    $conexion = new Conexion();
    try {
        $sql="UPDATE $"."medicamentos SET med_nombre='".$med->getNombre()."',PaqM_id=".$med->getEmpaque().",med_tipoAdministracion='".$med->getTipoAdministracion()."',med_stock=".$med->getStock().",med_fechaVencimiento='".$med->getFechaVencimiento(). "' WHERE med_id = ".$med->getId();

        $sentencia = $conexion->conect->prepare($sql);


        $sentencia->execute();
        return 1;
        
    } catch (Exception $e) {
        return 'error al guardar en la base de datos'.$e."//////".$sql;
    }
}


function EliminarMedicamento(Medicamento $med){
    $conexion = new Conexion();
    $med->setEstado(0);
    try {
        $sql="UPDATE $"."medicamentos SET med_estado = ".$med->getEstado()." WHERE med_id = ".$med->getId();

        $sentencia = $conexion->conect->prepare($sql);


        $sentencia->execute();
        return 1;
        
    } catch (Exception $e) {
        return 'error al guardar en la base de datos'.$e;
    }
}


function ReactivarMedicamento(Medicamento $med){
    $conexion = new Conexion();
    $med->setEstado(1);
    try {
        $sql="UPDATE $"."medicamentos SET med_estado = ".$med->getEstado()." WHERE med_id = ".$med->getId();

        $sentencia = $conexion->conect->prepare($sql);


        $sentencia->execute();
        return 1;
        
    } catch (Exception $e) {
        return 'error al guardar en la base de datos'.$e;
    }
}

function ContarAuditoriaMedicamento(){
    $conexion = new Conexion();
    $sql="SELECT * FROM audi_med_paq";
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return count($resultado);

}

function ContarAuditoriaMedicamentoB($buscar){
    $conexion = new Conexion();
    $sql="SELECT * FROM audi_med_paq WHERE  audi_med_nombre like ('%".$buscar."%') ";
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return count($resultado);

}


function MostrarAuditoriaMedicamento($inicio,$fin){
    $conexion = new Conexion();
    $sql="SELECT * FROM audi_med_paq LIMIT ".$inicio.",".$fin;
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return $resultado;

}

function TodosAuditoriaMedicamento(){
    $conexion = new Conexion();
    $sql="SELECT * FROM audi_med_paq";
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return $resultado;

}



function BuscarAuditoriaMedicamento($buscar,$inicio,$fin){
    $conexion = new Conexion();
    $sql="SELECT * FROM audi_med_paq WHERE  audi_med_nombre like ('%".$buscar."%') LIMIT ".$inicio.",".$fin;
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return $resultado;

}



?>