<?php 
    include_once '../Controladores/ControladorMedicamento.php';

    $tabla=(isset($_GET['tbl']))?$_GET['tbl']:"";
    $buscar=(isset($_GET['info']))?$_GET['info']:"";

    $iniciar=($_GET['pagina']-1)*4;

   $fechaActual = date("Y")."-".date("m")."-".date("d");
   $datosEmpaques = MostrarEmpaques();

    switch($tabla){
        case 'normal':
            $datosMedicamentos = MostrarMedicamentos($iniciar,4,1);
            $paginas = ceil(ContarMedicamento(1)/4);
        break;
        case 'busqueda':
            $datosMedicamentos = BuscarMedicamentos($buscar,$iniciar,4,1);
            $paginas = ceil(ContarMedicamentoB($buscar,1)/4);
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
            <td><button type="button" class="btn_insert btn-ligth " id="btnBuscar" onclick="buscar_medicamento()"><i class="fa-solid fa-magnifying-glass"></i></td>
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


                                <button type="button" class="btn btn-light btn_img"   data-toggle="modal" data-target="#ModalEditar" onclick="sel_medicamento('<?php echo $dataMedicamentos ?>')"><i class="fa-solid fa-pen"></i></button> 
                                <button type="button" class="btn btn-light" id='btnEli' value="btnEliminar" onclick="eliminar_medicamento('<?php echo $medicamento['med_id'] ?>')" ><i class="fa-solid fa-trash"></i></button> 
                        
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
                        <li class="page-item <?php echo $_GET['pagina']<= 1 ? 'disabled' : ''?>"><a class="page-link" href="VistaMedicamentos.php?tbl=<?php echo $tabla."&info=".$buscar."&pagina=".$_GET['pagina']-1?>">Anterior</a></li>

                        <?php for($i=0;$i<$paginas;$i++): ?>
                        <li class="page-item <?php echo $_GET['pagina']== $i+1 ? 'active' : ''?>"><a class=" page-link" href="VistaMedicamentos.php?tbl=<?php echo $tabla."&info=".$buscar."&pagina=".$i+1?>"> <?php echo $i+1?> </a></li>
                        <?php endfor ?>

                        <li class="page-item <?php echo $_GET['pagina']>= $paginas ? 'disabled' : ''?>"><a class=" page-link" href="VistaMedicamentos.php?tbl=<?php echo $tabla."&info=".$buscar."&pagina=".$_GET['pagina']+1?>">Siguiente</a></li>
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
                <h5 class="modal-title" id="exampleModalLongTitle">NUEVO MEDICAMENTO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                        <table>
                            <tr>
                                <td><label class="lb-modal">*MEDICAMENTO: </label></td>
                                <td><input type="text" id="txtMedicamento" class="txt-modal"   maxlength="25"></input></td>
                            </tr>
                                
                            <tr>
                                <td><label class="label lb-modal">*EMPAQUE: </label></td>
                                <td>
                                    <select class="lista" id="txtEmpaque" value="">
                                            <option selected disabled ></option>
                                            <?php foreach ($datosEmpaques as $empaque ){?>
                                            <option  class="opc" value="<?php echo $empaque['PaqM_id']; ?>" ><?php echo $empaque['PaqM_nombre']; ?></option>
                                            <?php } ?>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td><label class="label lb-modal">*TIPO DE ADMINISTRACION: </label></td>
                                <td>
                                    <select class="lista" id="txtAdministracion" value="">
                                            <option selected disabled ></option>
                                            <option class="opc" >VIA ORAL</option>
                                            <option class="opc" >VIA SUBLINGUAL</option>
                                            <option class="opc" >VIA TOPICA</option>
                                            <option class="opc" >VIA TRANSDERMICA</option>
                                            <option class="opc" >VIA OFTALMICA</option>
                                            <option class="opc" >VIA OTICA</option>
                                            <option class="opc" >VIA INTRANASAL</option>
                                            <option class="opc" >VIA INHALATORIA</option>
                                            <option class="opc" >VIA RECTAL</option>
                                            <option class="opc" >VIA PARENTAL</option>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td><label class="label lb-modal">*STOCK: </label></td>
                                <td><input type="text" id="txtStock" class="txt-modal"   maxlength="25"></td>
                            </tr>


                            <tr>
                                <td><label class="label lb-modal">*VENCIMIENTO:</label></td>
                                <td><input type="date" id="txtVencimiento" class="txt-modal"  maxlength="25"></td>
                            </tr>


                        </table>          
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                <button type="button" class="btn btn-success" onclick="guardar_medicamento()" id="btnGua" value="btnGuardar">GUARDAR</button>
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
                                <td><label class="lb-modal">*MEDICAMENTO: </label></td>
                                <td><input type="text" id="ModtxtMedicamento" class="txt-modal"   maxlength="25"></input></td>
                            </tr>
                                
                            <tr>
                                <td><label class="label lb-modal">*EMPAQUE: </label></td>
                                <td>
                                    <select class="lista" id="ModtxtEmpaque" value="">
                                            <option selected disabled ></option>
                                            <?php foreach ($datosEmpaques as $empaque ){?>
                                            <option  class="opc" value="<?php echo $empaque['PaqM_id']; ?>" ><?php echo $empaque['PaqM_nombre']; ?></option>
                                            <?php } ?>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td><label class="label lb-modal">*TIPO DE ADMINISTRACION: </label></td>
                                <td>
                                    <select class="lista" id="ModtxtAdministracion" value="">
                                            <option selected disabled ></option>
                                            <option class="opc" >VIA ORAL</option>
                                            <option class="opc" >VIA SUBLINGUAL</option>
                                            <option class="opc" >VIA TOPICA</option>
                                            <option class="opc" >VIA TRANSDERMICA</option>
                                            <option class="opc" >VIA OFTALMICA</option>
                                            <option class="opc" >VIA OTICA</option>
                                            <option class="opc" >VIA INTRANASAL</option>
                                            <option class="opc" >VIA INHALATORIA</option>
                                            <option class="opc" >VIA RECTAL</option>
                                            <option class="opc" >VIA PARENTAL</option>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td><label class="label lb-modal">*STOCK: </label></td>
                                <td><input type="text" id="ModtxtStock" class="txt-modal"   maxlength="25"></td>
                            </tr>


                            <tr>
                                <td><label class="label lb-modal">*VENCIMIENTO:</label></td>
                                <td><input type="date" id="ModtxtVencimiento" class="txt-modal"  maxlength="25"></td>
                            </tr>



                            
                        </table>      
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                <button type="button" class="btn btn-warning" onclick="editar_medicamento()" id="btnEdit" value="btnModificar" >EDITAR</button>
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

    <script src="Javascript/Medicamentos.js"></script>
</body>

</html>