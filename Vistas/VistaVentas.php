<?php 
    include_once '../Controladores/ControladorVentas.php';


    $tabla=(isset($_GET['tbl']))?$_GET['tbl']:"";
    $buscar=(isset($_GET['info']))?$_GET['info']:"";
    $plan=(isset($_GET['plan']))?$_GET['plan']:"";
    $total=(isset($_GET['total']))?$_GET['total']:"";

    $iniciar=($_GET['pagina']-1)*4;

   $fechaActual = date("Y")."-".date("m")."-".date("d");


    switch($tabla){
        case 'normal':
            $datosVentas = MostrarVenta($iniciar,4,$plan);
            $paginas = ceil(ContarVenta($plan)/4);
        break;
        case 'busqueda':
            $datosVentas = BuscarVenta($buscar,$iniciar,4,$plan);
            $paginas = ceil(ContarVentaB($buscar,$plan)/4);
        break;
    }
    
    
    
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/tablas.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


</head>

<body>
    


    <div class="row">
        <center><h2>TABLA DE VENTAS</h2></center>
    </div>
    

    <table class="xmargin">
        <tr>
            <td><label class="lb ">Buscar por fecha:</label></td>
            <td><input type="date" class="form-control txt" placeholder="NOMBRE" id="txtBuscar" value="" maxlength="100"></td>
            <td><button type="button" class="btn_insert btn-ligth " id="btnBuscar" onclick="buscar_venta('<?php echo $plan ?>','<?php echo $total ?>')"><i class="fa-solid fa-magnifying-glass"></i></td>
            <td width="1050px">
               
            </td>
            <td><button type="button" class="btn_insert btn-success "  onclick="insertar_venta('<?php echo $plan ?>')"><i class="fa-solid fa-plus"></i></button></td>
        </tr>
    </table>
    
    <hr>


    <table>
        <tr>
            <td width="50px">

            </td>
            <td>
                <table class="tabla">
                <thead>
                    <tr class="tr_x">
                        <th class="th_x" colspan="3" >CANT. ENTRADAS MENORES</th>
                        <th class="th_x" colspan="3" >CANT. ENTRADAS MAYORES</th>
                        <th class="th_x" colspan="3" >CANT. ENTRADAS ADULTOS MAYORES</th>
                        <th class="th_x">TOTAL VENDIDO</th>
                        <th class="th_x">TOTAL PLANIFICADO</th>
                        <th class="th_x">FECHA</th>

                    </tr>
                </thead>
                <?php foreach ($datosVentas as $venta ){
                    ?>
                    <tr class="tr_x">
                        <td class="td_x"><button type="button" class="btn btn-danger btn_img" onclick="restar_entrada('<?php echo $venta['reg_fecha'] ?>','<?php echo $fechaActual ?>','<?php echo $venta['reg_cantidad_EMenores'] ?>','<?php echo $plan ?>','<?php echo $venta['reg_id'] ?>','Rmenor','<?php echo $total ?>','<?php echo $_GET['pagina'] ?>')"><i class="fa-solid fa-minus"></i></button> </td>
                        <td class="td_x"><?php echo $venta['reg_cantidad_EMenores']; ?></td>
                        <td class="td_x"><button type="button" class="btn btn-success btn_img" onclick="sumar_entrada('<?php echo $venta['reg_fecha'] ?>','<?php echo $fechaActual ?>','<?php echo $venta['total'] ?>','<?php echo $total ?>','<?php echo $plan ?>','<?php echo $venta['reg_id'] ?>','Smenor','<?php echo $_GET['pagina'] ?>')" ><i class="fa-solid fa-plus"></i></button> </td>
                        <td class="td_x"><button type="button" class="btn btn-danger btn_img" onclick="restar_entrada('<?php echo $venta['reg_fecha'] ?>','<?php echo $fechaActual ?>','<?php echo $venta['reg_cantidad_EMayores'] ?>','<?php echo $plan ?>','<?php echo $venta['reg_id'] ?>','Rmayor','<?php echo $total ?>','<?php echo $_GET['pagina'] ?>')"><i class="fa-solid fa-minus"></i></button> </td>
                        <td class="td_x"><?php echo $venta['reg_cantidad_EMayores']; ?></td>
                        <td class="td_x"><button type="button" class="btn btn-success btn_img"  onclick="sumar_entrada('<?php echo $venta['reg_fecha'] ?>','<?php echo $fechaActual ?>','<?php echo $venta['total'] ?>','<?php echo $total ?>','<?php echo $plan ?>','<?php echo $venta['reg_id'] ?>','Smayor','<?php echo $_GET['pagina'] ?>')"><i class="fa-solid fa-plus"></i></button> </td>
                        <td class="td_x"><button type="button" class="btn btn-danger btn_img"  onclick="restar_entrada('<?php echo $venta['reg_fecha'] ?>','<?php echo $fechaActual ?>','<?php echo $venta['reg_cantidad_EAMayores'] ?>','<?php echo $plan ?>','<?php echo $venta['reg_id'] ?>','RAmayor','<?php echo $total ?>','<?php echo $_GET['pagina'] ?>')"><i class="fa-solid fa-minus"></i></button> </td>
                        <td class="td_x"><?php echo $venta['reg_cantidad_EAMayores']; ?></td>
                        <td class="td_x"><button type="button" class="btn btn-success btn_img"  onclick="sumar_entrada('<?php echo $venta['reg_fecha'] ?>','<?php echo $fechaActual ?>','<?php echo $venta['total'] ?>','<?php echo $total ?>','<?php echo $plan ?>','<?php echo $venta['reg_id'] ?>','SAmayor','<?php echo $_GET['pagina'] ?>')"><i class="fa-solid fa-plus"></i></button> </td>
                        <td class="td_x"><?php echo $venta['total']; ?></td>
                        <td class="td_x"><?php echo $total; ?></td>
                        <td class="td_x"><?php echo $venta['reg_fecha']; ?></td>

                    </tr>

                <?php } ?>
                </table>
            </td>
            <td width="50px">
                
            </td>
        </tr>
    </table>
    

    <hr>

    <table class="xmargin">
        <tr>

            <td>
                <nav aria-label="Page navigation example ">
                    <ul class="pagination">
                        <li class="page-item <?php echo $_GET['pagina']<= 1 ? 'disabled' : ''?>"><a class="page-link" href="VistaVentas.php?tbl=<?php echo $tabla."&info=".$buscar."&pagina=".($_GET['pagina']-1)."&plan=".$plan."&total=".$total?>">Anterior</a></li>

                        <?php for($i=0;$i<$paginas;$i++): ?>
                        <li class="page-item <?php echo $_GET['pagina']== $i+1 ? 'active' : ''?>"><a class=" page-link" href="VistaVentas.php?tbl=<?php echo $tabla."&info=".$buscar."&pagina=".($i+1)."&plan=".$plan."&total=".$total?>"> <?php echo $i+1?> </a></li>
                        <?php endfor ?>

                        <li class="page-item <?php echo $_GET['pagina']>= $paginas ? 'disabled' : ''?>"><a class=" page-link" href="VistaVentas.php?tbl=<?php echo $tabla."&info=".$buscar."&pagina=".($_GET['pagina']+1)."&plan=".$plan."&total=".$total?>">Siguiente</a></li>
                    </ul>
                </nav>
            </td>
        </tr>
    </table>
   

<br>
<br>



   
    
    
    <!--bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <!--font awesome-->
    <script src="https://kit.fontawesome.com/aafb2c5e00.js" crossorigin="anonymous"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    


    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

    <script src="Javascript/Ventas.js"></script>
</body>

</html>