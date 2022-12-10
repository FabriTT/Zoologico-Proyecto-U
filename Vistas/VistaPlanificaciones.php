<?php 
    include_once '../Controladores/ControladorPlanificacion.php';
    include_once '../Controladores/ControladorEmpleado.php';

    $tabla=(isset($_GET['tbl']))?$_GET['tbl']:"";
    $buscar=(isset($_GET['info']))?$_GET['info']:"";

    $iniciar=($_GET['pagina']-1)*4;

   $fechaActual = date("Y")."-".date("m")."-".date("d");
   $datosVendedores = Vendedores();

    switch($tabla){
        case 'normal':
            $datosPlanificaciones = MostrarPlanificacion($iniciar,4,1);
            $paginas = ceil(ContarPlanificacion(1)/4);
        break;
        case 'busqueda':
            $datosPlanificaciones = BuscarPlanificacion($buscar,$iniciar,4,1);
            $paginas = ceil(ContarPlanificacionB($buscar,1)/4);
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
        <center><h2>TABLA DE PLANIFICACIONES</h2></center>
    </div>
    

    <table class="xmargin">
        <tr>
            <td><label class="lb ">Buscar por fecha:</label></td>
            <td><input type="date" class="form-control txt" placeholder="NOMBRE" id="txtBuscar" value="" maxlength="100"></td>
            <td><button type="button" class="btn_insert btn-ligth " id="btnBuscar" onclick="buscar_planificacion()"><i class="fa-solid fa-magnifying-glass"></i></td>
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
                        <th class="th_x">EMPLEADO</th>
                        <th class="th_x">ENTRADAS MENORES $$</th>
                        <th class="th_x">ENTRADAS MAYORES $$</th>
                        <th class="th_x">ENTRADAS ADULTOS MAYORES $$</th>
                        <th class="th_x">CANTIDAD</th>
                        <th class="th_x">FECHA</th>
                        <th class="th_x" colspan="2">ACCIONES</th>
                    </tr>
                </thead>
                <?php foreach ($datosPlanificaciones as $planificacion ){
                    $dataPlanificaciones=$planificacion['plan_id']."||".$planificacion['emp_id']."||".$planificacion['emp_nombre']."||".$planificacion['emp_apellidoP']."||".$planificacion['plan_precioEMenores']."||".$planificacion['plan_precioEMayores']."||".$planificacion['plan_precioEAMayores']."||".$planificacion['plan_cantidad']."||".$planificacion['plan_fecha']?>
                    <tr class="tr_x">
                        <td class="td_x" ><?php echo $planificacion['emp_nombre']." ".$planificacion['emp_apellidoP']; ?></td>
                        <td class="td_x"><?php echo $planificacion['plan_precioEMenores']; ?></td>
                        <td class="td_x"><?php echo $planificacion['plan_precioEMayores']; ?></td>
                        <td class="td_x"><?php echo $planificacion['plan_precioEAMayores']; ?></td>
                        <td class="td_x"><?php echo $planificacion['plan_cantidad']; ?></td>
                        <td class="td_x"><?php echo $planificacion['plan_fecha']; ?></td>
                        <td class="td_btn"> 

                            <form action="" method="post">


                                <button type="button" class="btn btn-light btn_img"   data-toggle="modal" data-target="#ModalEditar" onclick="sel_planificacion('<?php echo $dataPlanificaciones ?>')"><i class="fa-solid fa-pen"></i></button> 
                                <button type="button" class="btn btn-light" id='btnEli' value="btnEliminar" onclick="eliminar_planificacion('<?php echo $planificacion['plan_id'] ?>')" ><i class="fa-solid fa-trash"></i></button> 
                                <button type="button" class="btn btn-light" id='btnEli' value="btnEliminar" onclick="ver_venta('<?php echo $planificacion['plan_id'] ?>','<?php echo $planificacion['plan_cantidad'] ?>')" ><i class="fa-solid fa-ticket"></i></i></button> 
                        
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
                        <li class="page-item <?php echo $_GET['pagina']<= 1 ? 'disabled' : ''?>"><a class="page-link" href="VistaPlanificaciones.php?tbl=<?php echo $tabla."&info=".$buscar."&pagina=".$_GET['pagina']-1?>">Anterior</a></li>

                        <?php for($i=0;$i<$paginas;$i++): ?>
                        <li class="page-item <?php echo $_GET['pagina']== $i+1 ? 'active' : ''?>"><a class=" page-link" href="VistaPlanificaciones.php?tbl=<?php echo $tabla."&info=".$buscar."&pagina=".$i+1?>"> <?php echo $i+1?> </a></li>
                        <?php endfor ?>

                        <li class="page-item <?php echo $_GET['pagina']>= $paginas ? 'disabled' : ''?>"><a class=" page-link" href="VistaPlanificaciones.php?tbl=<?php echo $tabla."&info=".$buscar."&pagina=".$_GET['pagina']+1?>">Siguiente</a></li>
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
                <h5 class="modal-title" id="exampleModalLongTitle">NUEVO PLANIFICACION</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                        <table>
                            <tr>
                                <td><label class="label lb-modal">*VENDEDOR: </label></td>
                                <td>
                                    <select class="lista" id="txtVendedor" value="">
                                            <option selected disabled ></option>
                                            <?php foreach ($datosVendedores as $vendedor ){?>
                                            <option  class="opc" value="<?php echo $vendedor['emp_id']; ?>" ><?php echo $vendedor['emp_nombre']." ".$vendedor['emp_apellidoP']; ?></option>
                                            <?php } ?>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td><label class="lb-modal">*PRECIO ENTRADA MENORES: </label></td>
                                <td><input type="text" id="txtMenores" class="txt-modal"   maxlength="25"></input></td>
                            </tr>

                            <tr>
                                <td><label class="lb-modal">*PRECIO ENTRADA MAYORES: </label></td>
                                <td><input type="text" id="txtMayores" class="txt-modal"   maxlength="25"></input></td>
                            </tr>

                            <tr>
                                <td><label class="lb-modal">*PRECIO ENTRADA ADULTOS MAYORES: </label></td>
                                <td><input type="text" id="txtAMayores" class="txt-modal"   maxlength="25"></input></td>
                            </tr>

                            <tr>
                                <td><label class="label lb-modal">*CANTIDAD: </label></td>
                                <td><input type="text" id="txtCantidad" class="txt-modal"   maxlength="25"></td>
                            </tr>


                            <tr>
                                <td><label class="label lb-modal">FECHA: </label> </td>
                                <td><label id="txtFecha" class="lb-modal"> <?php echo date("Y")."-".date("m")."-".date("d"); ?> </label></td>
                            </tr>


                        </table>          
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                <button type="button" class="btn btn-success" onclick="guardar_planificacion()" id="btnGua" value="btnGuardar">GUARDAR</button>
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
                                <td><label class="label lb-modal">*VENDEDOR: </label></td>
                                <td>
                                    <select class="lista" id="ModtxtVendedor" value="">
                                            <option selected disabled ></option>
                                            <?php foreach ($datosVendedores as $vendedor ){?>
                                            <option  class="opc" value="<?php echo $vendedor['emp_id']; ?>" ><?php echo $vendedor['emp_nombre']." ".$vendedor['emp_apellidoP']; ?></option>
                                            <?php } ?>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td><label class="lb-modal">*PRECIO ENTRADA MENORES: </label></td>
                                <td><input type="text" id="ModtxtMenores" class="txt-modal"   maxlength="25"></input></td>
                            </tr>

                            <tr>
                                <td><label class="lb-modal">*PRECIO ENTRADA MAYORES: </label></td>
                                <td><input type="text" id="ModtxtMayores" class="txt-modal"   maxlength="25"></input></td>
                            </tr>

                            <tr>
                                <td><label class="lb-modal">*PRECIO ENTRADA ADULTOS MAYORES: </label></td>
                                <td><input type="text" id="ModtxtAMayores" class="txt-modal"   maxlength="25"></input></td>
                            </tr>

                            <tr>
                                <td><label class="label lb-modal">*CANTIDAD: </label></td>
                                <td><input type="text" id="ModtxtCantidad" class="txt-modal"   maxlength="25"></td>
                            </tr>


                            <tr>
                                <td><label class="label lb-modal">FECHA: </label> </td>
                                <td><label id="ModtxtFecha" class="lb-modal"></td>
                            </tr>



                            
                        </table>      
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                <button type="button" class="btn btn-warning" onclick="editar_planificacion()" id="btnEdit" value="btnModificar" >EDITAR</button>
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

    <script src="Javascript/Planificaciones.js"></script>
</body>

</html>