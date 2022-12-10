<?php
include_once '../Modelos/Conexion.php';
include_once '../Modelos/HistorialMedico.php';

$historial = new HistorialMedico();
    
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

switch($accion){

    case 'btnGuardar':
        $historial->setEmpleado((isset($_POST['empleado']))?$_POST['empleado']:"");
        $historial->setAnimal((isset($_POST['animal']))?$_POST['animal']:"");
        $historial->setMedicamento((isset($_POST['medicamento']))?$_POST['medicamento']:"");
        $historial->setCantidad((isset($_POST['cantidad']))?$_POST['cantidad']:"");
        $historial->setEnfermedad((isset($_POST['enfermedad']))?$_POST['enfermedad']:"");
        $historial->setFecha((isset($_POST['fecha']))?$_POST['fecha']:"");
        echo AgregarHistorial($historial);

    break;
    case 'btnModificar':
        $historial->setId((isset($_POST['id']))?$_POST['id']:"");
        $historial->setEmpleado((isset($_POST['empleado']))?$_POST['empleado']:"");
        $historial->setAnimal((isset($_POST['animal']))?$_POST['animal']:"");
        $historial->setMedicamento((isset($_POST['medicamento']))?$_POST['medicamento']:"");
        $historial->setCantidad((isset($_POST['cantidad']))?$_POST['cantidad']:"");
        $historial->setEnfermedad((isset($_POST['enfermedad']))?$_POST['enfermedad']:"");
        $historial->setFecha((isset($_POST['fecha']))?$_POST['fecha']:"");
        echo ModificarHistorial($historial);
    break;
    case 'btnEliminar':

        $historial->setId((isset($_POST['id']))?$_POST['id']:"");
        $historial->setMedicamento((isset($_POST['medicamento']))?$_POST['medicamento']:"");
        echo EliminarHistorial($historial);
    break;
    case 'btnReactivar':

        $historial->setId((isset($_POST['id']))?$_POST['id']:"");
        echo ReactivarHistorial($historial);
    break;
    case 'btnCurar':

        $historial->setId((isset($_POST['id']))?$_POST['id']:"");
        $historial->setSituacion("CURADO");
        echo CurarHistorial($historial);
    break;
    case 'Validar':

        $historial->setMedicamento((isset($_POST['medicamento']))?$_POST['medicamento']:"");
        echo json_encode(ValidarStock($historial));
    break;

}


function TodosHistorialesMedicos(){
    $conexion = new Conexion();
    $sql="SELECT * FROM hmed_detalle WHERE hmed_estado=1";
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return $resultado;

}


function ContarHistorialesMedicos($estado){
    $conexion = new Conexion();
    $sql="SELECT * FROM hmed_detalle WHERE hmed_estado=".$estado." ORDER BY 1";
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return count($resultado);

}

function ContarHistorialesMedicosB($buscar,$estado){
    $conexion = new Conexion();
    $sql="SELECT * FROM hmed_detalle WHERE  ani_apodo like ('%".$buscar."%') and hmed_estado=".$estado." ORDER BY 1";
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return count($resultado);

}


function MostrarHistorialesMedicos($inicio,$fin,$estado){
    $conexion = new Conexion();
    $sql="SELECT * FROM hmed_detalle WHERE hmed_estado= ".$estado." ORDER BY 1"." LIMIT ".$inicio.",".$fin;
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return $resultado;

}

function BuscarHistorialesMedicos($buscar,$inicio,$fin,$estado){
    $conexion = new Conexion();
    $sql="SELECT * FROM hmed_detalle WHERE  ani_apodo like ('%".$buscar."%') and hmed_estado=".$estado." ORDER BY 1"." LIMIT ".$inicio.",".$fin;
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return $resultado;

}

function ValidarStock(HistorialMedico $histo){
    $conexion = new Conexion();
    $sql="SELECT med_stock,med_nombre FROM $"."medicamentos WHERE  med_id=".$histo->getMedicamento();
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    foreach($resultado as $dato){
        return $dato;
    }


}



