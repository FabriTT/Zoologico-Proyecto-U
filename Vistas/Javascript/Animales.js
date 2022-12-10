function sel_animal(dataAnimal){
    e=dataAnimal.split('||');

   document.getElementById("ModtxtId").innerHTML=e[0];
   $("#ModtxtAnimal").val(e[1]);
   $("#ModtxtNombreC").val(e[2]);
   $("#ModtxtEspecie").val(e[3]);
   $("#ModtxtApodo").val(e[4]);
   document.getElementById("ModtxtHabitat").value=e[9];
   document.getElementById("ModtxtHabitat").text=e[5]; 
   $("#ModtxtClasificacion").val(e[6]);
   $("#ModtxtAlimentacion").val(e[7]);
   $("#ModtxtNacimiento").val(e[8]);


}


function guardar_animal(){
    var animal = document.getElementById("txtAnimal").value;
    var nombreC = document.getElementById("txtNombreC").value;
    var especie = document.getElementById("txtEspecie").value;
    var apodo = document.getElementById("txtApodo").value;
    var habitat = document.getElementById("txtHabitat").value;
    var clasificacion = document.getElementById("txtClasificacion").value;
    var alimentacion = document.getElementById("txtAlimentacion").value;
    var nacimiento = document.getElementById("txtNacimiento").value;
    var imagen = document.getElementById("txtImagen").value;
    try {
        var imagen = document.getElementById("txtImagen").files[0]['name'];    
    } catch (error) {
        
    }

    var accion = document.getElementById("btnGua").value;

    var regExp2 = /[a-zA-Z]+/;

    


    var infoGE = "animal="+animal+"&nombreC="+nombreC+"&especie="+especie+"&apodo="+apodo+"&habitat="+habitat+"&clasificacion="+clasificacion+"&alimentacion="+alimentacion+"&nacimiento="+nacimiento+"&imagen="+imagen+"&accion="+accion;
    var op=0;

    if(animal==null||animal==''||!regExp2.test(animal)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El el animal es obligatorio y no debe contener numeros',
        })
        op=1;
    }
    if(nombreC==null||nombreC==''||!regExp2.test(nombreC)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El nombre cientifico del animal es obligatorio y no debe contener numeros',
        })
        op=1;
    }

    if(especie==null||especie==''||!regExp2.test(especie)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'La especie del animal es obligatorio y no debe contener numeros',
        })
        op=1;
    }

    if(apodo==null||apodo==''||!regExp2.test(apodo)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El apodo del animal es obligatorio y no debe contener numeros',
        })
        op=1;
    }

    if(habitat==null||habitat==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El habitat es obligatorio y no debe contener numeros',
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

    if(alimentacion==null||alimentacion==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El tipo de alimentacion es obligatoria y no debe contener numeros',
        })
        op=1;
    }

    if(imagen==''||imagen==null){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'La imagen del animal es obligatoria',
        })
        op=1;
        
    }

    
    if(op==0){
        $.ajax({
            url: '../Controladores/ControladorAnimal.php',
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
                    location.href="../Vistas/VistaAnimales.php?tbl=normal&info=&pagina=1";
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



function editar_animal(){
    
    var animal = document.getElementById("ModtxtAnimal").value;
    var nombreC = document.getElementById("ModtxtNombreC").value;
    var especie = document.getElementById("ModtxtEspecie").value;
    var apodo = document.getElementById("ModtxtApodo").value;
    var habitat = document.getElementById("ModtxtHabitat").value;
    var clasificacion = document.getElementById("ModtxtClasificacion").value;
    var alimentacion = document.getElementById("ModtxtAlimentacion").value;
    var nacimiento = document.getElementById("ModtxtNacimiento").value;
    var accion = document.getElementById("btnEdit").value;
    var imagen = document.getElementById("ModtxtImagen").value;
    try {
        var imagen = document.getElementById("ModtxtImagen").files[0]['name'];    
    } catch (error) {
        
    }

    var id = document.getElementById("ModtxtId").innerHTML;
    var regExp2 = /[a-zA-Z]+/;

    


    
    var op=0;

    if(animal==null||animal==''||!regExp2.test(animal)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El el animal es obligatorio y no debe contener numeros',
        })
        op=1;
    }
    if(nombreC==null||nombreC==''||!regExp2.test(nombreC)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El nombre cientifico del animal es obligatorio y no debe contener numeros',
        })
        op=1;
    }

    if(especie==null||especie==''||!regExp2.test(especie)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'La especie del animal es obligatorio y no debe contener numeros',
        })
        op=1;
    }

    if(apodo==null||apodo==''||!regExp2.test(apodo)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El apodo del animal es obligatorio y no debe contener numeros',
        })
        op=1;
    }

    if(habitat==null||habitat==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El habitat es obligatorio y no debe contener numeros',
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

    if(alimentacion==null||alimentacion==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El tipo de alimentacion es obligatoria y no debe contener numeros',
        })
        op=1;
    }

    if(imagen==null||imagen==''){
        op=0;
        var infoME =  "animal="+animal+"&nombreC="+nombreC+"&especie="+especie+"&apodo="+apodo+"&habitat="+habitat+"&clasificacion="+clasificacion+"&alimentacion="+alimentacion+"&nacimiento="+nacimiento+"&accion="+"btnModificar"+"&id="+id;
    }else{
        op=2;
        var infoME =  "animal="+animal+"&nombreC="+nombreC+"&especie="+especie+"&apodo="+apodo+"&habitat="+habitat+"&clasificacion="+clasificacion+"&alimentacion="+alimentacion+"&nacimiento="+nacimiento+"&imagen="+imagen+"&accion="+"btnModificarImg"+"&id="+id;
    }
    


    if(op==0){
        $.ajax({
            url: '../Controladores/ControladorAnimal.php',
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
                    location.href="../Vistas/VistaAnimales.php?tbl=normal&info=&pagina=1";
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
            url: '../Controladores/ControladorAnimal.php',
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
                    location.href="../Vistas/VistaAnimales.php?tbl=normal&info=&pagina=1";
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




function eliminar_animal(id){

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
                url: '../Controladores/ControladorAnimal.php',
                type: 'POST',
                data: infoELE,
            })
            .done(function(respuesta){
                
                if(respuesta==1){
                    
                    
                    setTimeout(function(){
                        location.href="../Vistas/VistaAnimales.php?tbl=normal&info=&pagina=1";
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


function reactivar_animal(id){

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
                url: '../Controladores/ControladorAnimal.php',
                type: 'POST',
                data: infoELE,
            })
            .done(function(respuesta){
                
                if(respuesta==1){
                    
                    
                    setTimeout(function(){
                        location.href="../Vistas/VistaAnimalesEli.php?tbl=normal&info=&pagina=1";
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







function buscar_animal(){

    var buscar = document.getElementById("txtBuscar").value;

    location.href="VistaAnimales.php?tbl=busqueda&info="+buscar+"&pagina=1";
  
}


function buscar_animalEli(){

    var buscar = document.getElementById("txtBuscar").value;
    var regExp2 = /[a-zA-Z]+/;


    location.href="VistaAnimalesEli.php?tbl=busqueda&info="+buscar+"&pagina=1";
  
}

function buscar_audi_animal(){

    var buscar = document.getElementById("txtBuscar").value;
    var regExp2 = /[a-zA-Z]+/;


    location.href="VistaAuditoriaAnimales.php?tbl=busqueda&info="+buscar+"&pagina=1";
  
}



function ReporteAuditoria(){
    top.location.href="../Reportes/ReporteAuditoriaAnimales.php";
}

function reporte_medico(id){
    top.location.href="../Reportes/ReporteHistorialAnimal.php?id="+id;
}
