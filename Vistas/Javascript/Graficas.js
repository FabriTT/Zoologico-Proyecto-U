
var chart;
var contador=0;

var chart2;
var contador2=0;

function generar(){

    var inicio = document.getElementById("txtInicio").value;
    var fin = document.getElementById("txtFin").value;

    var accion = document.getElementById("accionVenta").value;

    var info = "inicio="+inicio+"&fin="+fin+"&accion="+accion;
    
    var op=0;

    if(inicio==null||inicio==''){
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'La fecha de inicio es obligatorio y no debe contener numeros',
        })
        op=1;
    }

    if(fin==null||fin==''){
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'La fecha de fin es obligatorio y no debe contener numeros',
        })
        op=1;
    }

    if(op==0){

        $.ajax({
            url: '../Controladores/ControladorPlanificacion.php',
            type: 'POST',
            data: info,
        })
        .done(function(respuesta){
            var fecha=[];
            var total =[];
            console.log(respuesta);
            console.log(inicio);
            console.log(fin);
            var data = JSON.parse(respuesta);
            data.forEach(function(x){
                fecha.push(x['fecha'])
                total.push(x['total'])
            });



            crearGrafica(fecha,total,'Total vendido')

            
            
        });



    }
   
}



function crearGrafica(etiquetas,datos,titulo){
    
    var ctx = document.getElementById('myChart');
    if(contador>=1){
        chart.destroy();
    }
    contador++;
    chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: etiquetas,
            datasets: [{
                label: titulo,
                data: datos,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    
    
}







