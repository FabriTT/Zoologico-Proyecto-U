function sel_planificacion(dataPlanificacion){
    e=dataPlanificacion.split('||');

    document.getElementById("ModtxtId").innerHTML=e[0];
    document.getElementById("ModtxtVendedor").value=e[1];
    document.getElementById("ModtxtVendedor").text=e[2]+" "+e[3]; 
   $("#ModtxtMenores").val(e[4]);
   $("#ModtxtMayores").val(e[5]);
   $("#ModtxtAMayores").val(e[6]);
   $("#ModtxtCantidad").val(e[7]);
   document.getElementById("ModtxtFecha").innerHTML=e[8];




}


function guardar_planificacion(){
    var empleado = document.getElementById("txtVendedor").value;
    var menores = document.getElementById("txtMenores").value;
    var mayores = document.getElementById("txtMayores").value;
    var Amayores = document.getElementById("txtAMayores").value;
    var cantidad = document.getElementById("txtCantidad").value;



    var accion = document.getElementById("btnGua").value;

    var regExp2 = /[a-zA-Z]+/;

    


    var infoGE = "empleado="+empleado+"&menores="+menores+"&mayores="+mayores+"&Amayores="+Amayores+"&cantidad="+cantidad+"&accion="+accion;
    var op=0;

    if(empleado==null||empleado==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El vendedor es obligatorio y no debe contener numeros',
        })
        op=1;
    }
    
    if(menores==null||menores==''||isNaN(menores)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El precio de la entrada para menores de edad es obligatoria y debe contener solo numeros',
        })
        op=1;
    }
    if(mayores==null||mayores==''||isNaN(mayores)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El precio de la entrada para mayores de edad es obligatoria y debe contener solo numeros',
        })
        op=1;
    }
    if(Amayores==null||Amayores==''||isNaN(Amayores)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El precio de la entrada para adultos mayores es obligatoria y debe contener solo numeros',
        })
        op=1;
    }
    if(cantidad==null||cantidad==''||isNaN(cantidad)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'La cantidad de entradas a vender es obligatoria y debe contener solo numeros',
        })
        op=1;
    }

    
    if(op==0){
        $.ajax({
            url: '../Controladores/ControladorPlanificacion.php',
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
                    location.href="../Vistas/VistaPlanificaciones.php?tbl=normal&info=&pagina=1";
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



function editar_planificacion(){
    
    var empleado = document.getElementById("ModtxtVendedor").value;
    var menores = document.getElementById("ModtxtMenores").value;
    var mayores = document.getElementById("ModtxtMayores").value;
    var Amayores = document.getElementById("ModtxtAMayores").value;
    var cantidad = document.getElementById("ModtxtCantidad").value;
    var accion = document.getElementById("btnEdit").value;


    var id = document.getElementById("ModtxtId").innerHTML;
    var regExp2 = /[a-zA-Z]+/;

    


    var infoGE1 = "accion=Validar"+"&id="+id;
    var infoGE2 = "empleado="+empleado+"&menores="+menores+"&mayores="+mayores+"&Amayores="+Amayores+"&cantidad="+cantidad+"&accion="+accion+"&id="+id;
    var op=0;

    if(empleado==null||empleado==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El vendedor es obligatorio y no debe contener numeros',
        })
        op=1;
    }
    
    if(menores==null||menores==''||isNaN(menores)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El precio de la entrada para menores de edad es obligatoria y debe contener solo numeros',
        })
        op=1;
    }
    if(mayores==null||mayores==''||isNaN(mayores)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El precio de la entrada para mayores de edad es obligatoria y debe contener solo numeros',
        })
        op=1;
    }
    if(Amayores==null||Amayores==''||isNaN(Amayores)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El precio de la entrada para adultos mayores es obligatoria y debe contener solo numeros',
        })
        op=1;
    }
    if(cantidad==null||cantidad==''||isNaN(cantidad)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'La cantidad de entradas a vender es obligatoria y debe contener solo numeros',
        })
        op=1;
    }

    if(op==0){

        $.ajax({
            url: '../Controladores/ControladorPlanificacion.php',
            type: 'POST',
            data: infoGE1,
        })
        .done(function(respuesta){
            if(respuesta==0){
                $.ajax({
                    url: '../Controladores/ControladorPlanificacion.php',
                    type: 'POST',
                    data: infoGE2,
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
                            location.href="../Vistas/VistaPlanificaciones.php?tbl=normal&info=&pagina=1";
                        },2500);    
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Surgio un error:' + respuesta,
                        })
                    }
                    
                });
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'error',
                    text: 'Ya no puede modificar esta planificacion debido a que se utilizo para alguna venta',
                })
            }
            
        });


       
    }




}




