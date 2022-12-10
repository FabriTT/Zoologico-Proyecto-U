<?php 
    include_once '../Controladores/ControladorAnimal.php';
    include_once '../Controladores/ControladorAlimento.php';
    include_once '../Controladores/ControladorEmpleado.php';
    include_once '../Controladores/ControladorHistorialAlimenticio.php';

    $tabla=(isset($_GET['tbl']))?$_GET['tbl']:"";
    $buscar=(isset($_GET['info']))?$_GET['info']:"";

    $iniciar=($_GET['pagina']-1)*4;

    $datosEmpleados= Almacenadores();
    $datosAlimentos= TodosAlimentos();
    $datosAnimales= TodosAnimal();


    switch($tabla){
        case 'normal':
            $datosHistoriales = MostrarHistorialesAlimenticios($iniciar,4,1);
            $paginas = ceil(ContarHistorialesAlimenticios(1)/4);
        break;
        case 'busqueda':
            $datosHistoriales = BuscarHistorialesAlimenticios($buscar,$iniciar,4,1);
            $paginas = ceil(ContarHistorialesAlimenticiosB($buscar,1)/4);
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
        <center><h2>TABLA DE LOS HISTORIALES ALIMENTICIOS</h2></center>
    </div>
    

    <table class="xmargin">
        <tr>
            <td><label class="lb ">Buscar por apodo:</label></td>
            <td><input type="text" class="form-control txt" placeholder="APODO" id="txtBuscar" value="" maxlength="100"></td>
            <td><button type="button" class="btn_insert btn-ligth " id="btnBuscar" onclick="buscar_historialAlimenticio()"><i class="fa-solid fa-magnifying-glass"></i></td>
            <td width="1000px">
               
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
                        <th class="th_x">EMPLEADO</th>
                        <th class="th_x">ANIMAL</th>
                        <th class="th_x">APODO</th>
                        <th class="th_x">HABITAT</th>
                        <th class="th_x">ALIMENTO</th>
                        <th class="th_x">CLASIFICACION</th>
                        <th class="th_x">CANTIDAD</th>
                        <th class="th_x">FECHA Y HORA</th>
                        <th class="th_x" colspan="1">ACCIONES</th>
                    </tr>
                </thead>
                <?php foreach ($datosHistoriales as $historial ){
                    $dataHistorialesAlimenticios=$historial['emp_id']."||".$historial['emp_nombre']."||".$historial['emp_apellidoP']."||".$historial['ani_id']."||".$historial['ani_nombre']."||".$historial['ani_apodo']."||".$historial['ali_id']."||".$historial['ali_nombre']."||".$historial['ali_clasificacionA']."||".$historial['hali_cantidad']."||".$historial['hali_fecha_hora']."||".$historial['hali_id']?>
                    <tr class="tr_x">
                        <td class="td_x"><?php echo $historial['emp_nombre']." ".$historial['emp_apellidoP']; ?></td>
                        <td class="td_x"><?php echo $historial['ani_nombre']; ?></td>
                        <td class="td_x"><?php echo $historial['ani_apodo']; ?></td>
                        <td class="td_x"><?php echo $historial['hab_nombre']; ?></td>
                        <td class="td_x"><?php echo $historial['ali_nombre']; ?></td>
                        <td class="td_x"><?php echo $historial['ali_clasificacionA']; ?></td>
                        <td class="td_x"><?php echo $historial['hali_cantidad']; ?></td>
                        <td class="td_x"><?php echo $historial['hali_fecha_hora']; ?></td>
                        <td class="td_btn"> 

                            <form action="" method="post">


                                <button type="button" class="btn btn-light btn_img"   data-toggle="modal" data-target="#ModalEditar" onclick="sel_historialAlimenticio('<?php echo $dataHistorialesAlimenticios ?>')"><i class="fa-solid fa-pen"></i></button> 
                                <button type="button" class="btn btn-light" id='btnEli' value="btnEliminar" onclick="eliminar_historialAlimenticio('<?php echo $historial['hali_id'] ?>','<?php echo $historial['ali_id'] ?>')" ><i class="fa-solid fa-trash"></i></button> 
                        
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
                        <li class="page-item <?php echo $_GET['pagina']<= 1 ? 'disabled' : ''?>"><a class="page-link" href="VistHistorialesAlimenticios.php?tbl=<?php echo $tabla."&info=".$buscar."&pagina=".$_GET['pagina']-1?>">Anterior</a></li>

                        <?php for($i=0;$i<$paginas;$i++): ?>
                        <li class="page-item <?php echo $_GET['pagina']== $i+1 ? 'active' : ''?>"><a class=" page-link" href="VistaHistorialesAlimenticios.php?tbl=<?php echo $tabla."&info=".$buscar."&pagina=".$i+1?>"> <?php echo $i+1?> </a></li>
                        <?php endfor ?>

                        <li class="page-item <?php echo $_GET['pagina']>= $paginas ? 'disabled' : ''?>"><a class=" page-link" href="VistHistorialesAlimenticios.php?tbl=<?php echo $tabla."&info=".$buscar."&pagina=".$_GET['pagina']+1?>">Siguiente</a></li>
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
                <h5 class="modal-title" id="exampleModalLongTitle">NUEVO HISTORIAL ALIMENTICIO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                        <table>
                            <tr>
                                <td><label class="label lb-modal">*ALMACENADOR:</label></td>
                                <td>
                                    <select class="lista" id="txtEmpleado" value="">
                                        <option selected disabled ></option>
                                        <?php foreach ($datosEmpleados as $empleado ){?>
                                        <option  class="opc" value="<?php echo $empleado['emp_id']; ?>" ><?php echo $empleado['emp_nombre']." ".$empleado['emp_apellidoP']; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td><label class="label lb-modal">*ANIMAL:</label></td>
                                <td>
                                    <select class="lista" id="txtAnimal" value="">
                                        <option selected disabled ></option>
                                        <?php foreach ($datosAnimales as $animal ){?>
                                        <option  class="opc" value="<?php echo $animal['ani_id']; ?>" ><?php echo $animal['ani_nombre']."-".$animal['ani_apodo']; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td><label class="label lb-modal">*ALIMENTO:</label></td>
                                <td>
                                    <select class="lista" id="txtAlimento" value="">
                                        <option selected disabled ></option>
                                        <?php foreach ($datosAlimentos as $alimento ){?>
                                        <option  class="opc" value="<?php echo $alimento['ali_id']; ?>" ><?php echo $alimento['ali_nombre']; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                                
                            <tr>
                                <td><label class="label lb-modal">*CANTIDAD: </label></td>
                                <td><input type="text" id="txtCantidad" class="txt-modal"   maxlength="25"></td>
                            </tr>


                            <tr>
                                <td><label class="label lb-modal">*FECHA Y HORA: </label></td>
                                <td><input type="datetime-local" id="txtFecha" class="txt-modal"   maxlength="25"></td>
                            </tr>

                            

                            
                        </table>          
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                <button type="button" class="btn btn-success" onclick="guardar_historial()" id="btnGua" value="btnGuardar">GUARDAR</button>
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
                                <td><label class="label lb-modal">*VETERINARIO:</label></td>
                                <td>
                                    <select class="lista" id="ModtxtEmpleado" value="">
                                        <option selected disabled ></option>
                                        <?php foreach ($datosEmpleados as $empleado ){?>
                                        <option  class="opc" value="<?php echo $empleado['emp_id']; ?>" ><?php echo $empleado['emp_nombre']." ".$empleado['emp_apellidoP']; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td><label class="label lb-modal">*ANIMAL:</label></td>
                                <td>
                                    <select class="lista" id="ModtxtAnimal" value="">
                                        <option selected disabled ></option>
                                        <?php foreach ($datosAnimales as $animal ){?>
                                        <option  class="opc" value="<?php echo $animal['ani_id']; ?>" ><?php echo $animal['ani_nombre']."-".$animal['ani_apodo']; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td><label class="label lb-modal">*ALIMENTO:</label></td>
                                <td>
                                    <select class="lista" id="ModtxtAlimento" value="">
                                        <option selected disabled ></option>
                                        <?php foreach ($datosAlimentos as $alimento ){?>
                                        <option  class="opc" value="<?php echo $alimento['ali_id']; ?>" ><?php echo $alimento['ali_nombre']; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td><label class="label lb-modal">*CANTIDAD: </label></td>
                                <td><input type="text" id="ModtxtCantidad" class="txt-modal"   maxlength="25"></td>
                            </tr>


                            <tr>
                                <td><label class="label lb-modal">*FECHA: </label></td>
                                <td><input type="datetime-local" id="ModtxtFecha" class="txt-modal"   maxlength="25"></td>
                            </tr>
 
                            
                        </table>      
                </div>
            <div class="modal-footer">
                <input type="hidden" id="Aux" class="txt-modal"   maxlength="25">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                <button type="button" class="btn btn-warning" onclick="editar_historial()" id="btnEdit" value="btnModificar" >EDITAR</button>
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

    <script src="Javascript/HistorialAlimenticio.js"></script>
</body>

</html>