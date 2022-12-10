<?php
    $db_host = "localhost";
    $db_name = "db_zoologico";
    $db_user = "root";
    $db_password = "";

    $fecha = date("Ymd-His");

    $salida_sql = $db_name."_".$fecha.".sql";

    $dump = "mysqldump -h$db_host -u$db_user -p$db_password --opt $db_name > $salida_sql";
    try {
        system($dump,$output);
        echo 1;    
    } catch (Exception $e) {
        echo "Error: ".$e;
    }
    

?>

