<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;
    
    require 'PHPMailer/Exception.php';
    require 'PHPMailer/PHPMailer.php';
    require 'PHPMailer/SMTP.php';


    //correo de la BD
    $txtCorreo=(isset($_POST['correo']))?$_POST['correo']:"";

    //codigo autogenerado
    $txtCodigo=(isset($_POST['codigo']))?$_POST['codigo']:"";
    


    
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'bioparque.vesty.pakos@gmail.com';                     //SMTP username
        $mail->Password   = 'ifbrqzgkpzemeimg';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('foxcoon.pruebas@gmail.com', 'Administrador');
        $mail->addAddress($txtCorreo);     //Add a recipient



        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Restablecer contrasena de acceso';
        $mail->Body    = 'El siguiente codigo debe ingresarlo en la aplicacion para que pueda restaurar su contraseña:'.$txtCodigo;


        $mail->send();
        echo 'ok';
    } catch (Exception $e) {
        echo "Hubo un error al enviar el mensaje: {$mail->ErrorInfo}";
    }




?>