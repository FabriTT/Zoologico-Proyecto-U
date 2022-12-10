<?php 
    include_once '../Controladores/ControladorEmpleado.php';

    $tabla=(isset($_GET['tbl']))?$_GET['tbl']:"";
    $buscar=(isset($_GET['info']))?$_GET['info']:"";

    $iniciar=($_GET['pagina']-1)*3;

    switch($tabla){
        case 'normal':
            $datosEmpleados = MostrarEmpleado($iniciar,3,1);
            $paginas = ceil(ContarEmpleados(1)/3);
        break;
        case 'busqueda':
            $datosEmpleados = BuscarEmpleado($buscar,$iniciar,3,1);
            $paginas = ceil(ContarEmpleadosB($buscar,1)/3);
        break;
    }
    
    
    
    
    //$prueba=(isset($_GET['id']))?$_GET['id']:"";
    
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
        <center><h2>TABLA DE EMPLEADOS</h2></center>
    </div>
    

    <table class="xmargin">
        <tr>
            <td><label class="lb ">Buscar por Paterno:</label></td>
            <td><input type="text" class="form-control txt" placeholder="APELLIDO" id="txtBuscar" value="" maxlength="100"></td>
            <td><button type="button" class="btn_insert btn-ligth " id="btnBuscar" onclick="buscar_empleado()"><i class="fa-solid fa-magnifying-glass"></i></td>
            <td width="1050px">
               
            </td>
            <td><button type="button" class="btn_insert btn-success "  data-toggle="modal" data-target="#ModalInsertar"><i class="fa-solid fa-user-plus"></i></button></td>
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
                        <th class="th_x">NOMBRE</th>
                        <th class="th_x">PATERNO</th>
                        <th class="th_x">MATERNO</th>
                        <th class="th_x">NACIMIENTO</th>
                        <th class="th_x">CARNET</th>
                        <th class="th_x">CARGO</th>
                        <th class="th_x">USUARIO</th>
                        <th class="th_x">CORREO</th>
                        <th class="th_x">TELEFONO</th>
                        <th class="th_x">TELEFONO REF.</th>
                        <th class="th_x">IMAGEN</th>
                        <th class="th_x" colspan="2">ACCIONES</th>
                    </tr>
                </thead>
                <?php foreach ($datosEmpleados as $empleado ){
                    $dataEmpleado=$empleado['emp_id']."||".$empleado['emp_nombre']."||".$empleado['emp_apellidoP']."||".$empleado['emp_apellidoM']."||".$empleado['emp_carnet']."||".$empleado['emp_correo']."||".$empleado['emp_telefono']."||".$empleado['car_id']."||".$empleado['car_descripcion']."||".$empleado['emp_fechaNac']."||".$empleado['emp_telefonoR']?>
                    <tr class="tr_x">
                        <td class="td_x"><?php echo $empleado['emp_nombre']; ?></td>
                        <td class="td_x"><?php echo $empleado['emp_apellidoP']; ?></td>
                        <td class="td_x"><?php echo $empleado['emp_apellidoM']; ?></td>
                        <td class="td_x"><?php echo $empleado['emp_fechaNac']; ?></td>
                        <td class="td_x"><?php echo $empleado['emp_carnet']; ?></td>
                        <td class="td_x"><?php echo $empleado['car_descripcion']; ?></td>
                        <td class="td_x"><?php echo $empleado['emp_usuario']; ?></td>
                        <td class="td_x"><?php echo $empleado['emp_correo']; ?></td>
                        <td class="td_x"><?php echo $empleado['emp_telefono']; ?></td>
                        <td class="td_x"><?php echo $empleado['emp_telefonoR']; ?></td>
                        <td class="td_x"><img src="Imagenes/<?php echo $empleado['emp_imagen']?>" width="80px"/></td>
                        <td class="td_btn"> 

                            <form action="" method="post">


                                <button type="button" class="btn btn-light btn_img"   data-toggle="modal" data-target="#ModalEditar" onclick="sel_empleado('<?php echo $dataEmpleado ?>')"><i class="fa-solid fa-pen"></i></button> 
                                <button type="button" class="btn btn-light" id='btnEli' value="btnEliminar" onclick="eliminar_empleado('<?php echo $empleado['emp_id'] ?>')" ><i class="fa-solid fa-trash"></i></button> 
                        
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
                        <li class="page-item <?php echo $_GET['pagina']<= 1 ? 'disabled' : ''?>"><a class="page-link" href="VistaEmpleados.php?tbl=<?php echo $tabla."&info=".$buscar."&pagina=".$_GET['pagina']-1?>">Anterior</a></li>

                        <?php for($i=0;$i<$paginas;$i++): ?>
                        <li class="page-item <?php echo $_GET['pagina']== $i+1 ? 'active' : ''?>"><a class=" page-link" href="VistaEmpleados.php?tbl=<?php echo $tabla."&info=".$buscar."&pagina=".$i+1?>"> <?php echo $i+1?> </a></li>
                        <?php endfor ?>

                        <li class="page-item <?php echo $_GET['pagina']>= $paginas ? 'disabled' : ''?>"><a class=" page-link" href="VistaEmpleados.php?tbl=<?php echo $tabla."&info=".$buscar."&pagina=".$_GET['pagina']+1?>">Siguiente</a></li>
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
                <h5 class="modal-title" id="exampleModalLongTitle">NUEVO EMPLEADO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                        <table>
                            <tr>
                                <td><label class="lb-modal">*NOMBRE: </label></td>
                                <td><input type="text" id="txtNombre" class="txt-modal"   maxlength="25"></input></td>
                            </tr>
                                
                            <tr>
                                <td><label class="label lb-modal">*PATERNO: </label></td>
                                <td><input type="text" id="txtPaterno" class="txt-modal"   maxlength="25"></td>
                            </tr>

                            <tr>
                                <td><label class="label lb-modal">*MATERNO:</label></td>
                                <td><input type="text" id="txtMaterno" class="txt-modal"    maxlength="25"></td>
                            </tr>

                            <tr>
                                <td><label class="label lb-modal">*FECHA NAC. :</label></td>
                                <td><input type="date" id="txtFecha" class="txt-modal"  maxlength="25"></td>
                            </tr>

                            <tr>
                                <td><label class="label lb-modal">*CARNET: </label></td>
                                <td><input type="text" id="txtCarnet" class="txt-modal"    maxlength="8"></td>
                            </tr>

                            <tr>
                                <td><label class="label lb-modal">*CARGO:</label></td>
                                <td>
                                    <select class="lista" id="txtCargo" value="">
                                        <option selected disabled ></option>
                                        <option class="opc" value="RRHH">ADMINITRADOR DE RECURSOS HUMANOS</option>
                                        <option class="opc" value="ANIM">ADMINISTRADOR DE ANIMALES</option>
                                        <option class="opc" value="ALM">ADMINISTRADOR DE ALMACENES</option>
                                        <option class="opc" value="VEN">ADMINISTRADOR DE VENTAS</option>
                                        <option class="opc" value="ETH">ADMINISTRADOR DE SEGURIDAD INFORMATICA</option>
                                        <option class="opc" value="SUDO">ADMINISTRADOR DEL SISTEMA</option>
                                        <option class="opc" value="VET">VETERINARIO</option>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td><label class="label lb-modal">*CONTRASEÑA: </label></td>
                                <td><input type="password" id="txtContraseña" class="txt-modal"    maxlength="50"></td>
                            </tr>

                            <tr>
                                <td><label class="label lb-modal">*TELEFONO: </label></td>
                                <td><input type="text" id="txtTelefono" class="txt-modal"    maxlength="8"></td>
                            </tr>

                            <tr>
                                <td><label class="label lb-modal">*TELEFONO REF. : </label></td>
                                <td><input type="text" id="txtTelefonoR" class="txt-modal"    maxlength="8"></td>
                            </tr>

                            <tr>
                                <td><label class="label lb-modal">*CORREO: </label></td>
                                <td><input type="text" id="txtCorreo" class="txt-modal"   maxlength="50"></td>
                            </tr>

                            <tr>
                                <td><label class="label lb-modal">*IMAGEN: </label></td>
                                <td><input type="file" class="txtImg" id="txtImagen" >   </td>
                            </tr>

                            
                        </table>          
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                <button type="button" class="btn btn-success" onclick="guardar_empleado()" id="btnGua" value="btnGuardar">GUARDAR</button>
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
                                <td><label class="lb-modal">NOMBRE: </label></td>
                                <td><input type="text" id="ModtxtNombre" class="txt-modal" name="txtNombre"  maxlength="25"></input></td>
                            </tr>
                                
                            <tr>
                                <td><label class="label lb-modal">PATERNO: </label></td>
                                <td><input type="text" id="ModtxtPaterno" class="txt-modal"  name="txtPaterno"  maxlength="25"></td>
                            </tr>

                            <tr>
                                <td><label class="label lb-modal">MATERNO:</label></td>
                                <td><input type="text" id="ModtxtMaterno" class="txt-modal"  name="txtMaterno"  maxlength="25"></td>
                            </tr>

                            <tr>
                                <td><label class="label lb-modal">*FECHA NAC. :</label></td>
                                <td><input type="date" id="ModtxtFecha" class="txt-modal"  maxlength="25"></td>
                            </tr>

                            <tr>
                                <td><label class="label lb-modal">CARNET: </label></td>
                                <td><input type="text" id="ModtxtCarnet" class="txt-modal"  name="txtPass"  maxlength="8"></td>
                            </tr>

                            <tr>
                                <td><label class="label lb-modal">CARGO:</label></td>
                                <td>
                                    <select class="lista" id="ModtxtCargo" value="">
                                        <option selected disabled ></option>
                                        <option class="opc" value="RRHH">ADMINITRADOR DE RECURSOS HUMANOS</option>
                                        <option class="opc" value="ANIM">ADMINISTRADOR DE ANIMALES</option>
                                        <option class="opc" value="ALM">ADMINISTRADOR DE ALMACENES</option>
                                        <option class="opc" value="VEN">ADMINISTRADOR DE VENTAS</option>
                                        <option class="opc" value="ETH">ADMINISTRADOR DE SEGURIDAD INFORMATICA</option>
                                        <option class="opc" value="SUDO">ADMINISTRADOR DEL SISTEMA</option>
                                        <option class="opc" value="VET">VETERINARIO</option>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td><label class="label lb-modal">USUARIO: </label> </td>
                                <td><label id="ModtxtUsuario" class="lb-modal"></td>
                            </tr>

                            <tr>
                                <td><label class="label lb-modal">TELEFONO: </label></td>
                                <td><input type="text" id="ModtxtTelefono" class="txt-modal"  name="txtTelefono"  maxlength="8"></td>
                            </tr>

                            <tr>
                                <td><label class="label lb-modal">*TELEFONO REF. : </label></td>
                                <td><input type="text" id="ModtxtTelefonoR" class="txt-modal"    maxlength="8"></td>
                            </tr>

                            <tr>
                                <td><label class="label lb-modal">CORREO: </label></td>
                                <td><input type="text" id="ModtxtCorreo" class="txt-modal"  name="txtDireccion" maxlength="50"></td>
                            </tr>

                            <tr>
                                <td><label class="label lb-modal">IMAGEN: </label></td>
                                <td><input type="file" id="ModtxtImagen" name="txtImagen"  class="txtImg"></td>
                            </tr>

                            
                        </table>          
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                <button type="button" class="btn btn-warning" onclick="editar_empleado()" id="btnEdit" value="btnEditar" >EDITAR</button>
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

    <script src="Javascript/Empleados.js"></script>
</body>

</html>