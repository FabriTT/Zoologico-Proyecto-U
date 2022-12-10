


function insertar_venta(id,total){


    var info = "accion=Insertar"+"&plan="+id;
   
    Swal.fire({
        title: 'Estas seguro de crea un nueva venta? al crear la venta la planificacion ya no se podra eliminar ni modificar y la venta solo se podra modificar dentro de 24 horas',
        showDenyButton: true,
        confirmButtonText: 'Aceptar',
        denyButtonText: `Cancelar`,
      }).then((result) => {
        if (result.isConfirmed) {
           
            $.ajax({
                url: '../Controladores/ControladorVentas.php',
                type: 'POST',
                data: info,
            })
            .done(function(respuesta){

                if(respuesta==1){
                    

                    setTimeout(function(){
                        location.href="../Vistas/VistaVentas.php?tbl=normal&info=&pagina=1&plan="+id+"&total="+total;
                    },2500);  
                        
      
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Surgio un error:' + respuesta,
                    })
                }
                
                
            });

          Swal.fire('Creado', '', 'success')
        } else if (result.isDenied) {
          Swal.fire('Cancelado', '', 'info')
        }
      })

}








function sumar_entrada(fecha,Afecha,total,ptotal,plan,id,accion,pagina){


    var info = "accion="+accion+"&venta="+id;
   
    console.log(fecha+"  "+Afecha+"  "+(parseInt(total)+1)+"  "+ptotal+"  "+plan+"  "+id+"  "+accion+"  "+pagina+"  ");

    if(fecha<Afecha){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'Ya no puede modificar el registro despues de la fecha: '+fecha,
        })
    }else{
        if((parseInt(total)+1)>ptotal){
            Swal.fire({
                icon: 'warning',
                title: 'Sugerencia',
                text: 'Limite alcanzado de entradas planificadas',
            })
        }else{
            
            $.ajax({
                url: '../Controladores/ControladorVentas.php',
                type: 'POST',
                data: info,
            })
            .done(function(respuesta){

                if(respuesta==1){
                    

                    setTimeout(function(){
                        location.href="../Vistas/VistaVentas.php?tbl=normal&info=&pagina="+pagina+"&plan="+plan+"&total="+ptotal;
                    },500);  
                        
      
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
       
}




function restar_entrada(fecha,Afecha,cantidad,plan,id,accion,total,pagina){


    var info = "accion="+accion+"&venta="+id;
   
    console.log(info);

    if(fecha<Afecha){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'Ya no puede modificar el registro despues de la fecha: '+fecha,
        })
    }else{
        if((cantidad-1)<0){
            Swal.fire({
                icon: 'warning',
                title: 'Sugerencia',
                text: 'No puedes restar mas entradas',
            })
        }else{
            
            $.ajax({
                url: '../Controladores/ControladorVentas.php',
                type: 'POST',
                data: info,
            })
            .done(function(respuesta){

                if(respuesta==1){
                    

                    setTimeout(function(){
                        location.href="../Vistas/VistaVentas.php?tbl=normal&info=&pagina="+pagina+"&plan="+plan+"&total="+total;
                    },500);  
                        
      
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
       
}




function buscar_venta(plan,total){

    var buscar = document.getElementById("txtBuscar").value;

    location.href="VistaVentas.php?tbl=busqueda&info="+buscar+"&pagina=1&plan="+plan+"&total="+total;
  
}









