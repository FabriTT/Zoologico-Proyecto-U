function sel_habitat(dataHabitat){
    e=dataHabitat.split('||');

    document.getElementById("ModtxtId").innerHTML=e[0];
   $("#ModtxtNombre").val(e[1]);
   $("#ModtxtNombreA").val(e[2]);
   $("#ModtxtClasificacion").val(e[3]);
   $("#ModtxtCapacidad").val(e[4]);
   $("#ModtxtLimpieza").val(e[5]);
   ali=e[6].split('-');
   $("#ModtxtAlimentacion1").val(ali[0]);
   $("#ModtxtAlimentacion2").val(ali[1]);
   $("#ModtxtAlimentacion3").val(ali[2]);


}


function guardar_habitat(){
    var nombre = document.getElementById("txtNombre").value;
    var nombreA = document.getElementById("txtNombreA").value;
    var clasificacion = document.getElementById("txtClasificacion").value;
    var capacidad = document.getElementById("txtCapacidad").value;
    var limpieza = document.getElementById("txtLimpieza").value;
    var alimentacion1 = document.getElementById("txtAlimentacion1").value;
    var alimentacion2 = document.getElementById("txtAlimentacion2").value;
    var alimentacion3 = document.getElementById("txtAlimentacion3").value;


    var accion = document.getElementById("btnGua").value;

    var regExp2 = /[a-zA-Z]+/;

    


    var infoGE = "nombre="+nombre+"&nombreA="+nombreA+"&clasificacion="+clasificacion+"&capacidad="+capacidad+"&limpieza="+limpieza+"&alimentacion="+alimentacion1+"-"+alimentacion2+"-"+alimentacion3+"&accion="+accion;
    var op=0;

    if(nombre==null||nombre==''||!regExp2.test(nombre)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El nombre es obligatorio y no debe contener numeros',
        })
        op=1;
    }
    if(nombreA==null||nombreA==''||!regExp2.test(nombreA)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El animal es obligatorio y no debe contener numeros',
        })
        op=1;
    }
    if(clasificacion==null||clasificacion==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'La clasificacion es obligatoria y no debe contener numeros',
        })
        op=1;
    }

    if(capacidad==null||capacidad==''||isNaN(capacidad)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'La capacidad es obligatoria y debe contener solo numeros',
        })
        op=1;
    }

    if(limpieza==null||limpieza==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El horario de limpieza es obligatorio',
        })
        op=1;
    }

    if(alimentacion1==null||alimentacion1==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El horario de alimentacion por la mañana es obligatorio',
        })
        op=1;
    }

    if(alimentacion2==null||alimentacion2==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El horario de alimentacion por la tarde es obligatorio',
        })
        op=1;
    }

    if(alimentacion3==null||alimentacion3==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El horario de alimentacion por la noche es obligatorio',
        })
        op=1;
    }



    
    if(op==0){
        $.ajax({
            url: '../Controladores/ControladorHabitat.php',
            type: 'POST',
            data: infoGE,
        })
        .done(function(respuesta){
            console.log(respuesta)
            if(respuesta==1){
                Swal.fire({
                    icon: 'success',
                    title: 'Correcto',
                    text: 'Se registro exitosamente',
                })
                setTimeout(function(){
                    location.href="../Vistas/VistaHabitats.php?tbl=normal&info=&pagina=1";
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



function editar_habitat(){
    
    var nombre = document.getElementById("ModtxtNombre").value;
    var nombreA = document.getElementById("ModtxtNombreA").value;
    var clasificacion = document.getElementById("ModtxtClasificacion").value;
    var capacidad = document.getElementById("ModtxtCapacidad").value;
    var limpieza = document.getElementById("ModtxtLimpieza").value;
    var alimentacion1 = document.getElementById("ModtxtAlimentacion1").value;
    var alimentacion2 = document.getElementById("ModtxtAlimentacion2").value;
    var alimentacion3 = document.getElementById("ModtxtAlimentacion3").value;
    var accion = document.getElementById("btnEdit").value;


    var id = document.getElementById("ModtxtId").innerHTML;
    var regExp2 = /[a-zA-Z]+/;

    


    var infoME = "nombre="+nombre+"&nombreA="+nombreA+"&clasificacion="+clasificacion+"&capacidad="+capacidad+"&limpieza="+limpieza+"&alimentacion="+alimentacion1+"-"+alimentacion2+"-"+alimentacion3+"&id="+id+"&accion="+accion;
    var op=0;

    if(nombre==null||nombre==''||!regExp2.test(nombre)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El nombre es obligatorio y no debe contener numeros',
        })
        op=1;
    }
    if(nombreA==null||nombreA==''||!regExp2.test(nombreA)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El animal es obligatorio y no debe contener numeros',
        })
        op=1;
    }
    if(clasificacion==null||clasificacion==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'La clasificacion es obligatoria y no debe contener numeros',
        })
        op=1;
    }

    if(capacidad==null||capacidad==''||isNaN(capacidad)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'La capacidad es obligatoria y debe contener solo numeros',
        })
        op=1;
    }

    if(limpieza==null||limpieza==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El horario de limpieza es obligatorio',
        })
        op=1;
    }

    if(alimentacion1==null||alimentacion1==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El horario de alimentacion por la mañana es obligatorio',
        })
        op=1;
    }

    if(alimentacion2==null||alimentacion2==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El horario de alimentacion por la tarde es obligatorio',
        })
        op=1;
    }

    if(alimentacion3==null||alimentacion3==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El horario de alimentacion por la noche es obligatorio',
        })
        op=1;
    }


    


    if(op==0){
        $.ajax({
            url: '../Controladores/ControladorHabitat.php',
            type: 'POST',
            data: infoME,
        })
        .done(function(respuesta){
            console.log(respuesta)
            if(respuesta==1){
                Swal.fire({
                    icon: 'success',
                    title: 'Correcto',
                    text: 'Se edito exitosamente',
                })
                setTimeout(function(){
                    location.href="../Vistas/VistaHabitats.php?tbl=normal&info=&pagina=1";
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




function eliminar_habitat(id){

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
                url: '../Controladores/ControladorHabitat.php',
                type: 'POST',
                data: infoELE,
            })
            .done(function(respuesta){
                
                if(respuesta==1){
                    
                    
                    setTimeout(function(){
                        location.href="../Vistas/VistaHabitats.php?tbl=normal&info=&pagina=1";
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


function reactivar_habitat(id){

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
                url: '../Controladores/ControladorHabitat.php',
                type: 'POST',
                data: infoELE,
            })
            .done(function(respuesta){
                
                if(respuesta==1){
                    
                    
                    setTimeout(function(){
                        location.href="../Vistas/VistaHabitatsEli.php?tbl=normal&info=&pagina=1";
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







function buscar_habitat(){

    var buscar = document.getElementById("txtBuscar").value;

    location.href="VistaHabitats.php?tbl=busqueda&info="+buscar+"&pagina=1";
  
}


function buscar_habitatEli(){

    var buscar = document.getElementById("txtBuscar").value;
    var regExp2 = /[a-zA-Z]+/;


    location.href="VistaHabitatsEli.php?tbl=busqueda&info="+buscar+"&pagina=1";
  
}



function buscar_audi_habitat(){

    var buscar = document.getElementById("txtBuscar").value;
    var regExp2 = /[a-zA-Z]+/;


    location.href="VistaAuditoriaHabitats.php?tbl=busqueda&info="+buscar+"&pagina=1";
  
}



function ReporteAuditoria(){
    top.location.href="../Reportes/ReporteAuditoriaHabitats.php";
}


function animales(id){
    top.location.href="../Reportes/ReporteAnimalesHabitat.php?id="+id;
}