function AgregarHistorial(HistorialMedico $histo){
    $conexion = new Conexion();
    $histo->setEstado(1);
    try {
        $sql="CALL agregar_hmed(?,?,?,?,?,?)";

        $sentencia = $conexion->conect->prepare($sql);


        $sentencia->execute(array($histo->getAnimal(),$histo->getEmpleado(),$histo->getMedicamento(),$histo->getCantidad(),$histo->getEnfermedad(),$histo->getFecha()));
        return 1;
        
    } catch (Exception $e) {
        return 'error al guardar en la base de datos'.$e."---".$sql;
    }
    
}

function ModificarHistorial(HistorialMedico $histo){
    $conexion = new Conexion();
    try {
        $sql="CALL modificar_hmed(?,?,?,?,?,?,?)";

        $sentencia = $conexion->conect->prepare($sql);


        $sentencia->execute(array($histo->getId(),$histo->getAnimal(),$histo->getEmpleado(),$histo->getMedicamento(),$histo->getCantidad(),$histo->getEnfermedad(),$histo->getFecha()));
        return 1;
        
    } catch (Exception $e) {
        return 'error al guardar en la base de datos'.$e."---".$sql;
    }
}


function EliminarHistorial(HistorialMedico $histo){
    $conexion = new Conexion();
    try {
        $sql="CALL eliminar_hmed(?,?)";

        $sentencia = $conexion->conect->prepare($sql);


        $sentencia->execute(array($histo->getId(),$histo->getMedicamento()));
        return 1;
        
    } catch (Exception $e) {
        return 'error al guardar en la base de datos'.$e."---".$sql;
    }
}


function ReactivarHistorial(HistorialMedico $histo){
    $conexion = new Conexion();
    $histo->setEstado(1);
    try {
        $sql="UPDATE $"."historiales_medicos SET hmed_estado = ".$histo->getEstado()." WHERE hmed_id = ".$histo->getId();

        $sentencia = $conexion->conect->prepare($sql);


        $sentencia->execute();
        return 1;
        
    } catch (Exception $e) {
        return 'error al guardar en la base de datos'.$e;
    }
}

function CurarHistorial(HistorialMedico $histo){
    $conexion = new Conexion();
    try {
        $sql="UPDATE $"."historiales_medicos SET hmed_situacion = '".$histo->getSituacion()."' WHERE hmed_id = ".$histo->getId();

        $sentencia = $conexion->conect->prepare($sql);


        $sentencia->execute();
        return 1;
        
    } catch (Exception $e) {
        return 'error al guardar en la base de datos'.$e."---".$sql;
    }
}

function ContarAuditoriaHistorialMedico(){
    $conexion = new Conexion();
    $sql="SELECT * FROM audi_hmed_detalle";
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return count($resultado);

}

function ContarAuditoriaHistorialMedicoB($buscar){
    $conexion = new Conexion();
    $sql="SELECT * FROM audi_hmed_detalle WHERE  ani_apodo like ('%".$buscar."%') ";
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return count($resultado);

}


function MostrarAuditoriaHistorialMedico($inicio,$fin){
    $conexion = new Conexion();
    $sql="SELECT * FROM audi_hmed_detalle LIMIT ".$inicio.",".$fin;
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return $resultado;

}

function TodosAuditoriaHistorialMedico(){
    $conexion = new Conexion();
    $sql="SELECT * FROM audi_hmed_detalle";
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return $resultado;

}



function BuscarAuditoriaHistorialMedico($buscar,$inicio,$fin){
    $conexion = new Conexion();
    $sql="SELECT * FROM audi_hmed_detalle WHERE  ani_apodo like ('%".$buscar."%') LIMIT ".$inicio.",".$fin;
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();
    $resultado=$sentencia->fetchall();
    return $resultado;

}

?>