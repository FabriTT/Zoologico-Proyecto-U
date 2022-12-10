var codigo = parseInt(Math.random()*10000);

function ocultar(){
    var x =document.getElementById("txtPassword");
    if(x.type=="password"){
        x.type="text";
   }else{
        x.type="password";
   }

}

function verificar(){
     var correo = document.getElementById("txtCorreo").value;
     var accion = document.getElementById("btnValidar").value;
     
     var info = "correo="+correo+"&accion="+accion;
     var info2 = "correo="+correo+"&codigo="+codigo;

     var regExp1 = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/g;
     var op =0;


     if(correo==null||correo==''||!regExp1.test(correo)){
          Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'El correo es obligatorio o el formato que ingreso es incorrecto',
          })
          op=1;
     }

     if(op==0){
          $.ajax({
               url: '../../Controladores/ControladorEmpleado.php',
               type: 'POST',
               data: info,
           })
           .done(function(respuesta){
               res=JSON.parse(respuesta)
               if(res!=null){
                   document.getElementById("OcultoId").value=res[0];
                   $.ajax({
                    url: '../../Controladores/Correo.php',
                    type: 'POST',
                    data: info2,
                    })
                    .done(function(respuesta2){
                       
                        if(respuesta2=='ok'){
                            Swal.fire({
                                icon: 'success',
                                title: 'Correcto',
                                text: 'Se envio a su correo un codigo para verificar su identidad, a continuacion ingrese el codigo',
                            })
                            document.getElementById("btnComprobar").style.display='block';
                            document.getElementById("btnValidar").style.display='none';
                            document.getElementById("txtCorreo").disabled=true;
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Error:'+respuesta2,
                            })
                        }
                        
                    });
               }else{
                   Swal.fire({
                       icon: 'error',
                       title: 'Error',
                       text: 'El correo que ingreso no se encuentra registrado en el sistema',
                   })
               }
               
           });
     }
}


function validarNum(){
    var numero = document.getElementById("txtNumero").value;

    if(numero==codigo){
        Swal.fire({
            icon: 'success',
            title: 'Correcto',
            text: 'El codigo es correcto',
        })
        document.getElementById("txtNumero").disabled=true;
        document.getElementById("btnComprobar").style.display='none';
        document.getElementById("btnRestablecer").style.display='block';

    }else{
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'El codigo es incorrecto',
        })
    }
}



function CambiarContra(){
    var contra = document.getElementById("txtPassword").value;
    var id = document.getElementById("OcultoId").value;
    var accion = document.getElementById("btnRestablecer").value;



    var infoContra = "contra="+contra+"&id="+id+"&accion="+accion;

    var op =0;

    if(contra==null||contra==''){
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'La contraseña es obligatoria',
        })
        op=1;
   }

   if(op==0){
    $.ajax({
        url: '../../Controladores/ControladorEmpleado.php',
        type: 'POST',
        data: infoContra,
    })
    .done(function(respuesta3){

        if(respuesta3.trim()==1){
            Swal.fire({
                icon: 'success',
                title: 'Correcto',
                text: 'Se modifico exitosamente su contraseña',
            })
            document.getElementById("txtPassword").disabled=true;
            document.getElementById("btnRestablecer").style.display='none';
            setTimeout(function(){
                location.href="../Login/index.html";
            },2500);
            
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error'+respuesta3,
            })
        }
    });
   }
}
