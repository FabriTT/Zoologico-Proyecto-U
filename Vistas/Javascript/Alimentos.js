function sel_alimento(dataAlimento){
    e=dataAlimento.split('||');

   document.getElementById("ModtxtId").innerHTML=e[0];
   $("#ModtxtAlimento").val(e[1]);
   document.getElementById("ModtxtEmpaque").value=e[2];
   document.getElementById("ModtxtEmpaque").text=e[3]; 
   document.getElementById("ModtxtClasificacion").value=e[4];
   $("#ModtxtStock").val(e[5]);
   $("#ModtxtConsumoMensual").val(e[8]);
   $("#ModtxtPedido").val(e[9]);
   $("#ModtxtMantenimiento").val(e[10]);
   $("#ModtxtEntrega").val(e[11]);
   $("#ModtxtVencimiento").val(e[12]);


}


function guardar_alimento(){
    var alimento = document.getElementById("txtAlimento").value;
    var empaque = document.getElementById("txtEmpaque").value;
    var clasificacion = document.getElementById("txtClasificacion").value;
    var stock = document.getElementById("txtStock").value;
    var consumo = document.getElementById("txtConsumoMensual").value;
    var pedido = document.getElementById("txtPedido").value;
    var mantenimiento = document.getElementById("txtMantenimiento").value;
    var entrega = document.getElementById("txtEntrega").value;
    var vencimiento = document.getElementById("txtVencimiento").value;


    var accion = document.getElementById("btnGua").value;

    var regExp2 = /[a-zA-Z]+/;

    var infoGE = "alimento="+alimento+"&empaque="+empaque+"&clasificacion="+clasificacion+"&stock="+stock+"&consumo="+consumo+"&pedido="+pedido+"&mantenimiento="+mantenimiento+"&entrega="+entrega+"&vencimiento="+vencimiento+"&accion="+accion;
    var op=0;

    if(alimento==null||alimento==''||!regExp2.test(alimento)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El alimento es obligatorio y no debe contener numeros',
        })
        op=1;
    }
    if(empaque==null||empaque==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El empaque del alimento es obligatorio y no debe contener numeros',
        })
        op=1;
    }

    if(clasificacion==null||clasificacion==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'La clasificacion del alimento es obligatorio y no debe contener numeros',
        })
        op=1;
    }

    if(stock==null||stock==''||stock==0){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El stock del alimento es obligatorio y no debe contener numeros',
        })
        op=1;
    }

    if(consumo==null||consumo==''||consumo==0){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El consumo mensual del alimento es obligatorio y no debe contener numeros',
        })
        op=1;
    }

    if(pedido==null||pedido==''||pedido==0){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El costo del pedido del alimento es obligatorio y no debe contener numeros',
        })
        op=1;
    }

    if(mantenimiento==null||mantenimiento==''||mantenimiento==0){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El mantenimiento del alimento es obligatorio y no debe contener numeros',
        })
        op=1;
    }

    if(entrega==null||entrega==''||entrega==0){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'La entega en dias del pedido del alimento es obligatorio y no debe contener numeros',
        })
        op=1;
    }

    if(vencimiento==null||vencimiento==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'La fecha de vencimiento del alimento es obligatorio y no debe contener numeros',
        })
        op=1;
    }




    
    if(op==0){
        $.ajax({
            url: '../Controladores/ControladorAlimento.php',
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
                    location.href="../Vistas/VistaAlimentos.php?tbl=normal&info=&pagina=1";
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



function editar_alimento(){
    
    var id = document.getElementById("ModtxtId").innerHTML;

    var alimento = document.getElementById("ModtxtAlimento").value;
    var empaque = document.getElementById("ModtxtEmpaque").value;
    var clasificacion = document.getElementById("ModtxtClasificacion").value;
    var stock = document.getElementById("ModtxtStock").value;
    var consumo = document.getElementById("ModtxtConsumoMensual").value;
    var pedido = document.getElementById("ModtxtPedido").value;
    var mantenimiento = document.getElementById("ModtxtMantenimiento").value;
    var entrega = document.getElementById("ModtxtEntrega").value;
    var vencimiento = document.getElementById("ModtxtVencimiento").value;


    var accion = document.getElementById("btnEdit").value;

    var regExp2 = /[a-zA-Z]+/;

    var infoME = "alimento="+alimento+"&empaque="+empaque+"&clasificacion="+clasificacion+"&stock="+stock+"&consumo="+consumo+"&pedido="+pedido+"&mantenimiento="+mantenimiento+"&entrega="+entrega+"&vencimiento="+vencimiento+"&accion="+accion+"&id="+id;
    var op=0;

    if(alimento==null||alimento==''||!regExp2.test(alimento)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El alimento es obligatorio y no debe contener numeros',
        })
        op=1;
    }
    if(empaque==null||empaque==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El empaque del alimento es obligatorio y no debe contener numeros',
        })
        op=1;
    }

    if(clasificacion==null||clasificacion==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'La clasificacion del alimento es obligatorio y no debe contener numeros',
        })
        op=1;
    }

    if(stock==null||stock==''||stock==0){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El stock del alimento es obligatorio y no debe contener numeros',
        })
        op=1;
    }

    if(consumo==null||consumo==''||consumo==0){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El consumo mensual del alimento es obligatorio y no debe contener numeros',
        })
        op=1;
    }

    if(pedido==null||pedido==''||pedido==0){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El costo del pedido del alimento es obligatorio y no debe contener numeros',
        })
        op=1;
    }

    if(mantenimiento==null||mantenimiento==''||mantenimiento==0){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El mantenimiento del alimento es obligatorio y no debe contener numeros',
        })
        op=1;
    }

    if(entrega==null||entrega==''||entrega==0){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'La entega en dias del pedido del alimento es obligatorio y no debe contener numeros',
        })
        op=1;
    }

    if(vencimiento==null||vencimiento==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'La fecha de vencimiento del alimento es obligatorio y no debe contener numeros',
        })
        op=1;
    }


    


    if(op==0){
        $.ajax({
            url: '../Controladores/ControladorAlimento.php',
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
                    location.href="../Vistas/VistaAlimentos.php?tbl=normal&info=&pagina=1";
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




function eliminar_alimento(id){

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
                url: '../Controladores/ControladorAlimento.php',
                type: 'POST',
                data: infoELE,
            })
            .done(function(respuesta){
                
                if(respuesta==1){
                    
                    
                    setTimeout(function(){
                        location.href="../Vistas/VistaAlimentos.php?tbl=normal&info=&pagina=1";
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


function reactivar_alimento(id){

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
                url: '../Controladores/ControladorAlimento.php',
                type: 'POST',
                data: infoELE,
            })
            .done(function(respuesta){
                
                if(respuesta==1){
                    
                    
                    setTimeout(function(){
                        location.href="../Vistas/VistaAlimentosEli.php?tbl=normal&info=&pagina=1";
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







function buscar_alimento(){

    var buscar = document.getElementById("txtBuscar").value;

    location.href="VistaAlimentos.php?tbl=busqueda&info="+buscar+"&pagina=1";
  
}


function buscar_alimentoEli(){

    var buscar = document.getElementById("txtBuscar").value;
    var regExp2 = /[a-zA-Z]+/;


    location.href="VistaAlimentosEli.php?tbl=busqueda&info="+buscar+"&pagina=1";
  
}

function buscar_audi_alimento(){

    var buscar = document.getElementById("txtBuscar").value;
    var regExp2 = /[a-zA-Z]+/;


    location.href="VistaAuditoriaAlimentos.php?tbl=busqueda&info="+buscar+"&pagina=1";
  
}



function ReporteAuditoria(){
    top.location.href="../Reportes/ReporteAuditoriaAlimentos.php";
}


