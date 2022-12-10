<?php
    include_once '../Modelos/Conexion.php';
    include_once '../Modelos/Empleado.php';

    
    $empleado = new Empleado();
    
    $accion=(isset($_POST['accion']))?$_POST['accion']:"";
    


    
    switch($accion){
        case 'btnAcceder':
            $empleado->setUsuario((isset($_POST['usuario']))?$_POST['usuario']:"");
            $empleado->setContraseña(sha1((isset($_POST['password']))?$_POST['password']:""));
            $resultado=ValidarLogin($empleado);
            echo json_encode($resultado);
        break;
        case 'btnValidar':
            $empleado->setCorreo((isset($_POST['correo']))?$_POST['correo']:"");
            $resultado=ValidarCorreo($empleado);
            echo json_encode($resultado);
        break;
        case 'btnRestablecer':
            $empleado->setId((isset($_POST['id']))?$_POST['id']:"");
            $empleado->setContraseña(sha1((isset($_POST['contra']))?$_POST['contra']:""));
            $resultado=RestablecerContraseña($empleado);
            echo json_encode($resultado);
        break;
        case 'btnGuardar':
            $empleado->setNombre((isset($_POST['nombre']))?$_POST['nombre']:"");
            $empleado->setApellidoP((isset($_POST['paterno']))?$_POST['paterno']:"");
            $empleado->setApellidoM((isset($_POST['materno']))?$_POST['materno']:"");
            $empleado->setFechaN((isset($_POST['fecha']))?$_POST['fecha']:"");
            $empleado->setContraseña(sha1((isset($_POST['contra']))?$_POST['contra']:""));
            $empleado->setCarnet((isset($_POST['carnet']))?$_POST['carnet']:"");
            $empleado->setCargo((isset($_POST['cargo']))?$_POST['cargo']:"");
            $empleado->setTelefono((isset($_POST['telefono']))?$_POST['telefono']:"");
            $empleado->setTelefonoR((isset($_POST['telefonoR']))?$_POST['telefonoR']:"");
            $empleado->setCorreo((isset($_POST['correo']))?$_POST['correo']:"");
            $empleado->setImagen((isset($_POST['imagen']))?$_POST['imagen']:"");
            echo AgregarEmpleado($empleado);

        break;
        case 'btnModificar':
            $empleado->setId((isset($_POST['id']))?$_POST['id']:"");
            $empleado->setNombre((isset($_POST['nombre']))?$_POST['nombre']:"");
            $empleado->setApellidoP((isset($_POST['paterno']))?$_POST['paterno']:"");
            $empleado->setApellidoM((isset($_POST['materno']))?$_POST['materno']:"");
            $empleado->setFechaN((isset($_POST['fecha']))?$_POST['fecha']:"");
            $empleado->setCarnet((isset($_POST['carnet']))?$_POST['carnet']:"");
            $empleado->setCargo((isset($_POST['cargo']))?$_POST['cargo']:"");
            $empleado->setTelefono((isset($_POST['telefono']))?$_POST['telefono']:"");
            $empleado->setTelefonoR((isset($_POST['telefonoR']))?$_POST['telefonoR']:"");
            $empleado->setCorreo((isset($_POST['correo']))?$_POST['correo']:"");
            echo ModificarEmpleado($empleado);
        break;
        case 'btnModificarImg':
            $empleado->setId((isset($_POST['id']))?$_POST['id']:"");
            $empleado->setNombre((isset($_POST['nombre']))?$_POST['nombre']:"");
            $empleado->setApellidoP((isset($_POST['paterno']))?$_POST['paterno']:"");
            $empleado->setApellidoM((isset($_POST['materno']))?$_POST['materno']:"");
            $empleado->setFechaN((isset($_POST['fecha']))?$_POST['fecha']:"");
            $empleado->setContraseña(sha1((isset($_POST['contra']))?$_POST['contra']:""));
            $empleado->setCarnet((isset($_POST['carnet']))?$_POST['carnet']:"");
            $empleado->setCargo((isset($_POST['cargo']))?$_POST['cargo']:"");
            $empleado->setTelefono((isset($_POST['telefono']))?$_POST['telefono']:"");
            $empleado->setTelefonoR((isset($_POST['telefonoR']))?$_POST['telefonoR']:"");
            $empleado->setCorreo((isset($_POST['correo']))?$_POST['correo']:"");
            $empleado->setImagen((isset($_POST['imagen']))?$_POST['imagen']:"");
            echo ModificarEmpleadoImg($empleado);
        break;

        case 'btnEliminar':

            $empleado->setId((isset($_POST['id']))?$_POST['id']:"");
            echo EliminarEmpleado($empleado);
        break;
        case 'btnReactivar':

            $empleado->setId((isset($_POST['id']))?$_POST['id']:"");
            echo ReactivarEmpleado($empleado);
        break;

    }


    function ValidarLogin(Empleado $emp){

        $conexion = new Conexion();
        $sql="SELECT emp_id,emp_nombre,emp_apellidoP,car_id,emp_imagen FROM $"."empleados WHERE emp_usuario='".$emp->getUsuario()."' and emp_contraseña='".$emp->getContraseña()."' and emp_estado=1";
        $sentencia = $conexion->conect->prepare($sql);
        $sentencia->execute();
        $resultado=$sentencia->fetchall();

        foreach($resultado as $dato){
            return $dato;
        }
    }

    function ValidarCorreo(Empleado $emp){

        $conexion = new Conexion();
        $sql="SELECT emp_id FROM $"."empleados WHERE emp_correo='".$emp->getCorreo()."'";
        $sentencia = $conexion->conect->prepare($sql);
        $sentencia->execute();
        $resultado=$sentencia->fetchall();

        foreach($resultado as $dato){
            return $dato;
        }
    }

    function RestablecerContraseña(Empleado $emp){

        $conexion = new Conexion();
        try {
            $sql="UPDATE $"."empleados SET emp_contraseña = '".$emp->getContraseña()."' WHERE emp_id = ".$emp->getId();

            $sentencia = $conexion->conect->prepare($sql);
    
    
            $sentencia->execute();
            return 1;
            
        } catch (Exception $e) {
            return $emp->getCargo().'error al modificar en la base de datos'.$e;
        }
    }
    
    function CargoEmpleado($id){
        $conexion = new Conexion();
        $sql="SELECT * FROM emp_cargo WHERE emp_estado=1 and emp_id=".$id;
        $sentencia = $conexion->conect->prepare($sql);
        $sentencia->execute();
        $resultado=$sentencia->fetchall();

        foreach($resultado as $dato){
            return $dato;
        }
        

    }

    function ContarEmpleados($estado){
        $conexion = new Conexion();
        $sql="SELECT * FROM emp_cargo WHERE emp_estado=".$estado;
        $sentencia = $conexion->conect->prepare($sql);
        $sentencia->execute();
        $resultado=$sentencia->fetchall();
        return count($resultado);

    }

    function ContarEmpleadosB($buscar,$estado){
        $conexion = new Conexion();
        $sql="SELECT * FROM emp_cargo WHERE  emp_apellidoP like ('%".$buscar."%') and emp_estado=".$estado;
        $sentencia = $conexion->conect->prepare($sql);
        $sentencia->execute();
        $resultado=$sentencia->fetchall();
        return count($resultado);

    }


    function MostrarEmpleado($inicio,$fin,$estado){
        $conexion = new Conexion();
        $sql="SELECT * FROM emp_cargo WHERE emp_estado= ".$estado." LIMIT ".$inicio.",".$fin;
        $sentencia = $conexion->conect->prepare($sql);
        $sentencia->execute();
        $resultado=$sentencia->fetchall();
        return $resultado;

    }

    function TodosEmpleado(){
        $conexion = new Conexion();
        $sql="SELECT * FROM emp_cargo WHERE emp_estado=1";
        $sentencia = $conexion->conect->prepare($sql);
        $sentencia->execute();
        $resultado=$sentencia->fetchall();
        return $resultado;

    }



    function BuscarEmpleado($buscar,$inicio,$fin,$estado){
        $conexion = new Conexion();
        $sql="SELECT * FROM emp_cargo WHERE  emp_apellidoP like ('%".$buscar."%') and emp_estado=".$estado." LIMIT ".$inicio.",".$fin;
        $sentencia = $conexion->conect->prepare($sql);
        $sentencia->execute();
        $resultado=$sentencia->fetchall();
        return $resultado;

    }

    function AgregarEmpleado(Empleado $emp){
        $conexion = new Conexion();
        $emp->setUsuario($emp->getCargo().$emp->getCarnet());
        $emp->setEstado(1);
        try {
            $sql="INSERT INTO $"."empleados (emp_nombre,emp_apellidoP,emp_apellidoM,emp_fechaNac,emp_carnet,car_id,emp_usuario,emp_contraseña,emp_telefono,emp_telefonoR,emp_correo,emp_imagen,emp_estado) VALUES ('".$emp->getNombre()."','".$emp->getApellidoP()."','".$emp->getApellidoM()."','".$emp->getFechaN()."','".$emp->getCarnet()."','".$emp->getCargo()."','".$emp->getUsuario()."','".$emp->getContraseña()."','".$emp->getTelefono()."','".$emp->getTelefonoR()."','".$emp->getCorreo()."','".$emp->getImagen()."','".$emp->getEstado()."')";

            $sentencia = $conexion->conect->prepare($sql);
    
    
            $sentencia->execute();
            return 'ok';
            
        } catch (Exception $e) {
            return $emp->getCargo().'error al guardar en la base de datos'.$e;
        }
        
    }

    function ModificarEmpleado(Empleado $emp){
        $conexion = new Conexion();
        $emp->setUsuario($emp->getCargo().$emp->getCarnet());
        try {
            $sql="UPDATE $"."empleados SET emp_nombre='".$emp->getNombre()."',emp_apellidoP='".$emp->getApellidoP()."',emp_apellidoM='".$emp->getApellidoM()."',emp_carnet=".$emp->getCarnet().",emp_fechaNac='".$emp->getFechaN()."',car_id='".$emp->getCargo()."',emp_usuario='".$emp->getUsuario()."',emp_telefono=".$emp->getTelefono().",emp_telefonoR=".$emp->getTelefonoR().",emp_correo='".$emp->getCorreo()."' WHERE emp_id = ".$emp->getId();

            $sentencia = $conexion->conect->prepare($sql);
    
    
            $sentencia->execute();
            return 'ok';
            
        } catch (Exception $e) {
            return $emp->getCargo().'error al guardar en la base de datos'.$e."*******".$sql;
        }
    }

    function ModificarEmpleadoImg(Empleado $emp){
        $conexion = new Conexion();
        $emp->setUsuario($emp->getCargo().$emp->getCarnet());
        try {
            $sql="UPDATE $"."empleados SET emp_nombre='".$emp->getNombre()."',emp_apellidoP='".$emp->getApellidoP()."',emp_apellidoM='".$emp->getApellidoM()."',emp_carnet=".$emp->getCarnet().",emp_fechaNac='".$emp->getFechaN()."',car_id='".$emp->getCargo()."',emp_usuario='".$emp->getUsuario()."',emp_telefono=".$emp->getTelefono().",emp_telefonoR=".$emp->getTelefonoR().",emp_correo='".$emp->getCorreo()."',emp_imagen='".$emp->getImagen()."' WHERE emp_id = ".$emp->getId();

            $sentencia = $conexion->conect->prepare($sql);
    
    
            $sentencia->execute();
            return 'ok';
            
        } catch (Exception $e) {
            return $emp->getCargo().'error al guardar en la base de datos'.$e."*******".$sql;
        }
    }


    function EliminarEmpleado(Empleado $emp){
        $conexion = new Conexion();
        $emp->setEstado(0);
        try {
            $sql="UPDATE $"."empleados SET emp_estado = ".$emp->getEstado()." WHERE emp_id = ".$emp->getId();

            $sentencia = $conexion->conect->prepare($sql);
    
    
            $sentencia->execute();
            return 'ok';
            
        } catch (Exception $e) {
            return $emp->getCargo().'error al guardar en la base de datos'.$e;
        }
    }


    function ReactivarEmpleado(Empleado $emp){
        $conexion = new Conexion();
        $emp->setEstado(1);
        try {
            $sql="UPDATE $"."empleados SET emp_estado = ".$emp->getEstado()." WHERE emp_id = ".$emp->getId();

            $sentencia = $conexion->conect->prepare($sql);
    
    
            $sentencia->execute();
            return 'ok';
            
        } catch (Exception $e) {
            return $emp->getCargo().'error al guardar en la base de datos'.$e;
        }
    }

    function Veterinarios(){
        $conexion = new Conexion();
        $sql="SELECT * FROM emp_cargo WHERE emp_estado=1 and car_id='VET'";
        $sentencia = $conexion->conect->prepare($sql);
        $sentencia->execute();
        $resultado=$sentencia->fetchall();
        return $resultado;

    }

    function Almacenadores(){
        $conexion = new Conexion();
        $sql="SELECT * FROM emp_cargo WHERE emp_estado=1 and car_id='ALM'";
        $sentencia = $conexion->conect->prepare($sql);
        $sentencia->execute();
        $resultado=$sentencia->fetchall();
        return $resultado;

    }

    function Vendedores(){
        $conexion = new Conexion();
        $sql="SELECT * FROM emp_cargo WHERE emp_estado=1 and car_id='VEN'";
        $sentencia = $conexion->conect->prepare($sql);
        $sentencia->execute();
        $resultado=$sentencia->fetchall();
        return $resultado;

    }



    function ContarAuditoriaEmpleados(){
        $conexion = new Conexion();
        $sql="SELECT * FROM audi_emp_cargo";
        $sentencia = $conexion->conect->prepare($sql);
        $sentencia->execute();
        $resultado=$sentencia->fetchall();
        return count($resultado);

    }

    function ContarAuditoriaEmpleadosB($buscar){
        $conexion = new Conexion();
        $sql="SELECT * FROM audi_emp_cargo WHERE  audi_emp_apellidoP like ('%".$buscar."%') ";
        $sentencia = $conexion->conect->prepare($sql);
        $sentencia->execute();
        $resultado=$sentencia->fetchall();
        return count($resultado);

    }


    function MostrarAuditoriaEmpleado($inicio,$fin){
        $conexion = new Conexion();
        $sql="SELECT * FROM audi_emp_cargo LIMIT ".$inicio.",".$fin;
        $sentencia = $conexion->conect->prepare($sql);
        $sentencia->execute();
        $resultado=$sentencia->fetchall();
        return $resultado;

    }

    function TodosAuditoriaEmpleado(){
        $conexion = new Conexion();
        $sql="SELECT * FROM audi_emp_cargo";
        $sentencia = $conexion->conect->prepare($sql);
        $sentencia->execute();
        $resultado=$sentencia->fetchall();
        return $resultado;

    }



    function BuscarAuditoriaEmpleado($buscar,$inicio,$fin){
        $conexion = new Conexion();
        $sql="SELECT * FROM audi_emp_cargo WHERE  audi_emp_apellidoP like ('%".$buscar."%') LIMIT ".$inicio.",".$fin;
        $sentencia = $conexion->conect->prepare($sql);
        $sentencia->execute();
        $resultado=$sentencia->fetchall();
        return $resultado;

    }



?>