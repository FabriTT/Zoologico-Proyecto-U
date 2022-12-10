<?php
  
  
  $nombre=(isset($_GET['n']))?$_GET['n']:"";
  $apellido=(isset($_GET['a']))?$_GET['a']:"";
  $cargo=(isset($_GET['c']))?$_GET['c']:"";
  $imagen=(isset($_GET['i']))?$_GET['i']:"";


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bioparque Vesty Pakos</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="estilos.css">
  
  
</head>
<body class="hold-transition sidebar-mini">

<input type="hidden" class="form-control" id="OcultoCargo"  value="<?php echo $cargo ?>" >

<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background-color: rgb(0, 0, 0);">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button" style="color: white;"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      

      
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item">
        <a class="nav-link"  href="#" role="button" onclick="GenerarBackup()" id="btnBackup" style="color: white;">BACKUP&nbsp;&nbsp;
          <i class="nav-icon fas fa-solid fa-database"></i>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button" onclick="Maximizar()" style="color: white;">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="../Login/index.html" role="button" style="color: white;">
          <i class="fas fa-sign-out-alt"></i>
        </a>
      </li>

    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4 color">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="dist/img/logo2.jpeg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-dark color-text" style="color: white;">Vesty Pakos Sofro</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../Imagenes/<?php echo $imagen?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $nombre." ".$apellido ?></a>
        </div>
      </div>

      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          <li class="nav-item menu">
            <a href="#" class="nav-link" id="btnEmpleado">
              <i class="nav-icon fas fa-solid fa-user-tie"></i>
              <p>
                Empleados
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a class="nav-link" onclick="Empleados()" style="margin-left: 15px;">
                  <i class="nav-icon fas fa-solid fa-address-book"></i>
                  <p>Registros</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" onclick="EmpleadosEli()" style="margin-left: 15px;">
                  <i class="nav-icon fas fa-solid fa-trash"></i>
                  <p>Registros Eliminados</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../Reportes/ReporteEmpleados.php" class="nav-link" style="margin-left: 15px;">
                  <i class="nav-icon fas fa-solid fa-file-pdf"></i>
                  <p>Reportes</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item menu">
            <a href="#" class="nav-link" id="btnHabitats">
              <i class="nav-icon fas fa-solid fa-tree"></i>
              <p>
                Habitats
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link" style="margin-left: 15px;" onclick="Habitats()">
                  <i class="nav-icon fas fa-solid fa-address-book"></i>
                  <p>Registros</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" style="margin-left: 15px;" onclick="HabitatsEli()">
                  <i class="nav-icon fas fa-solid fa-trash"></i>
                  <p>Registros Eliminados</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../Reportes/ReporteHabitats.php" class="nav-link" style="margin-left: 15px;">
                  <i class="nav-icon fas fa-solid fa-file-pdf"></i>
                  <p>Reportes</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item menu">
            <a href="#" class="nav-link" id="btnAnimales">
              <i class="nav-icon fas fa-solid fa-paw"></i>
              <p>
                Animales
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link" style="margin-left: 15px;" onclick="Animales()">
                  <i class="nav-icon fas fa-solid fa-address-book"></i>
                  <p>Registros</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link"  style="margin-left: 15px;" onclick="AnimalesEli()">
                  <i class="nav-icon fas fa-solid fa-trash"></i>
                  <p>Registros Eliminados</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../Reportes/ReporteAnimales.php" class="nav-link" style="margin-left: 15px;">
                  <i class="nav-icon fas fa-solid fa-file-pdf"></i>
                  <p>Reportes</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item menu">
            <a href="#" class="nav-link" id="btnAlimentos">
              <i class="nav-icon fas fa-solid fa-drumstick-bite"></i>
              <p>
                Alimentos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link" style="margin-left: 15px;" onclick="Alimentos()">
                  <i class="nav-icon fas fa-solid fa-address-book"></i>
                  <p>Registros</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" style="margin-left: 15px;" onclick="AlimentosEli()"> 
                  <i class="nav-icon fas fa-solid fa-trash"></i>
                  <p>Registros Eliminados</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../Reportes/ReporteAlimentos.php" class="nav-link" style="margin-left: 15px;">
                  <i class="nav-icon fas fa-solid fa-file-pdf"></i>
                  <p>Reportes</p>
                </a>
              </li>
            </ul>
          </li>


          <li class="nav-item menu">
            <a href="#" class="nav-link" id="btnMedicamentos">
              <i class="nav-icon fas fa-solid fa-briefcase-medical"></i>
              <p>
                Medicamentos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link" style="margin-left: 15px;" onclick="Medicamentos()">
                  <i class="nav-icon fas fa-solid fa-address-book"></i>
                  <p>Registros</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" style="margin-left: 15px;" onclick="MedicamentosEli()">
                  <i class="nav-icon fas fa-solid fa-trash"></i>
                  <p>Registros Eliminados</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../Reportes/ReporteMedicamentos.php" class="nav-link" style="margin-left: 15px;">
                  <i class="nav-icon fas fa-solid fa-file-pdf"></i>
                  <p>Reportes</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item menu">
            <a href="#" class="nav-link" id="btnHalimentos">
              <i class="nav-icon fas fa-regular fa-clipboard-list"></i>
              <p>
                Historial alimenticio
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link" style="margin-left: 15px;" onclick="HistorialesAlimenticios()">
                  <i class="nav-icon fas fa-solid fa-address-book"></i>
                  <p>Registros</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" style="margin-left: 15px;" onclick="HistorialesAlimenticiosEli()">
                  <i class="nav-icon fas fa-solid fa-trash"></i>
                  <p>Registros Eliminados</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../Reportes/ReporteHistorialesAlimenticios.php" class="nav-link" style="margin-left: 15px;">
                  <i class="nav-icon fas fa-solid fa-file-pdf"></i>
                  <p>Reportes</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item menu">
            <a href="#" class="nav-link" id="btnHmedicamentos">
              <i class="nav-icon fas fa-solid fa-file-medical"></i>
              <p>
                Historial medico
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link" style="margin-left: 15px;" onclick="HistorialesMedicos()">
                  <i class="nav-icon fas fa-solid fa-address-book"></i>
                  <p>Registros</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" style="margin-left: 15px;" onclick="HistorialesMedicosEli()"> 
                  <i class="nav-icon fas fa-solid fa-trash"></i>
                  <p>Registros Eliminados</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../Reportes/ReporteHistorialesMedicos.php" class="nav-link" style="margin-left: 15px;">
                  <i class="nav-icon fas fa-solid fa-file-pdf"></i>
                  <p>Reportes</p>
                </a>
              </li>
            </ul>
          </li>


          

          <li class="nav-item menu">
            <a href="#" class="nav-link" id="btnVentas">
              <i class="nav-icon fas fa-solid fa-dollar-sign"></i>
              <p>
                Ventas
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" onclick="Planificaciones()" class="nav-link" style="margin-left: 15px;">
                  <i class="nav-icon fas fa-solid fa-address-book"></i>
                  <p>Registros</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" onclick="PlanificacionesEli()" style="margin-left: 15px;">
                  <i class="nav-icon fas fa-solid fa-trash"></i>
                  <p>Registros Eliminados</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" onclick="Graficas()" style="margin-left: 15px;">
                  <i class="nav-icon fas fa-solid fa-chart-line"></i>
                  <p>Graficas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../Reportes/ReportePlanificaciones.php" class="nav-link" style="margin-left: 15px;">
                  <i class="nav-icon fas fa-solid fa-file-pdf"></i>
                  <p>Reportes</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item menu">
            <a href="#" class="nav-link" id="btnSeguridad">
              <i class="nav-icon fas fa-solid fa-user-shield"></i>
              <p>
                Seguridad
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" onclick="AuditoriaEmpleados()" class="nav-link" style="margin-left: 15px;">
                  <i class="nav-icon fas fa-solid fa-file-signature"></i>
                  <p>Auditoria empleados</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" onclick="AuditoriaHabitats()" class="nav-link" style="margin-left: 15px;">
                  <i class="nav-icon fas fa-solid fa-file-signature"></i>
                  <p>Auditoria habitats</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" onclick="AuditoriaAnimales()" class="nav-link" style="margin-left: 15px;">
                  <i class="nav-icon fas fa-solid fa-file-signature"></i>
                  <p>Auditoria animales</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" onclick="AuditoriaAlimentos()" class="nav-link" style="margin-left: 15px;">
                  <i class="nav-icon fas fa-solid fa-file-signature"></i>
                  <p>Auditoria alimentos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" onclick="AuditoriaMedicamentos()" class="nav-link" style="margin-left: 15px;">
                  <i class="nav-icon fas fa-solid fa-file-signature"></i>
                  <p>Auditoria medicamentos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" onclick="AuditoriaHistorialesAlimenticios()" class="nav-link" style="margin-left: 15px;">
                  <i class="nav-icon fas fa-solid fa-file-signature"></i>
                  <p>Auditoria h. alimenticios</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" onclick="AuditoriaHistorialesMedicos()" class="nav-link" style="margin-left: 15px;">
                  <i class="nav-icon fas fa-solid fa-file-signature"></i>
                  <p>Auditoria h. medicos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" onclick="AuditoriaPlanificaciones()" class="nav-link" style="margin-left: 15px;">
                  <i class="nav-icon fas fa-solid fa-file-signature"></i>
                  <p>Auditoria ventas</p>
                </a>
              </li>
            </ul>
          </li>
          
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="content">
      <div class="Container">
        <div class="row">
          <div class="col">
            <div class="card">
              <iframe class="xiframe" id ="iframeDashboard" ></iframe>
            </div>
          </div> 
        </div>
      </div>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2022 <a href="#">Unifranz</a>.</strong> Reservados todos los derechos.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="../Javascript/DashBoard.js"></script>

</body>
</html>
