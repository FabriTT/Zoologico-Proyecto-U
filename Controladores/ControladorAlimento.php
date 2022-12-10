<?php
include_once '../Modelos/Conexion.php';
include_once '../Modelos/Alimento.php';

$alimento = new Alimento();
    
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

switch($accion){

    case 'btnGuardar':
        $alimento->setNombre((isset($_POST['alimento']))?$_POST['alimento']:"");
        $alimento->setEmpaque((isset($_POST['empaque']))?$_POST['empaque']:"");
        $alimento->setClasificacion((isset($_POST['clasificacion']))?$_POST['clasificacion']:"");
        $alimento->setStock((isset($_POST['stock']))?$_POST['stock']:"");
        $alimento->setConsumoMensual((isset($_POST['consumo']))?$_POST['consumo']:"");
        $alimento->setCostoPedido((isset($_POST['pedido']))?$_POST['pedido']:"");
        $alimento->setCostoMantenimiento((isset($_POST['mantenimiento']))?$_POST['mantenimiento']:"");
        $alimento->setEntregaDias((isset($_POST['entrega']))?$_POST['entrega']:"");
        $alimento->setFechaVencimiento((isset($_POST['vencimiento']))?$_POST['vencimiento']:"");
        echo AgregarAlimento($alimento);

    break;
    case 'btnModificar':
        $alimento->setId((isset($_POST['id']))?$_POST['id']:"");
        $alimento->setNombre((isset($_POST['alimento']))?$_POST['alimento']:"");
        $alimento->setEmpaque((isset($_POST['empaque']))?$_POST['empaque']:"");
        $alimento->setClasificacion((isset($_POST['clasificacion']))?$_POST['clasificacion']:"");
        $alimento->setStock((isset($_POST['stock']))?$_POST['stock']:"");
        $alimento->setConsumoMensual((isset($_POST['consumo']))?$_POST['consumo']:"");
        $alimento->setCostoPedido((isset($_POST['pedido']))?$_POST['pedido']:"");
        $alimento->setCostoMantenimiento((isset($_POST['mantenimiento']))?$_POST['mantenimiento']:"");
        $alimento->setEntregaDias((isset($_POST['entrega']))?$_POST['entrega']:"");
        $alimento->setFechaVencimiento((isset($_POST['vencimiento']))?$_POST['vencimiento']:"");

        echo ModificarAlimento($alimento);
    break;
    case 'btnEliminar':

        $alimento->setId((isset($_POST['id']))?$_POST['id']:"");
        echo EliminarAlimento($alimento);
    break;
    case 'btnReactivar':

        $alimento->setId((isset($_POST['id']))?$_POST['id']:"");
        echo ReactivarAlimento($alimento);
    break;

}


function TodosAlimentos(){
    $conexion = new Conexion();
    $sql="SELECT * FROM ali_paq WHERE ali_estado=1";
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return $resultado;

}


function ContarAlimento($estado){
    $conexion = new Conexion();
    $sql="SELECT * FROM ali_paq WHERE ali_estado=".$estado." ORDER BY 1";
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return count($resultado);

}

function ContarAlimentoB($buscar,$estado){
    $conexion = new Conexion();
    $sql="SELECT * FROM ali_paq WHERE  ali_nombre like ('%".$buscar."%') and ali_estado=".$estado." ORDER BY 1";
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return count($resultado);

}


function MostrarAlimento($inicio,$fin,$estado){
    $conexion = new Conexion();
    $sql="SELECT * FROM ali_paq WHERE ali_estado= ".$estado." ORDER BY 1"." LIMIT ".$inicio.",".$fin;
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return $resultado;

}

function BuscarAlimento($buscar,$inicio,$fin,$estado){
    $conexion = new Conexion();
    $sql="SELECT * FROM ali_paq WHERE  ali_nombre like ('%".$buscar."%') and ali_estado=".$estado." ORDER BY 1"." LIMIT ".$inicio.",".$fin;
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return $resultado;

}

