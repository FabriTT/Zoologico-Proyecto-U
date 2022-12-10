<?php 
    include_once '../Controladores/ControladorHabitat.php';

    $tabla=(isset($_GET['tbl']))?$_GET['tbl']:"";
    $buscar=(isset($_GET['info']))?$_GET['info']:"";

    $iniciar=($_GET['pagina']-1)*3;

    switch($tabla){
        case 'normal':
            $datosHabitats = MostrarAuditoriaHabitat($iniciar,3);
            $paginas = ceil(ContarAuditoriaHabitat()/3);
        break;
        case 'busqueda':
            $datosHabitats = BuscarAuditoriaHabitat($buscar,$iniciar,3);
            $paginas = ceil(ContarAuditoriaHabitatB($buscar)/3);
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
        <center><h2>TABLA DE AUDITORIA DE HABITATS</h2></center>
    </div>
    

    <table class="xmargin">
        <tr>
            <td><label class="lb ">Buscar por nombre:</label></td>
            <td><input type="text" class="form-control txt" placeholder="NOMBRE" id="txtBuscar" value="" maxlength="100"></td>
            <td><button type="button" class="btn_insert btn-ligth " id="btnBuscar" onclick="buscar_audi_habitat()"> <i class="fa-solid fa-magnifying-glass"></i></td>
            <td width="1050px">
               
            </td>
            <td><button type="button" class="btn_insert btn-ligth " onclick="ReporteAuditoria()"><i class="fa-solid fa-file-pdf"></i></button></td>
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
                        <th class="th_x">FECHA</th>
                        <th class="th_x">NOMBRE</th>
                        <th class="th_x">ANIMAL</th>
                        <th class="th_x">CLASIFICACION</th>
                        <th class="th_x">CAPACIDAD</th>
                        <th class="th_x">HORARIO DE LIMPIEZA</th>
                        <th class="th_x">HORARIO DE ALIMENTACION</th>
                        <th class="th_x">USUARIO</th>
                        <th class="th_x">ACCION</th>
                    </tr>
                </thead>
                <?php foreach ($datosHabitats as $habitat ){?>
                    <tr class="tr_x">
                        <td class="td_x"><?php echo $habitat['audi_fecha']; ?></td>
                        <td class="td_x"><?php echo $habitat['audi_hab_nombre']; ?></td>
                        <td class="td_x"><?php echo $habitat['audi_hab_nombreA']; ?></td>
                        <td class="td_x"><?php echo $habitat['audi_hab_clasificacionAmbiente']; ?></td>
                        <td class="td_x"><?php echo $habitat['audi_hab_capacidad']; ?></td>
                        <td class="td_x"><?php echo $habitat['audi_hab_horarioLimpieza']; ?></td>
                        <td class="td_x"><?php echo $habitat['audi_hab_horarioAlimentacion']; ?></td>
                        <td class="td_x"><?php echo $habitat['audi_usuario']; ?></td>
                        <td class="td_x"><?php echo $habitat['audi_accion']; ?></td>

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
                        <li class="page-item <?php echo $_GET['pagina']<= 1 ? 'disabled' : ''?>"><a class="page-link" href="VistaAuditoriaHabitats.php?tbl=<?php echo $tabla."&info=".$buscar."&pagina=".$_GET['pagina']-1?>">Anterior</a></li>

                        <?php for($i=0;$i<$paginas;$i++): ?>
                        <li class="page-item <?php echo $_GET['pagina']== $i+1 ? 'active' : ''?>"><a class=" page-link" href="VistaAuditoriaHabitats.php?tbl=<?php echo $tabla."&info=".$buscar."&pagina=".$i+1?>"> <?php echo $i+1?> </a></li>
                        <?php endfor ?>

                        <li class="page-item <?php echo $_GET['pagina']>= $paginas ? 'disabled' : ''?>"><a class=" page-link" href="VistaAuditoriaHabitats.php?tbl=<?php echo $tabla."&info=".$buscar."&pagina=".$_GET['pagina']+1?>">Siguiente</a></li>
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

    <script src="Javascript/Habitats.js"></script>
</body>

</html>