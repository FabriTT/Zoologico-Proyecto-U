var contador =0;
function Maximizar(){
    if(contador%2==0){
        document.getElementById("iframeDashboard").style.height='733px';
        contador++;
    }else{
        document.getElementById("iframeDashboard").style.height='616px';
        contador++;
    }
    

}


function Empleados(){
    
    var url = "../VistaEmpleados.php?tbl=normal&info=&pagina=1";
    document.getElementById("iframeDashboard").src=url;

}

function EmpleadosEli(){
    
    var url = "../VistaEmpleadosEli.php?tbl=normal&info=&pagina=1";
    document.getElementById("iframeDashboard").src=url;

}


function Habitats(){
    
    var url = "../VistaHabitats.php?tbl=normal&info=&pagina=1";
    document.getElementById("iframeDashboard").src=url;

}

function HabitatsEli(){
    
    var url = "../VistaHabitatsEli.php?tbl=normal&info=&pagina=1";
    document.getElementById("iframeDashboard").src=url;

}

function Animales(){
    
    var url = "../VistaAnimales.php?tbl=normal&info=&pagina=1";
    document.getElementById("iframeDashboard").src=url;

}

function AnimalesEli(){
    
    var url = "../VistaAnimalesEli.php?tbl=normal&info=&pagina=1";
    document.getElementById("iframeDashboard").src=url;

}


function Alimentos(){
    
    var url = "../VistaAlimentos.php?tbl=normal&info=&pagina=1";
    document.getElementById("iframeDashboard").src=url;

}

function AlimentosEli(){
    
    var url = "../VistaAlimentosEli.php?tbl=normal&info=&pagina=1";
    document.getElementById("iframeDashboard").src=url;

}


function Medicamentos(){
    
    var url = "../VistaMedicamentos.php?tbl=normal&info=&pagina=1";
    document.getElementById("iframeDashboard").src=url;

}

function MedicamentosEli(){
    
    var url = "../VistaMedicamentosEli.php?tbl=normal&info=&pagina=1";
    document.getElementById("iframeDashboard").src=url;

}


function HistorialesAlimenticios(){
    
    var url = "../VistaHistorialesAlimenticios.php?tbl=normal&info=&pagina=1";
    document.getElementById("iframeDashboard").src=url;

}

function HistorialesAlimenticiosEli(){
    
    var url = "../VistaHistorialesAlimenticiosEli.php?tbl=normal&info=&pagina=1";
    document.getElementById("iframeDashboard").src=url;

}

function HistorialesMedicos(){
    
    var url = "../VistaHistorialesMedicos.php?tbl=normal&info=&pagina=1";
    document.getElementById("iframeDashboard").src=url;

}

function HistorialesMedicosEli(){
    
    var url = "../VistaHistorialesMedicosEli.php?tbl=normal&info=&pagina=1";
    document.getElementById("iframeDashboard").src=url;

}


function Planificaciones(){
    
    var url = "../VistaPlanificaciones.php?tbl=normal&info=&pagina=1";
    document.getElementById("iframeDashboard").src=url;

}

function PlanificacionesEli(){
    
    var url = "../VistaPlanificacionesEli.php?tbl=normal&info=&pagina=1";
    document.getElementById("iframeDashboard").src=url;

}

function Graficas(){
    
    var url = "../VistaGraficas.php";
    document.getElementById("iframeDashboard").src=url;

}

function AuditoriaEmpleados(){
    
    var url = "../VistaAuditoriaEmpleados.php?tbl=normal&info=&pagina=1";
    document.getElementById("iframeDashboard").src=url;

}

function AuditoriaHabitats(){
    
    var url = "../VistaAuditoriaHabitats.php?tbl=normal&info=&pagina=1";
    document.getElementById("iframeDashboard").src=url;

}

function AuditoriaAnimales(){
    
    var url = "../VistaAuditoriaAnimales.php?tbl=normal&info=&pagina=1";
    document.getElementById("iframeDashboard").src=url;

}

function AuditoriaAlimentos(){
    
    var url = "../VistaAuditoriaAlimentos.php?tbl=normal&info=&pagina=1";
    document.getElementById("iframeDashboard").src=url;

}

function AuditoriaMedicamentos(){
    
    var url = "../VistaAuditoriaMedicamentos.php?tbl=normal&info=&pagina=1";
    document.getElementById("iframeDashboard").src=url;

}

