function ocultar(){
    var x =document.getElementById("password");
    if(x.type=="password"){
        x.type="text";
   }else{
        x.type="password";
   }

}

function Validar(){
    var x = document.getElementById("contador").value;
    var usuario = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var accion = document.getElementById("btnAcceder").value;
    var info = "usuario="+usuario+"&password="+password+"&accion="+accion;

    if(usuario == '' || password == ''){

        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El usuario y la contraseña son campos obligatorios',
        })
    }else{
        $.ajax({
            url: '../../Controladores/ControladorEmpleado.php',
            type: 'POST',
            data: info,
        })
        .done(function(respuesta){
            console.log(respuesta)
            res=JSON.parse(respuesta)
            console.log(res);
            if(res!=null){
    
                location.href="../DashBoard/index.php?n="+res[1]+"&a="+res[2]+"&c="+res[3]+"&i="+res[4];
    
            }else if(res==null){
                x++;
                document.getElementById("contador").value=x;
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Usted no se encuentra registrado o los datos que ingreso son incorrectos',
                })
                if(x>3){
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Usted realizo demasiados intentos puede cambiar su contraseña con el siguiente link',
                        footer: '<a href="#">Olvidaste tu contraseña?</a>'
                    })
                }
            }
        });
    }
    
}