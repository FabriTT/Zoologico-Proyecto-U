<?php 
    include_once '../Controladores/ControladorAlimento.php';

    $tabla=(isset($_GET['tbl']))?$_GET['tbl']:"";
    $buscar=(isset($_GET['info']))?$_GET['info']:"";

    $iniciar=($_GET['pagina']-1)*4;

    $fechaActual = date("Y")."-".date("m")."-".date("d");
   $datosEmpaques = MostrarEmpaques();

    switch($tabla){
        case 'normal':
            $datosAlimentos = MostrarAlimento($iniciar,4,1);
            $paginas = ceil(ContarAlimento(1)/4);
        break;
        case 'busqueda':
            $datosAlimentos = BuscarAlimento($buscar,$iniciar,4,1);
            $paginas = ceil(ContarAlimentoB($buscar,1)/4);
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
        <center><h2>TABLA DE ALIMENTOS</h2></center>
    </div>
    

    <table class="xmargin">
        <tr>
            <td><label class="lb ">Buscar por alimento:</label></td>
            <td><input type="text" class="form-control txt" placeholder="NOMBRE" id="txtBuscar" value="" maxlength="100"></td>
            <td><button type="button" class="btn_insert btn-ligth " id="btnBuscar" onclick="buscar_alimento()"><i class="fa-solid fa-magnifying-glass"></i></td>
            <td width="1050px">
               
            </td>
            <td><button type="button" class="btn_insert btn-success "  data-toggle="modal" data-target="#ModalInsertar"><i class="fa-solid fa-plus"></i></button></td>
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
                    <tr class="tr_x" style="background: <?php echo $alimento['ali_stock']<= $alimento['ali_stockMinimo'] || $alimento['ali_fechaVencimiento']<= $fechaActual ? 'red' : ''?>  ">
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


                                <button type="button" class="btn btn-light btn_img"   data-toggle="modal" data-target="#ModalEditar" onclick="sel_alimento('<?php echo $dataAlimentos ?>')"><i class="fa-solid fa-pen"></i></button> 
                                <button type="button" class="btn btn-light" id='btnEli' value="btnEliminar" onclick="eliminar_alimento('<?php echo $alimento['ali_id'] ?>')" ><i class="fa-solid fa-trash"></i></button> 
                        
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
                        <li class="page-item <?php echo $_GET['pagina']<= 1 ? 'disabled' : ''?>"><a class="page-link" href="VistaAlimentos.php?tbl=<?php echo $tabla."&info=".$buscar."&pagina=".$_GET['pagina']-1?>">Anterior</a></li>

                        <?php for($i=0;$i<$paginas;$i++): ?>
                        <li class="page-item <?php echo $_GET['pagina']== $i+1 ? 'active' : ''?>"><a class=" page-link" href="VistaAlimentos.php?tbl=<?php echo $tabla."&info=".$buscar."&pagina=".$i+1?>"> <?php echo $i+1?> </a></li>
                        <?php endfor ?>

                        <li class="page-item <?php echo $_GET['pagina']>= $paginas ? 'disabled' : ''?>"><a class=" page-link" href="VistaAlimentos.php?tbl=<?php echo $tabla."&info=".$buscar."&pagina=".$_GET['pagina']+1?>">Siguiente</a></li>
                    </ul>
                </nav>
            </td>
        </tr>
    </table>
   

<br>
<br>



    <!-- Modal insertar empleados -->
    <div class="modal fade" id="ModalInsertar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">NUEVO ALIMENTO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                        <table>
                            <tr>
                                <td><label class="lb-modal">*ALIMENTO: </label></td>
                                <td><input type="text" id="txtAlimento" class="txt-modal"   maxlength="25"></input></td>
                            </tr>
                                
                            <tr>
                                <td><label class="label lb-modal">*EMPAQUE: </label></td>
                                <td>
                                    <select class="lista" id="txtEmpaque" value="">
                                            <option selected disabled ></option>
                                            <?php foreach ($datosEmpaques as $empaque ){?>
                                            <option  class="opc" value="<?php echo $empaque['PaqA_id']; ?>" ><?php echo $empaque['PaqA_nombre']; ?></option>
                                            <?php } ?>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td><label class="label lb-modal">*CLASIFICACION: </label></td>
                                <td>
                                    <select class="lista" id="txtClasificacion" value="">
                                            <option selected disabled ></option>
                                            <option class="opc" >CARNIVORA</option>
                                            <option class="opc" >HERVIBORA</option>
                                            <option class="opc" >NSECTIVORA</option>
                                            <option class="opc" >OMNIVORA</option>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td><label class="label lb-modal">*STOCK: </label></td>
                                <td><input type="text" id="txtStock" class="txt-modal"   maxlength="25"></td>
                            </tr>

                            <tr>
                                <td><label class="label lb-modal">*CONSUMO MENSUAL:</label></td>
                                <td><input type="text" id="txtConsumoMensual" class="txt-modal"   maxlength="25"></td>
                            </tr>

                            <tr>
                                <td><label class="label lb-modal">*COSTO DEL PEDIDO:</label></td>
                                <td><input type="text" id="txtPedido" class="txt-modal"   maxlength="25"></td>
                            </tr>

                            <tr>
                                <td><label class="label lb-modal">*COSTO DEL MANTENIMIENTO:</label></td>
                                <td><input type="text" id="txtMantenimiento" class="txt-modal"   maxlength="25"></td>
                            </tr>

                            <tr>
                                <td><label class="label lb-modal">*ENTREGA EN DIAS:</label></td>
                                <td><input type="text" id="txtEntrega" class="txt-modal"  maxlength="25"></td>
                            </tr>

                            <tr>
                                <td><label class="label lb-modal">*VENCIMIENTO:</label></td>
                                <td><input type="date" id="txtVencimiento" class="txt-modal"  maxlength="25"></td>
                            </tr>


                        </table>          
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                <button type="button" class="btn btn-success" onclick="guardar_alimento()" id="btnGua" value="btnGuardar">GUARDAR</button>
            </div>
            </div>
        </div>
    </div>




    <!-- Modal modificar empleados -->
    <div class="modal fade" id="ModalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">EDITAR DATOS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <table>
                        <tr>
                            <td><label class="label lb-modal">ID: </label> </td>
                            <td><label id="ModtxtId" class="lb-modal"></td>
                        </tr>
                        <tr>
                                <td><label class="lb-modal">*ALIMENTO: </label></td>
                                <td><input type="text" id="ModtxtAlimento" class="txt-modal"   maxlength="25"></input></td>
                            </tr>
                                
                            <tr>
                                <td><label class="label lb-modal">*EMPAQUE: </label></td>
                                <td>
                                    <select class="lista" id="ModtxtEmpaque" value="">
                                            <option selected disabled ></option>
                                            <?php foreach ($datosEmpaques as $empaque ){?>
                                            <option  class="opc" value="<?php echo $empaque['PaqA_id']; ?>" ><?php echo $empaque['PaqA_nombre']; ?></option>
                                            <?php } ?>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td><label class="label lb-modal">*CLASIFICACION: </label></td>
                                <td>
                                    <select class="lista" id="ModtxtClasificacion" value="">
                                            <option selected disabled ></option>
                                            <option class="opc" >CARNIVORA</option>
                                            <option class="opc" >HERVIBORA</option>
                                            <option class="opc" >NSECTIVORA</option>
                                            <option class="opc" >OMNIVORA</option>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td><label class="label lb-modal">*STOCK: </label></td>
                                <td><input type="text" id="ModtxtStock" class="txt-modal"   maxlength="25"></td>
                            </tr>

                            <tr>
                                <td><label class="label lb-modal">*CONSUMO MENSUAL:</label></td>
                                <td><input type="text" id="ModtxtConsumoMensual" class="txt-modal"   maxlength="25"></td>
                            </tr>

                            <tr>
                                <td><label class="label lb-modal">*COSTO DEL PEDIDO:</label></td>
                                <td><input type="text" id="ModtxtPedido" class="txt-modal"   maxlength="25"></td>
                            </tr>

                            <tr>
                                <td><label class="label lb-modal">*COSTO DEL MANTENIMIENTO:</label></td>
                                <td><input type="text" id="ModtxtMantenimiento" class="txt-modal"   maxlength="25"></td>
                            </tr>

                            <tr>
                                <td><label class="label lb-modal">*ENTREGA EN DIAS:</label></td>
                                <td><input type="text" id="ModtxtEntrega" class="txt-modal"  maxlength="25"></td>
                            </tr>

                            <tr>
                                <td><label class="label lb-modal">*VENCIMIENTO:</label></td>
                                <td><input type="date" id="ModtxtVencimiento" class="txt-modal"  maxlength="25"></td>
                            </tr>




                           
                            
                        </table>      
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                <button type="button" class="btn btn-warning" onclick="editar_alimento()" id="btnEdit" value="btnModificar" >EDITAR</button>
            </div>
            </div>
        </div>
    </div>
    
    
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