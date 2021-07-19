
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <title>
    GÉNESIS - Sistema de correspondencia
  </title>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <script src="../js/jquery-1.12.4-jquery.min.js"></script>
  <script src="../bootstrap/js/bootstrap.min.js"></script>

  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />
</head>
	<?php
	session_start();

	if(!isset($_SESSION['admin_login']))
	{
		header("location: ../index.php");
	}

	if(isset($_SESSION['personal_login']))
	{
		header("location: ../personal/personal_portada.php");
	}

	if(isset($_SESSION['usuarios_login']))
	{
		header("location: ../usuarios/usuarios_portada.php");
	}
?>
</center>
<body class="user-profile">
  <div class="wrapper ">
    <div class="sidebar" data-color="orange">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo">
        <!--<a href="http://www.creative-tim.com" class="simple-text logo-mini">
          CT
        </a>-->
        <a href="https://www.sena.edu.co/" class="simple-text logo-normal">
          GÉNESIS
        </a>
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
          <li>
            <a href="index.php">
              <i class="now-ui-icons design_app"></i>
              <p>Menú</p>
            </a>
          </li>
          <li class="active ">
            <a href="./departamentos.php">
              <i class="now-ui-icons education_atom"></i>
              <p>Departamentos</p>
            </a>
          </li>
          <li >
            <a href="./ciudad.php">
              <i class="now-ui-icons location_map-big"></i>
              <p>Ciudades</p>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="now-ui-icons ui-1_bell-53"></i>
              <p>Notificaciones</p>
            </a>
          </li>
          <li >
            <a href="./usuarios.php">
              <i class="now-ui-icons users_single-02"></i>
              <p>Usuarios</p>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="now-ui-icons design_bullet-list-67"></i>
              <p>Lista de Tablas</p>
            </a>
          </li>

        </ul>
      </div>
    </div>
    <div class="main-panel" id="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo">Usuario en sesión. <?php  echo $_SESSION['admin_login'];?></a><br>
			  <?php

          require_once "../DBconect.php";

          if(isset($_REQUEST['btn_register'])) //compruebe el nombre del botón "btn_register" es el botón del formulario
          {
            $departamento = $_REQUEST['txt_departamento'];
            if(empty($departamento)){
              $errorMsg[]="Ingrese departamento";	//Compruebe input nombre no vacío
            }

            else
            {
              try
              {
                $select_stmt=$db->prepare("SELECT Departamento FROM departamento WHERE Departamento=:departamento "); // consulta sql
                $select_stmt->bindParam(":departamento",$departamento);
                $select_stmt->execute();
                $row=$select_stmt->fetch(PDO::FETCH_ASSOC);
                if($row['Departamento']==$departamento){
                $errorMsg[]="el departamento ya fue registrado";	//Verificar que el departamento existente
                }
                if(!isset($errorMsg))
                {
                  $insert_stmt=$db->prepare("INSERT INTO departamento(Departamento) VALUES(:departamento)"); //Consulta sql de insertar
      						$insert_stmt->bindParam(":departamento",$departamento);

                  if($insert_stmt->execute())
                  {
                    $registerMsg="¡Bien hecho!, Registro exitoso"; //Ejecuta consultas
                    header("refresh:2;departamentos.php"); //Actualizar despues de 2 segundo a la portada
                  }
                }
              }
              catch(PDOException $e)
              {
                echo $e->getMessage();
              }
            }
          }
          include("../DBconect.php");
          ?>

              <?php
              if(isset($errorMsg))
              {
                foreach($errorMsg as $error)
                {
                ?>
                  <div class="alert alert-danger">
                    <strong>INCORRECTO ! <?php echo $error; ?></strong>
                  </div>
                      <?php
                }
              }
              if(isset($registerMsg))
              {
              ?>
                <div class="alert alert-success">
                  <strong>EXITO ! <?php echo $registerMsg; ?></strong>
                </div>
                  <?php
              }
              ?>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <form>
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="now-ui-icons ui-1_zoom-bold"></i>
                  </div>
                </div>
              </div>
            </form>
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="#pablo">
                  <i class="now-ui-icons media-2_sound-wave"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Stats</span>
                  </p>
                </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="now-ui-icons location_world"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="index.php">Menú</a>
                  <a class="dropdown-item" href="#">Perfil</a>
                  <a class="dropdown-item" href="../cerrar_sesion.php">Salir</a>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <i class="now-ui-icons users_single-02"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Account</span>
                  </p>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->



      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h5 class="title">Registro de Departamentos</h5>
              </div>
              <div class="card-body">
                <form>
                  <div class="row">
                    <div class="col-md-6 px-1">
                      <div class="form-group">
                        <label>Nombre del Departamento</label>
                        <input type="text" class="form-control" placeholder="Ingrese el departamento" name="txt_departamento" required>
                      </div>
                    </div>

                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <input type="submit" name="btn_register" class="btn btn-primary btn-block" value="Registro">
                      </div>
                    </div>

                  </div>
                  </form>
              </div>
            </div>
          </div>





<!---PANEL DE CIUDADES DENTRO DE LA BASE DE DATOS-->
          <div class="col-lg-6">
              <div class="panel panel-default">
                  <div class="panel-heading">
                      Panel de Departamentos
                  </div>
                  <!-- /.panel-heading -->
                  <div class="panel-body">
                      <div class="table-responsive">
                          <table class="table table-striped table-bordered table-hover">
                              <thead>
                                  <tr>
                                      <th width="4%">ID</th>
                                      <th width="18%">Departamento</th>
                                      <th colspan="2">Opciones</th>
                                  </tr>
                              </thead>
                              <tbody>
            <?php
            require_once '../DBconect.php';
            $select_stmt=$db->prepare("SELECT * FROM departamento");
            $select_stmt->execute();

            while($row=$select_stmt->fetch(PDO::FETCH_ASSOC))
            {
            ?>
                                  <tr>
                                      <td><?php echo $row["ID_Departamento"]; ?></td>
                                      <td><?php echo $row["Departamento"]; ?></td>

                <td width="4%"><button class="btn btn-primary"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button></td>
                <td width="7%"><button class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></td>
                                  </tr>
            <?php
            }
            ?>
                              </tbody>
                          </table>
                      </div>
                      <!-- /.table-responsive -->
                  </div>
                  <!-- /.panel-body -->
              </div>
              <!-- /.panel -->
          </div>


        </div>
      </div>

  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script><!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="assets/demo/demo.js"></script>
</body>

</html>
