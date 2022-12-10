<?php 
    include_once '../Controladores/ControladorAlimento.php';

    $tabla=(isset($_GET['tbl']))?$_GET['tbl']:"";
    $buscar=(isset($_GET['info']))?$_GET['info']:"";

    $iniciar=($_GET['pagina']-1)*4;

    $fechaActual = date("Y")."-".date("m")."-".date("d");
   $datosEmpaques = MostrarEmpaques();

    switch($tabla){
        case 'normal':
            $datosAlimentos = MostrarAlimento($iniciar,4,0);
            $paginas = ceil(ContarAlimento(0)/4);
        break;
        case 'busqueda':
            $datosAlimentos = BuscarAlimento($buscar,$iniciar,4,0);
            $paginas = ceil(ContarAlimentoB($buscar,0)/4);
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
        <center><h2>TABLA DE ALIMENTOS ELIMENTOS</h2></center>
    </div>
    

    <table class="xmargin">
        <tr>
            <td><label class="lb ">Buscar por alimento:</label></td>
            <td><input type="text" class="form-control txt" placeholder="NOMBRE" id="txtBuscar" value="" maxlength="100"></td>
            <td><button type="button" class="btn_insert btn-ligth " id="btnBuscar" onclick="buscar_alimentoEli()"><i class="fa-solid fa-magnifying-glass"></i></td>
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
                        <th class="th_x">ALIMENTO</th>
                        <th class="th_x">EMPAQUE</th>
                        <th class="th_x">CLASIFICACION</th>
                        <th class="th_x">STOCK</th>
                        <th class="th_x">SOTCK MAXIMO</th>
                        <th class="th_x">STOCK MINIMO</th>
                        <th class="th_x">CONSUMO MENSUAL</th>
                        <th class="th_x">COSTO DEL PEDIDO</th>
                        <th class="th_x">COSTO DEL MANTENIMIENTO</th>
                        <th class="th_x">ENTREGA EN DIAS</th>
                        <th class="th_x">VENCIMIENTO</th>
                        <th class="th_x" colspan="2">ACCIONES</th>
                    </tr>
                </thead>
                <?php foreach ($datosAlimentos as $alimento ){
                    $dataAlimentos=$alimento['ali_id']."||".$alimento['ali_nombre']."||".$alimento['PaqA_id']."||".$alimento['PaqA_nombre']."||".$alimento['ali_clasificacionA']."||".$alimento['ali_stock']."||".$alimento['ali_qOptima']."||".$alimento['ali_stockMinimo']."||".$alimento['ali_consumoMensual']."||".$alimento['ali_costoPedido']."||".$alimento['ali_costoMantenimiento']."||".$alimento['ali_entregaDias']."||".$alimento['ali_fechaVencimiento']?>
                    <tr class="tr_x" style="background: <?php echo $alimento['ali_stock']<= $alimento['ali_stockMinimo'] || $alimento['ali_fechaVencimiento']> $fechaActual ? 'red' : ''?>  ">
                        <td class="td_x" ><?php echo $alimento['ali_nombre']; ?></td>
                        <td class="td_x"><?php echo $alimento['PaqA_nombre']; ?></td>
                        <td class="td_x"><?php echo $alimento['ali_clasificacionA']; ?></td>
                        <td class="td_x"><?php echo $alimento['ali_stock']; ?></td>
                        <td class="td_x"><?php echo $alimento['ali_qOptima']; ?></td>
                        <td class="td_x"><?php echo $alimento['ali_stockMinimo']; ?></td>
                        <td class="td_x"><?php echo $alimento['ali_consumoMensual']; ?></td>
                        <td class="td_x"><?php echo $alimento['ali_costoPedido']; ?></td>
                        <td class="td_x"><?php echo $alimento['ali_costoMantenimiento']; ?></td>
                        <td class="td_x"><?php echo $alimento['ali_entregaDias']; ?></td>
                        <td class="td_x"><?php echo $alimento['ali_fechaVencimiento']; ?></td>
                        <td class="td_btn"> 

                            <form action="" method="post">



                                <button type="button" class="btn btn-light" id='btnEli' value="btnReactivar" onclick="reactivar_alimento('<?php echo $alimento['ali_id'] ?>')" ><i class="fa-solid fa-arrows-rotate"></i></button> 
                        
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
                        <li class="page-item <?php echo $_GET['pagina']<= 1 ? 'disabled' : ''?>"><a class="page-link" href="VistaAlimentosEli.php?tbl=<?php echo $tabla."&info=".$buscar."&pagina=".$_GET['pagina']-1?>">Anterior</a></li>

                        <?php for($i=0;$i<$paginas;$i++): ?>
                        <li class="page-item <?php echo $_GET['pagina']== $i+1 ? 'active' : ''?>"><a class=" page-link" href="VistaAlimentosEli.php?tbl=<?php echo $tabla."&info=".$buscar."&pagina=".$i+1?>"> <?php echo $i+1?> </a></li>
                        <?php endfor ?>

                        <li class="page-item <?php echo $_GET['pagina']>= $paginas ? 'disabled' : ''?>"><a class=" page-link" href="VistaAlimentosEli.php?tbl=<?php echo $tabla."&info=".$buscar."&pagina=".$_GET['pagina']+1?>">Siguiente</a></li>
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

    <script src="Javascript/Alimentos.js"></script>
</body>

</html>