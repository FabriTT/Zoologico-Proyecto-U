function sel_historialAlimenticio(dataHistorial){
    e=dataHistorial.split('||');

   document.getElementById("ModtxtId").innerHTML=e[11];

   document.getElementById("ModtxtEmpleado").value=e[0];
   document.getElementById("ModtxtEmpleado").text=e[1]+" "+e[2]; 

   document.getElementById("ModtxtAnimal").value=e[3];
   document.getElementById("ModtxtAnimal").text=e[4]+"-"+e[5];
   
   document.getElementById("ModtxtAlimento").value=e[6];
   document.getElementById("ModtxtAlimento").text=e[7];

   $("#ModtxtCantidad").val(e[9]);
   $("#ModtxtAux").val(e[9]);
   $("#ModtxtFecha").val(e[10]);


}


function buscar_historialAlimenticio(){

    var buscar = document.getElementById("txtBuscar").value;

    location.href="VistaHistorialesAlimenticios.php?tbl=busqueda&info="+buscar+"&pagina=1";
  
}


function buscar_historialAlimenticioEli(){

    var buscar = document.getElementById("txtBuscar").value;

    location.href="VistaHistorialesAlimenticiosEli.php?tbl=busqueda&info="+buscar+"&pagina=1";
  
}




function guardar_historial(){
    var empleado = document.getElementById("txtEmpleado").value;
    var animal = document.getElementById("txtAnimal").value;
    var alimento = document.getElementById("txtAlimento").value;
    var cantidad = document.getElementById("txtCantidad").value;
    var fecha = document.getElementById("txtFecha").value;

    var accion = document.getElementById("btnGua").value;

    var regExp2 = /[a-zA-Z]+/;

    var info1 = "empleado="+empleado+"&animal="+animal+"&alimento="+alimento+"&cantidad="+cantidad+"&fecha="+fecha+"&accion="+accion;
    var info2 = "alimento="+alimento+"&accion=Validar";

    var op=0;

    if(empleado==null||empleado==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El veterinario es obligatorio ',
        })
        op=1;
    }

    if(animal==null||animal==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El animal es obligatorio ',
        })
        op=1;
    }

    if(alimento==null||alimento==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El alimento es obligatorio ',
        })
        op=1;
    }

   
    if(fecha==null||fecha==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'La fecha de registro es obligatoria',
        })
        op=1;
    }

    if(cantidad==null||cantidad==''||isNaN(cantidad)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'La cantidad es obligatoria y debe contener solo numeros',
        })
        op=1;
    }




    if(op==0){
        $.ajax({
            url: '../Controladores/ControladorHistorialAlimenticio.php',
            type: 'POST',
            data: info2,
        })
        .done(function(respuesta){
            res=JSON.parse(respuesta)
            if(cantidad>res[0]){
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'No cuenta con esa cantidad de alimento, usted cuenta con '+res[0]+" unidades de "+res[1],
                })
            }else{
                $.ajax({
                    url: '../Controladores/ControladorHistorialAlimenticio.php',
                    type: 'POST',
                    data: info1,
                })
                .done(function(respuesta){

                    if(respuesta==1){
                        Swal.fire({
                            icon: 'success',
                            title: 'Correcto',
                            text: 'Se registro exitosamente',
                        })
                        setTimeout(function(){
                            location.href="../Vistas/VistaHistorialesAlimenticios.php?tbl=normal&info=&pagina=1";
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
            
            
        });
    }

}





function editar_historial(){
    var id = document.getElementById("ModtxtId").innerHTML;
    var empleado = document.getElementById("ModtxtEmpleado").value;
    var animal = document.getElementById("ModtxtAnimal").value;
    var alimento = document.getElementById("ModtxtAlimento").value;
    var cantidad = document.getElementById("ModtxtCantidad").value;
    var aux = document.getElementById("Aux").value;
    var fecha = document.getElementById("ModtxtFecha").value;

    var accion = document.getElementById("btnEdit").value;

    var regExp2 = /[a-zA-Z]+/;

    var info1 = "empleado="+empleado+"&animal="+animal+"&alimento="+alimento+"&cantidad="+cantidad+"&fecha="+fecha+"&accion="+accion+"&id="+id;
    var info2 = "alimento="+alimento+"&accion=Validar";

    var op=0;

    if(empleado==null||empleado==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El veterinario es obligatorio ',
        })
        op=1;
    }

    if(animal==null||animal==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El animal es obligatorio ',
        })
        op=1;
    }

    if(alimento==null||alimento==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El alimento es obligatorio ',
        })
        op=1;
    }

   
    if(fecha==null||fecha==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'La fecha de registro es obligatoria',
        })
        op=1;
    }

    if(cantidad==null||cantidad==''||isNaN(cantidad)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'La cantidad es obligatoria y debe contener solo numeros',
        })
        op=1;
    }




    if(op==0){
        $.ajax({
            url: '../Controladores/ControladorHistorialAlimenticio.php',
            type: 'POST',
            data: info2,
        })
        .done(function(respuesta){
            res=JSON.parse(respuesta)
            
            
            if(cantidad>(parseInt(res[0])+parseInt(aux))){
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'No cuenta con esa cantidad de alimento, usted cuenta con '+(parseInt(res[0])+parseInt(aux))+" unidades de "+res[1],
                })
            }else{
                $.ajax({
                    url: '../Controladores/ControladorHistorialAlimenticio.php',
                    type: 'POST',
                    data: info1,
                })
                .done(function(respuesta){

                    if(respuesta==1){
                        Swal.fire({
                            icon: 'success',
                            title: 'Correcto',
                            text: 'Se registro exitosamente',
                        })
                        setTimeout(function(){
                            location.href="../Vistas/VistaHistorialesAlimenticios.php?tbl=normal&info=&pagina=1";
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
            
            
        });
    }

}



function eliminar_historial(id,alimento){

    var accion = document.getElementById("btnEli").value;


    var infoELE = "accion="+accion+"&id="+id+"&alimento="+alimento;

   
    Swal.fire({
        title: 'Estas seguro de eliminar el registro?, al eliminar el registro la cantidad se eliminara y se agregara al stock del alimento',
        showDenyButton: true,
        confirmButtonText: 'Aceptar',
        denyButtonText: `Cancelar`,
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '../Controladores/ControladorHistorialAlimenticio.php',
                type: 'POST',
                data: infoELE,
            })
            .done(function(respuesta){
                
                if(respuesta==1){
                    
                    
                    setTimeout(function(){
                        location.href="../Vistas/VistaHistorialesAlimenticios.php?tbl=normal&info=&pagina=1";
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



function reactivar_historial(id){

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
                url: '../Controladores/ControladorHistorialAlimenticio.php',
                type: 'POST',
                data: infoELE,
            })
            .done(function(respuesta){
                
                if(respuesta==1){
                    
                    
                    setTimeout(function(){
                        location.href="../Vistas/VistaHistorialesAlimenticiosEli.php?tbl=normal&info=&pagina=1";
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


function buscar_audi_historial(){

    var buscar = document.getElementById("txtBuscar").value;
    var regExp2 = /[a-zA-Z]+/;


    location.href="VistaAuditoriaHistorialesAlimenticios.php?tbl=busqueda&info="+buscar+"&pagina=1";
  
}



function ReporteAuditoria(){
    top.location.href="../Reportes/ReporteAuditoriaHistorialesAlimenticios.php";
}

