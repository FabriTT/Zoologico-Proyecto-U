function sel_empleado(dataEmpleados){
    e=dataEmpleados.split('||');

    document.getElementById("ModtxtId").innerHTML=e[0];
   $("#ModtxtNombre").val(e[1]);
   $("#ModtxtPaterno").val(e[2]);
   $("#ModtxtMaterno").val(e[3]);
   $("#ModtxtCarnet").val(e[4]);
   document.getElementById("ModtxtUsuario").innerHTML=e[7]+e[4];
   $("#ModtxtCorreo").val(e[5]);
   $("#ModtxtTelefono").val(e[6]);
   $("#ModtxtFecha").val(e[9]);
   $("#ModtxtTelefonoR").val(e[10]);


   document.getElementById("ModtxtCargo").value=e[7];
   document.getElementById("ModtxtCargo").text=e[8];


}


function guardar_empleado(){
    var nombre = document.getElementById("txtNombre").value;
    var paterno = document.getElementById("txtPaterno").value;
    var materno = document.getElementById("txtMaterno").value;
    var fecha = document.getElementById("txtFecha").value;
    var contra = document.getElementById("txtContraseña").value;
    var carnet = document.getElementById("txtCarnet").value;
    var cargo = document.getElementById("txtCargo").value;
    var telefono = document.getElementById("txtTelefono").value;
    var telefonoR = document.getElementById("txtTelefonoR").value;
    var correo = document.getElementById("txtCorreo").value;
    var imagen = document.getElementById("txtImagen").value;
    try {
        var imagen = document.getElementById("txtImagen").files[0]['name'];    
    } catch (error) {
        
    }
    



    var accion = document.getElementById("btnGua").value;

    var regExp1 = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/g;
    var regExp2 = /[a-zA-Z]+/;

    


    var infoGE = "nombre="+nombre+"&paterno="+paterno+"&materno="+materno+"&fecha="+fecha+"&contra="+contra+"&carnet="+carnet+"&cargo="+cargo+"&telefono="+telefono+"&telefonoR="+telefonoR+"&correo="+correo+"&imagen="+imagen+"&accion="+accion;
    var op=0;

    if(nombre==null||nombre==''||!regExp2.test(nombre)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El nombre es obligatorio y no debe contener numeros',
        })
        op=1;
    }
    if(paterno==null||paterno==''||!regExp2.test(paterno)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El apellido paterno es obligatorio y no debe contener numeros',
        })
        op=1;
    }
    if(materno==null||materno==''||!regExp2.test(materno)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El apellido materno es obligatorio y no debe contener numeros',
        })
        op=1;
    }

    if(fecha==null||fecha==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'La fecha de nacimiento es obligatoria',
        })
        op=1;
    }

    if(contra==null||contra==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'La contraseña es obligatoria',
        })
        op=1;
    }

    if(carnet==null||carnet==''||isNaN(carnet)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El carnet es obligatorio y debe contener solo numeros',
        })
        op=1;
    }


    if(cargo==null||cargo==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El cargo es obligatorio',
        })
        op=1;
    }

    if(correo==null||correo==''||!regExp1.test(correo)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El correo es obligatorio o el formato que ingreso es incorrecto',
        })
        op=1;
    }

    if(telefono==null||telefono==''||isNaN(telefono)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El telefono es obligatorio y debe contener solo numeros',
        })
        op=1;
    }

    if(telefonoR==null||telefonoR==''||isNaN(telefonoR)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El telefono de referencia es obligatorio y debe contener solo numeros',
        })
        op=1;
    }

    if(imagen==''||imagen==null){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'La imagen del usuario es obligatoria',
        })
        op=1;
        
    }
    
    if(op==0){
        $.ajax({
            url: '../Controladores/ControladorEmpleado.php',
            type: 'POST',
            data: infoGE,
        })
        .done(function(respuesta){
            console.log(respuesta)
            if(respuesta=='ok'){
                Swal.fire({
                    icon: 'success',
                    title: 'Correcto',
                    text: 'Se registro exitosamente',
                })
                setTimeout(function(){
                    location.href="../Vistas/VistaEmpleados.php?tbl=normal&info=&pagina=1";
                },2500);    
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Surgio un error:' + respuesta,
                })
            }
            
        });
    }

}



