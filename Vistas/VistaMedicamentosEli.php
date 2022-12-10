<?php 
    include_once '../Controladores/ControladorMedicamento.php';

    $tabla=(isset($_GET['tbl']))?$_GET['tbl']:"";
    $buscar=(isset($_GET['info']))?$_GET['info']:"";

    $iniciar=($_GET['pagina']-1)*4;

   $fechaActual = date("Y")."-".date("m")."-".date("d");
   $datosEmpaques = MostrarEmpaques();

    switch($tabla){
        case 'normal':
            $datosMedicamentos = MostrarMedicamentos($iniciar,4,0);
            $paginas = ceil(ContarMedicamento(0)/4);
        break;
        case 'busqueda':
            $datosMedicamentos = BuscarMedicamentos($buscar,$iniciar,4,0);
            $paginas = ceil(ContarMedicamentoB($buscar,0)/4);
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
        <center><h2>TABLA DE MEDICAMENTOS</h2></center>
    </div>
    

    <table class="xmargin">
        <tr>
            <td><label class="lb ">Buscar por medicamento:</label></td>
            <td><input type="text" class="form-control txt" placeholder="NOMBRE" id="txtBuscar" value="" maxlength="100"></td>
            <td><button type="button" class="btn_insert btn-ligth " id="btnBuscar" onclick="buscar_medicamentoEli()"><i class="fa-solid fa-magnifying-glass"></i></td>
            <td width="1050px">
               
            </td>
            <td></td>
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
                        <th class="th_x">MEDICAMENTO</th>
                        <th class="th_x">EMPAQUE</th>
                        <th class="th_x">ADMINISTRACION</th>
                        <th class="th_x">STOCK</th>
                        <th class="th_x">VENCIMIENTO</th>
                        <th class="th_x" colspan="2">ACCIONES</th>
                    </tr>
                </thead>
                <?php foreach ($datosMedicamentos as $medicamento ){
                    $dataMedicamentos=$medicamento['med_id']."||".$medicamento['med_nombre']."||".$medicamento['PaqM_id']."||".$medicamento['PaqM_nombre']."||".$medicamento['med_tipoAdministracion']."||".$medicamento['med_stock']."||".$medicamento['med_fechaVencimiento']?>
                    <tr class="tr_x" style="background: <?php echo $medicamento['med_fechaVencimiento'] <= $fechaActual ? 'red' : ''?>  ">
                        <td class="td_x" ><?php echo $medicamento['med_nombre']; ?></td>
                        <td class="td_x"><?php echo $medicamento['PaqM_nombre']; ?></td>
                        <td class="td_x"><?php echo $medicamento['med_tipoAdministracion']; ?></td>
                        <td class="td_x"><?php echo $medicamento['med_stock']; ?></td>
                        <td class="td_x"><?php echo $medicamento['med_fechaVencimiento']; ?></td>
                        <td class="td_btn"> 

                            <form action="" method="post">


                                
                                <button type="button" class="btn btn-light" id='btnEli' value="btnReactivar" onclick="reactivar_medicamento('<?php echo $medicamento['med_id'] ?>')" ><i class="fa-solid fa-arrows-rotate"></i></button> 
                        
                            </form>

                            

                        </td>
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
                        <li class="page-item <?php echo $_GET['pagina']<= 1 ? 'disabled' : ''?>"><a class="page-link" href="VistaMedicamentosEli.php?tbl=<?php echo $tabla."&info=".$buscar."&pagina=".$_GET['pagina']-1?>">Anterior</a></li>

                        <?php for($i=0;$i<$paginas;$i++): ?>
                        <li class="page-item <?php echo $_GET['pagina']== $i+1 ? 'active' : ''?>"><a class=" page-link" href="VistaMedicamentosEli.php?tbl=<?php echo $tabla."&info=".$buscar."&pagina=".$i+1?>"> <?php echo $i+1?> </a></li>
                        <?php endfor ?>

                        <li class="page-item <?php echo $_GET['pagina']>= $paginas ? 'disabled' : ''?>"><a class=" page-link" href="VistaMedicamentosEli.php?tbl=<?php echo $tabla."&info=".$buscar."&pagina=".$_GET['pagina']+1?>">Siguiente</a></li>
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

    <script src="Javascript/Medicamentos.js"></script>
</body>

</html>