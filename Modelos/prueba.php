<?php
    include_once 'Conexion.php';

    $conexion = new Conexion();

    $sql='SELECT * FROM $cargo';
    $sql2='SELECT * FROM $cargo';
    $sentencia = $conexion->conect->prepare($sql);
    $sentencia->execute();

    $sentencia2 = $conexion->conect->prepare($sql2);
    $sentencia2->execute();
    

    foreach($sentencia as $cargo){
        echo $cargo['car_descripcion'].'<br>';
    }
    echo '<br>';
    echo '<font color=red>';
    foreach($sentencia2 as $cargo){

        echo $cargo['car_descripcion'].'<br>';
    }

?>