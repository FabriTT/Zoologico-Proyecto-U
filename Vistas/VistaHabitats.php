<?php 
    include_once '../Controladores/ControladorHabitat.php';

    $tabla=(isset($_GET['tbl']))?$_GET['tbl']:"";
    $buscar=(isset($_GET['info']))?$_GET['info']:"";

    $iniciar=($_GET['pagina']-1)*4;

    switch($tabla){
        case 'normal':
            $datosHabitats = MostrarHabitat($iniciar,4,1);
            $paginas = ceil(ContarHabitat(1)/4);
        break;
        case 'busqueda':
            $datosHabitats = BuscarHabitat($buscar,$iniciar,4,1);
            $paginas = ceil(ContarHabitatB($buscar,1)/4);
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
        <center><h2>TABLA DE LOS HABITATS</h2></center>
    </div>
    

    <table class="xmargin">
        <tr>
            <td><label class="lb ">Buscar por nombre:</label></td>
            <td><input type="text" class="form-control txt" placeholder="NOMBRE" id="txtBuscar" value="" maxlength="100"></td>
            <td><button type="button" class="btn_insert btn-ligth " id="btnBuscar" onclick="buscar_habitat()"><i class="fa-solid fa-magnifying-glass"></i></td>
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
                        <th class="th_x">NOMBRE</th>
                        <th class="th_x">ANIMAL</th>
                        <th class="th_x">CLASIFICACION</th>
                        <th class="th_x">CAPACIDAD</th>
                        <th class="th_x">HORARIO DE LIMPIEZA</th>
                        <th class="th_x">HORARIO DE ALIMENTACION</th>
                        <th class="th_x" colspan="2">ACCIONES</th>
                    </tr>
                </thead>
                <?php foreach ($datosHabitats as $habitat ){
                    $dataHabitat=$habitat['hab_id']."||".$habitat['hab_nombre']."||".$habitat['hab_nombreA']."||".$habitat['hab_clasificacionAmbiente']."||".$habitat['hab_capacidad']."||".$habitat['hab_horarioLimpieza']."||".$habitat['hab_horarioAlimentacion']."||".$habitat['hab_estado']?>
                    <tr class="tr_x">
                        <td class="td_x"><?php echo $habitat['hab_nombre']; ?></td>
                        <td class="td_x"><?php echo $habitat['hab_nombreA']; ?></td>
                        <td class="td_x"><?php echo $habitat['hab_clasificacionAmbiente']; ?></td>
                        <td class="td_x"><?php echo $habitat['hab_capacidad']; ?></td>
                        <td class="td_x"><?php echo $habitat['hab_horarioLimpieza']; ?></td>
                        <td class="td_x"><?php echo $habitat['hab_horarioAlimentacion']; ?></td>
                        <td class="td_btn"> 

                            <form action="" method="post">


                                <button type="button" class="btn btn-light btn_img"   data-toggle="modal" data-target="#ModalEditar" onclick="sel_habitat('<?php echo $dataHabitat ?>')"><i class="fa-solid fa-pen"></i></button> 
                                <button type="button" class="btn btn-light" id='btnEli' value="btnEliminar" onclick="eliminar_habitat('<?php echo $habitat['hab_id'] ?>')" ><i class="fa-solid fa-trash"></i></button> 
                                <button type="button" class="btn btn-light"  onclick="animales('<?php echo $habitat['hab_id'] ?>')" ><i class="fa-solid fa-paw"></i></button> 
                        
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
                        <li class="page-item <?php echo $_GET['pagina']<= 1 ? 'disabled' : ''?>"><a class="page-link" href="VistaHabitats.php?tbl=<?php echo $tabla."&info=".$buscar."&pagina=".$_GET['pagina']-1?>">Anterior</a></li>

                        <?php for($i=0;$i<$paginas;$i++): ?>
                        <li class="page-item <?php echo $_GET['pagina']== $i+1 ? 'active' : ''?>"><a class=" page-link" href="VistaHabitats.php?tbl=<?php echo $tabla."&info=".$buscar."&pagina=".$i+1?>"> <?php echo $i+1?> </a></li>
                        <?php endfor ?>

                        <li class="page-item <?php echo $_GET['pagina']>= $paginas ? 'disabled' : ''?>"><a class=" page-link" href="VistaHabitats.php?tbl=<?php echo $tabla."&info=".$buscar."&pagina=".$_GET['pagina']+1?>">Siguiente</a></li>
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
                <h5 class="modal-title" id="exampleModalLongTitle">NUEVO HABITAT</h5>
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
                                <td><label class="label lb-modal">*ANIMAL: </label></td>
                                <td><input type="text" id="txtNombreA" class="txt-modal"   maxlength="25"></td>
                            </tr>

                            <tr>
                                <td><label class="label lb-modal">*CLASIFICACION:</label></td>
                                <td>
                                    <select class="lista" id="txtClasificacion" value="">
                                        <option selected disabled ></option>
                                        <option class="opc" >TERRESTRE</option>
                                        <option class="opc" >AEREO</option>
                                        <option class="opc" ">ACUATICO</option>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td><label class="label lb-modal">*CAPACIDAD:</label></td>
                                <td><input type="text" id="txtCapacidad" class="txt-modal"    maxlength="25"></td>
                            </tr>

                            <tr>
                                <td><label class="label lb-modal">*HORARIO DE LIMPIEZA:</label></td>
                                <td><input type="time" id="txtLimpieza" class="txt-modal"  maxlength="25"></td>
                            </tr>

                            <tr>
                                <td><label class="label lb-modal">*HORARIO DE ALIMENTACION: </label></td>
                                <td>
                                    <table>
                                        <tr>
                                            <td><label class="label lb-modal">MAÑANA </label></td>
                                            <td><input type="time" id="txtAlimentacion1" class="txt3-modal"    maxlength="8"></td>
                                        </tr>
                                        <tr>
                                            <td><label class="label lb-modal">TARDE</label></td>
                                            <td><input type="time" id="txtAlimentacion2" class="txt3-modal"    maxlength="8"></td>
                                        </tr>
                                        <tr>
                                            <td><label class="label lb-modal">NOCHE </label></td>
                                            <td><input type="time" id="txtAlimentacion3" class="txt3-modal"    maxlength="8"></td>
                                        </tr>
                                    </table>

                                </td>
                               
                            </tr>

                           

                            
                        </table>          
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                <button type="button" class="btn btn-success" onclick="guardar_habitat()" id="btnGua" value="btnGuardar">GUARDAR</button>
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
                                <td><label class="lb-modal">*NOMBRE: </label></td>
                                <td><input type="text" id="ModtxtNombre" class="txt-modal"   maxlength="25"></input></td>
                            </tr>
                                
                            <tr>
                                <td><label class="label lb-modal">*ANIMAL: </label></td>
                                <td><input type="text" id="ModtxtNombreA" class="txt-modal"   maxlength="25"></td>
                            </tr>

                            <tr>
                                <td><label class="label lb-modal">*CLASIFICACION:</label></td>
                                <td>
                                    <select class="lista" id="ModtxtClasificacion" value="">
                                        <option selected disabled ></option>
                                        <option class="opc" >TERRESTRE</option>
                                        <option class="opc" >AEREO</option>
                                        <option class="opc">ACUATICO</option>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td><label class="label lb-modal">*CAPACIDAD:</label></td>
                                <td><input type="text" id="ModtxtCapacidad" class="txt-modal"    maxlength="25"></td>
                            </tr>

                            <tr>
                                <td><label class="label lb-modal">*HORARIO DE LIMPIEZA:</label></td>
                                <td><input type="time" id="ModtxtLimpieza" class="txt-modal"  maxlength="25"></td>
                            </tr>

                            <tr>
                                <td><label class="label lb-modal">*HORARIO DE ALIMENTACION: </label></td>
                                <td>
                                    <table>
                                        <tr>
                                            <td><label class="label lb-modal">MAÑANA </label></td>
                                            <td><input type="time" id="ModtxtAlimentacion1" class="txt3-modal"    maxlength="8"></td>
                                        </tr>
                                        <tr>
                                            <td><label class="label lb-modal">TARDE</label></td>
                                            <td><input type="time" id="ModtxtAlimentacion2" class="txt3-modal"    maxlength="8"></td>
                                        </tr>
                                        <tr>
                                            <td><label class="label lb-modal">NOCHE </label></td>
                                            <td><input type="time" id="ModtxtAlimentacion3" class="txt3-modal"    maxlength="8"></td>
                                        </tr>
                                    </table>

                                </td>
                               
                            </tr>

                            
                        </table>          
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                <button type="button" class="btn btn-warning" onclick="editar_habitat()" id="btnEdit" value="btnModificar" >EDITAR</button>
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

    <script src="Javascript/Habitats.js"></script>
</body>

</html>