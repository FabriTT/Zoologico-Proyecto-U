function sel_medicamento(dataMedicmaento){
    e=dataMedicmaento.split('||');

   document.getElementById("ModtxtId").innerHTML=e[0];
   $("#ModtxtMedicamento").val(e[1]);
   document.getElementById("ModtxtEmpaque").value=e[2];
   document.getElementById("ModtxtEmpaque").text=e[3]; 
   document.getElementById("ModtxtAdministracion").value=e[4];
   $("#ModtxtStock").val(e[5]);
   $("#ModtxtVencimiento").val(e[6]);


}


function guardar_medicamento(){
    var medicamento = document.getElementById("txtMedicamento").value;
    var empaque = document.getElementById("txtEmpaque").value;
    var administracion = document.getElementById("txtAdministracion").value;
    var stock = document.getElementById("txtStock").value;
    var vencimiento = document.getElementById("txtVencimiento").value;


    var accion = document.getElementById("btnGua").value;

    var regExp2 = /[a-zA-Z]+/;

    var infoGE = "medicamento="+medicamento+"&empaque="+empaque+"&administracion="+administracion+"&stock="+stock+"&vencimiento="+vencimiento+"&accion="+accion;
    var op=0;

    if(medicamento==null||medicamento==''||!regExp2.test(medicamento)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El medicamento es obligatorio y no debe contener numeros',
        })
        op=1;
    }

    if(empaque==null||empaque==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El empaque del medicamento es obligatorio y no debe contener numeros',
        })
        op=1;
    }

    if(administracion==null||administracion==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El tipo de administracion del medicamento es obligatorio y no debe contener numeros',
        })
        op=1;
    }

    if(stock==null||stock==''||stock<0){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El stock del alimento es obligatorio y no debe contener numeros',
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
            url: '../Controladores/ControladorMedicamento.php',
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
                    location.href="../Vistas/VistaMedicamentos.php?tbl=normal&info=&pagina=1";
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



function editar_medicamento(){
    
    var id = document.getElementById("ModtxtId").innerHTML;

    var medicamento = document.getElementById("ModtxtMedicamento").value;
    var empaque = document.getElementById("ModtxtEmpaque").value;
    var administracion = document.getElementById("ModtxtAdministracion").value;
    var stock = document.getElementById("ModtxtStock").value;
    var vencimiento = document.getElementById("ModtxtVencimiento").value;


    var accion = document.getElementById("btnEdit").value;

    var regExp2 = /[a-zA-Z]+/;

    var infoME = "medicamento="+medicamento+"&empaque="+empaque+"&administracion="+administracion+"&stock="+stock+"&vencimiento="+vencimiento+"&accion="+accion+"&id="+id;
    var op=0;

    if(medicamento==null||medicamento==''||!regExp2.test(medicamento)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El medicamento es obligatorio y no debe contener numeros',
        })
        op=1;
    }

    if(empaque==null||empaque==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El empaque del medicamento es obligatorio y no debe contener numeros',
        })
        op=1;
    }

    if(administracion==null||administracion==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El tipo de administracion del medicamento es obligatorio y no debe contener numeros',
        })
        op=1;
    }

    if(stock==null||stock==''||stock<0){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El stock del alimento es obligatorio y no debe contener numeros',
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
            url: '../Controladores/ControladorMedicamento.php',
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
                    location.href="../Vistas/VistaMedicamentos.php?tbl=normal&info=&pagina=1";
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




function eliminar_medicamento(id){

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
                url: '../Controladores/ControladorMedicamento.php',
                type: 'POST',
                data: infoELE,
            })
            .done(function(respuesta){
                
                if(respuesta==1){
                    
                    
                    setTimeout(function(){
                        location.href="../Vistas/VistaMedicamentos.php?tbl=normal&info=&pagina=1";
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


function reactivar_medicamento(id){

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
                url: '../Controladores/ControladorMedicamento.php',
                type: 'POST',
                data: infoELE,
            })
            .done(function(respuesta){
                
                if(respuesta==1){
                    
                    
                    setTimeout(function(){
                        location.href="../Vistas/VistaMedicamentosEli.php?tbl=normal&info=&pagina=1";
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







function buscar_medicamento(){

    var buscar = document.getElementById("txtBuscar").value;

    location.href="VistaMedicamentos.php?tbl=busqueda&info="+buscar+"&pagina=1";
  
}


function buscar_medicamentoEli(){

    var buscar = document.getElementById("txtBuscar").value;
    var regExp2 = /[a-zA-Z]+/;


    location.href="VistaMedicamentosEli.php?tbl=busqueda&info="+buscar+"&pagina=1";
  
}


function buscar_audi_medicamento(){

    var buscar = document.getElementById("txtBuscar").value;
    var regExp2 = /[a-zA-Z]+/;


    location.href="VistaAuditoriaMedicamentos.php?tbl=busqueda&info="+buscar+"&pagina=1";
  
}



function ReporteAuditoria(){
    top.location.href="../Reportes/ReporteAuditoriaMedicamentos.php";
}