function editar_empleado(){
    
    var nombre = document.getElementById("ModtxtNombre").value;
    var paterno = document.getElementById("ModtxtPaterno").value;
    var materno = document.getElementById("ModtxtMaterno").value;
    var carnet = document.getElementById("ModtxtCarnet").value;
    var fecha = document.getElementById("ModtxtFecha").value;
    var cargo = document.getElementById("ModtxtCargo").value;
    var telefono = document.getElementById("ModtxtTelefono").value;
    var telefonoR = document.getElementById("ModtxtTelefonoR").value;
    var correo = document.getElementById("ModtxtCorreo").value;
    var imagen = document.getElementById("ModtxtImagen").value;
    try {
        var imagen = document.getElementById("ModtxtImagen").files[0]['name'];    
    } catch (error) {
        
    }

    var id = document.getElementById("ModtxtId").innerHTML;
    console.log(id);


    var regExp1 = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/g;
    var regExp2 = /[a-zA-Z]+/;



    
    var op=0;

    if(nombre==null||nombre==''||!regExp2.test(nombre)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El nombre es obligatorio y no debe contener numeros',
        })
        op=1;
    }
    if(paterno==null||paterno==''||!regExp2.test(paterno)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El apellido paterno es obligatorio y no debe contener numeros',
        })
        op=1;
    }
    if(materno==null||materno==''||!regExp2.test(materno)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El apellido materno es obligatorio y no debe contener numeros',
        })
        op=1;
    }

    if(imagen==null||imagen==''){
        op=0;
        var infoEE = "nombre="+nombre+"&paterno="+paterno+"&materno="+materno+"&carnet="+carnet+"&fecha="+fecha+"&cargo="+cargo+"&telefono="+telefono+"&telefonoR="+telefonoR+"&correo="+correo+"&accion="+"btnModificar"+"&id="+id;
    }else{
        op=2;
        var infoEE = "nombre="+nombre+"&paterno="+paterno+"&materno="+materno+"&carnet="+carnet+"&fecha="+fecha+"&cargo="+cargo+"&telefono="+telefono+"&telefonoR="+telefonoR+"&correo="+correo+"&imagen="+imagen+"&accion="+"btnModificarImg"+"&id="+id;
    }

    if(carnet==null||carnet==''||isNaN(carnet)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El carnet es obligatorio y debe contener solo numeros',
        })
        op=1;
    }

    if(fecha==null||fecha==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'La fecha de nacimiento es obligatorio',
        })
        op=1;
    }

    if(cargo==null||cargo==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El cargo es obligatorio',
        })
        op=1;
    }

    if(correo==null||correo==''||!regExp1.test(correo)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El correo es obligatorio o el formato que ingreso es incorrecto',
        })
        op=1;
    }

    if(telefono==null||telefono==''||isNaN(telefono)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El telefono es obligatorio y debe contener solo numeros',
        })
        op=1;
    }

    if(telefonoR==null||telefonoR==''||isNaN(telefonoR)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El telefono de referencia es obligatorio y debe contener solo numeros',
        })
        op=1;
    }

    


    if(op==0){
        $.ajax({
            url: '../Controladores/ControladorEmpleado.php',
            type: 'POST',
            data: infoEE,
        })
        .done(function(respuesta){
            console.log(respuesta)
            if(respuesta=='ok'){
                Swal.fire({
                    icon: 'success',
                    title: 'Correcto',
                    text: 'Se edito exitosamente',
                })
                setTimeout(function(){
                    location.href="../Vistas/VistaEmpleados.php?tbl=normal&info=&pagina=1";
                },2500);    
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Surgio un error:' + respuesta,
                })
            }
            
        });
    }


    if(op==2){

        
        $.ajax({
            url: '../Controladores/ControladorEmpleado.php',
            type: 'POST',
            data: infoEE,
        })
        .done(function(respuesta){
            console.log(respuesta)
            if(respuesta=='ok'){
                Swal.fire({
                    icon: 'success',
                    title: 'Correcto',
                    text: 'Se modifico exitosamente',
                })
                setTimeout(function(){
                    location.href="../Vistas/VistaEmpleados.php?tbl=normal&info=&pagina=1";
                },2500);    
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Surgio un error:' + respuesta,
                })
            }
            
        });
    }



}




function eliminar_empleado(id){

    var accion = document.getElementById("btnEli").value;


    var infoELE = "accion="+accion+"&id="+id;
    var op=0;
   
    Swal.fire({
        title: 'Estas seguro de eliminar el registro?',
        showDenyButton: true,
        confirmButtonText: 'Aceptar',
        denyButtonText: `Cancelar`,
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '../Controladores/ControladorEmpleado.php',
                type: 'POST',
                data: infoELE,
            })
            .done(function(respuesta){
                
                if(respuesta=='ok'){
                    
                    
                    setTimeout(function(){
                        location.href="../Vistas/VistaEmpleados.php?tbl=normal&info=&pagina=1";
                    },2500);  
                        
      
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Surgio un error:' + respuesta,
                    })
                }
                
            });  
          Swal.fire('Eliminado', '', 'success')
        } else if (result.isDenied) {
          Swal.fire('Cancelado', '', 'info')
        }
      })
    
    
       
}


function reactivar_empleado(id){

    var accion = document.getElementById("btnEli").value;


    var infoELE = "accion="+accion+"&id="+id;
    var op=0;
   
    Swal.fire({
        title: 'Estas seguro de restaurar el registro?',
        showDenyButton: true,
        confirmButtonText: 'Aceptar',
        denyButtonText: `Cancelar`,
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '../Controladores/ControladorEmpleado.php',
                type: 'POST',
                data: infoELE,
            })
            .done(function(respuesta){
                
                if(respuesta=='ok'){
                    
                    
                    setTimeout(function(){
                        location.href="../Vistas/VistaEmpleadosEli.php?tbl=normal&info=&pagina=1";
                    },2500);  
                        
      
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Surgio un error:' + respuesta,
                    })
                }
                
            });  
          Swal.fire('Restaurado', '', 'success')
        } else if (result.isDenied) {
          Swal.fire('Cancelado', '', 'info')
        }
      })
    
    
       
}







function buscar_empleado(){

    var buscar = document.getElementById("txtBuscar").value;
    var regExp2 = /[a-zA-Z]+/;


    location.href="VistaEmpleados.php?tbl=busqueda&info="+buscar+"&pagina=1";
  
}


function buscar_empleadoEli(){

    var buscar = document.getElementById("txtBuscar").value;
    var regExp2 = /[a-zA-Z]+/;


    location.href="VistaEmpleadosEli.php?tbl=busqueda&info="+buscar+"&pagina=1";
  
}

function buscar_audi_empleado(){

    var buscar = document.getElementById("txtBuscar").value;
    var regExp2 = /[a-zA-Z]+/;


    location.href="VistaAuditoriaEmpleados.php?tbl=busqueda&info="+buscar+"&pagina=1";
  
}



function ReporteAuditoria(){
    top.location.href="../Reportes/ReporteAuditoriaEmpleados.php";
}