function MostrarEmpaques(){
    $conexion = new Conexion();
    $sql="SELECT * FROM £paquetes_alimentos";
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return $resultado;

}


function AgregarAlimento(Alimento $ali){
    $conexion = new Conexion();
    $ali->setEstado(1);
    try {
        $sql="INSERT INTO $"."alimentos (ali_nombre,PaqA_id,ali_clasificacionA,ali_stock,ali_consumoMensual,ali_costoPedido,ali_costoMantenimiento,ali_entregaDias,ali_fechaVencimiento,ali_estado) VALUES ('".$ali->getNombre()."',".$ali->getEmpaque().",'".$ali->getClasificacion()."',".$ali->getStock().",".$ali->getConsumoMensual().",".$ali->getCostoPedido().",".$ali->getCostoMantenimiento().",".$ali->getEntregaDias().",'".$ali->getFechaVencimiento()."',".$ali->getEstado().")";

        $sentencia = $conexion->conect->prepare($sql);


        $sentencia->execute();
        return 1;
        
    } catch (Exception $e) {
        return 'error al guardar en la base de datos'.$e."---".$sql;
    }
    
}

function ModificarAlimento(Alimento $ali){
    $conexion = new Conexion();
    try {
        $sql="UPDATE $"."alimentos SET ali_nombre='".$ali->getNombre()."',PaqA_id=".$ali->getEmpaque().",ali_clasificacionA='".$ali->getClasificacion()."',ali_stock=".$ali->getStock().",ali_consumoMensual=".$ali->getConsumoMensual().",ali_costoPedido=".$ali->getCostoPedido(). ",ali_costoMantenimiento=".$ali->getCostoMantenimiento().",ali_entregaDias=".$ali->getEntregaDias().",ali_fechaVencimiento='".$ali->getFechaVencimiento(). "' WHERE ali_id = ".$ali->getId();

        $sentencia = $conexion->conect->prepare($sql);


        $sentencia->execute();
        return 1;
        
    } catch (Exception $e) {
        return 'error al guardar en la base de datos'.$e."//////".$sql;
    }
}


function EliminarAlimento(Alimento $ali){
    $conexion = new Conexion();
    $ali->setEstado(0);
    try {
        $sql="UPDATE $"."alimentos SET ali_estado = ".$ali->getEstado()." WHERE ali_id = ".$ali->getId();

        $sentencia = $conexion->conect->prepare($sql);


        $sentencia->execute();
        return 1;
        
    } catch (Exception $e) {
        return 'error al guardar en la base de datos'.$e;
    }
}


function ReactivarAlimento(Alimento $ali){
    $conexion = new Conexion();
    $ali->setEstado(1);
    try {
        $sql="UPDATE $"."alimentos SET ali_estado = ".$ali->getEstado()." WHERE ali_id = ".$ali->getId();

        $sentencia = $conexion->conect->prepare($sql);


        $sentencia->execute();
        return 1;
        
    } catch (Exception $e) {
        return 'error al guardar en la base de datos'.$e;
    }
}



function ContarAuditoriaAlimento(){
    $conexion = new Conexion();
    $sql="SELECT * FROM audi_ali_paq";
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return count($resultado);

}

function ContarAuditoriaAlimentoB($buscar){
    $conexion = new Conexion();
    $sql="SELECT * FROM audi_ali_paq WHERE  audi_ali_nombre like ('%".$buscar."%') ";
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return count($resultado);

}


function MostrarAuditoriaAlimento($inicio,$fin){
    $conexion = new Conexion();
    $sql="SELECT * FROM audi_ali_paq LIMIT ".$inicio.",".$fin;
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return $resultado;

}

function TodosAuditoriaAlimento(){
    $conexion = new Conexion();
    $sql="SELECT * FROM audi_ali_paq";
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return $resultado;

}



function BuscarAuditoriaAlimento($buscar,$inicio,$fin){
    $conexion = new Conexion();
    $sql="SELECT * FROM audi_ali_paq WHERE  audi_ali_nombre like ('%".$buscar."%') LIMIT ".$inicio.",".$fin;
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return $resultado;

}


?>