function AuditoriaHistorialesAlimenticios(){
    
    var url = "../VistaAuditoriaHistorialesAlimenticios.php?tbl=normal&info=&pagina=1";
    document.getElementById("iframeDashboard").src=url;

}

function AuditoriaHistorialesMedicos(){
    
    var url = "../VistaAuditoriaHistorialesMedicos.php?tbl=normal&info=&pagina=1";
    document.getElementById("iframeDashboard").src=url;

}

function AuditoriaPlanificaciones(){
    
    var url = "../VistaAuditoriaPlanificaciones.php?tbl=normal&info=&pagina=1";
    document.getElementById("iframeDashboard").src=url;

}

function GenerarBackup(){
    var info = "";

    $.ajax({
        url: '../../Respaldos/Backup.php',
        type: 'POST',
        data: info,
    })
    .done(function(respuesta){
        if(respuesta==1){
            Swal.fire({
                icon: 'success',
                title: 'Correcto',
                text: 'El respaldo se genero exitosamente',
            })  
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Surgio un error:' + respuesta,
            })
        }
        
    });  
     

}



var cadena = document.getElementById("OcultoCargo").value;
var botonEmpleados = document.getElementById("btnEmpleado");
var botonHabitats = document.getElementById("btnHabitats");
var botonAnimales = document.getElementById("btnAnimales");
var botonHalimentos = document.getElementById("btnHalimentos");
var botonHmedicamentos = document.getElementById("btnHmedicamentos");
var botonAlimentos = document.getElementById("btnAlimentos");
var botonMedicamentos = document.getElementById("btnMedicamentos");
var botonVentas = document.getElementById("btnVentas");
var botonSeguridad = document.getElementById("btnSeguridad");
var botonBackup = document.getElementById("btnBackup");



if(cadena=='ALM'){
    botonEmpleados.disabled=true;
    botonHabitats.disabled=true;
    botonAnimales.disabled=true;
    botonHalimentos.disabled=true;
    botonHmedicamentos.disabled=true;
    botonVentas.disabled=true;
    botonSeguridad.disabled=true;
    botonAlimentos.disabled=false;
    botonMedicamentos.disabled=false;
    botonBackup.type=hidden;
    botonBackup.style.display='none';
    

}else if(cadena=='ANIM'){
    botonEmpleados.disabled=true;
    botonHabitats.disabled=false;
    botonAnimales.disabled=false;
    botonHalimentos.disabled=true;
    botonHmedicamentos.disabled=true;
    botonVentas.disabled=true;
    botonSeguridad.disabled=true;
    botonAlimentos.disabled=true;
    botonMedicamentos.disabled=true;
    botonBackup.style.display='none';

}else if(cadena=='ETH'){
    botonEmpleados.disabled=true;
    botonHabitats.disabled=true;
    botonAnimales.disabled=true;
    botonHalimentos.disabled=true;
    botonHmedicamentos.disabled=true;
    botonVentas.disabled=true;
    botonSeguridad.disabled=false;
    botonAlimentos.disabled=true;
    botonMedicamentos.disabled=true;
    

}else if(cadena=='RRHH'){
    botonEmpleados.disabled=false;
    botonHabitats.disabled=true;
    botonAnimales.disabled=true;
    botonHalimentos.disabled=true;
    botonHmedicamentos.disabled=true;
    botonVentas.disabled=true;
    botonSeguridad.disabled=true;
    botonAlimentos.disabled=true;
    botonMedicamentos.disabled=true;
    botonBackup.style.display='none';
    
}else if(cadena=='VEN'){
    botonEmpleados.disabled=true;
    botonHabitats.disabled=true;
    botonAnimales.disabled=true;
    botonHalimentos.disabled=true;
    botonHmedicamentos.disabled=true;
    botonVentas.disabled=false;
    botonSeguridad.disabled=true;
    botonAlimentos.disabled=true;
    botonMedicamentos.disabled=true;
    botonBackup.style.display='none';
}else if(cadena=='VET'){
    botonEmpleados.disabled=true;
    botonHabitats.disabled=true;
    botonAnimales.disabled=true;
    botonHalimentos.disabled=false;
    botonHmedicamentos.disabled=false;
    botonVentas.disabled=true;
    botonSeguridad.disabled=true;
    botonAlimentos.disabled=true;
    botonMedicamentos.disabled=true;
    botonBackup.style.display='none';
}