function eliminar_planificacion(id){

    var accion = document.getElementById("btnEli").value;

    var infoELE1 = "accion=Validar"+"&id="+id;
    var infoELE2 = "accion="+accion+"&id="+id;
    var op=0;
   
    Swal.fire({
        title: 'Estas seguro de eliminar el registro?',
        showDenyButton: true,
        confirmButtonText: 'Aceptar',
        denyButtonText: `Cancelar`,
      }).then((result) => {
        if (result.isConfirmed) {
           
            $.ajax({
                url: '../Controladores/ControladorPlanificacion.php',
                type: 'POST',
                data: infoELE1,
            })
            .done(function(respuesta){
                if(respuesta==0){
                    $.ajax({
                        url: '../Controladores/ControladorPlanificacion.php',
                        type: 'POST',
                        data: infoELE2,
                    })
                    .done(function(respuesta){
                        console.log(respuesta)
                        if(respuesta==1){
                            Swal.fire({
                                icon: 'success',
                                title: 'Correcto',
                                text: 'Se elemino exitosamente',
                            })
                            setTimeout(function(){
                                location.href="../Vistas/VistaPlanificaciones.php?tbl=normal&info=&pagina=1";
                            },2500);    
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Surgio un error:' + respuesta,
                            })
                        }
                        
                    });
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'error',
                        text: 'Ya no puede eliminar esta planificacion debido a que se utilizo para alguna venta',
                    })
                }
                
            });

          Swal.fire('Eliminado', '', 'success')
        } else if (result.isDenied) {
          Swal.fire('Cancelado', '', 'info')
        }
      })
    
    
       
}


function reactivar_planificacion(id){

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
                url: '../Controladores/ControladorPlanificacion.php',
                type: 'POST',
                data: infoELE,
            })
            .done(function(respuesta){
                
                if(respuesta==1){
                    
                    
                    setTimeout(function(){
                        location.href="../Vistas/VistaPlanificacionesEli.php?tbl=normal&info=&pagina=1";
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







function buscar_planificacion(){

    var buscar = document.getElementById("txtBuscar").value;

    location.href="VistaPlanificaciones.php?tbl=busqueda&info="+buscar+"&pagina=1";
  
}


function buscar_planificacionEli(){

    var buscar = document.getElementById("txtBuscar").value;
    var regExp2 = /[a-zA-Z]+/;


    location.href="VistaPlanificacionesEli.php?tbl=busqueda&info="+buscar+"&pagina=1";
  
}



function buscar_audi_planificacion(){

    var buscar = document.getElementById("txtBuscar").value;
    var regExp2 = /[a-zA-Z]+/;


    location.href="VistaAuditoriaPlanificaciones.php?tbl=busqueda&info="+buscar+"&pagina=1";
  
}



function ReporteAuditoria(){
    top.location.href="../Reportes/ReporteAuditoriaPlanificaciones.php";
}



function ver_venta(id,total){

    location.href="VistaVentas.php?tbl=busqueda&info=&pagina=1&plan="+id+"&total="+total;
  
}
