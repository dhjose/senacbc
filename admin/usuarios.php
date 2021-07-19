
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

      <div class="logo">

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
          <li>
            <a href="./departamentos.php">
              <i class="now-ui-icons education_atom"></i>
              <p>Departamentos</p>
            </a>
          </li>
          <li>
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
          <li class="active ">
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
            <a class="navbar-brand" href="#pablo">Usuario en sesión. <?php  echo $_SESSION['admin_login'];?></a>
			  <?php

          require_once "../DBconect.php";

          if(isset($_REQUEST['btn_register'])) //compruebe el nombre del botón "btn_register" es el botón del formulario
          {
            $nombres = $_REQUEST['txt_nombres'];	//input nombre "txt_username"
      			$telefono = $_REQUEST['txt_telefono'];	//input nombre "txt_email"
      			$correo	= $_REQUEST['txt_correo'];	//input nombre "txt_password"
      			$direccion = $_REQUEST['txt_direccion'];	//seleccion nombre "txt_role"
      			$username = $_REQUEST['txt_username'];
      			$password	= $_REQUEST['txt_password'];
      			$centro = $_REQUEST['txt_centro'];
      			$role = $_REQUEST['txt_role'];

            if(empty($nombres)){
              $errorMsg[]="Ingrese nombre de usuario";	//Compruebe input nombre de usuario no vacío
            }
            else if(empty($telefono)){
              $errorMsg[]="Ingrese el teléfono";	//Revisar email input no vacio
            }
            else if(!filter_var($correo, FILTER_VALIDATE_EMAIL)){
              $errorMsg[]="Ingrese email valido";	//Verificar formato de email
            }
            else if(empty($direccion)){
              $errorMsg[]="Ingrese dirección";	//Revisar password vacio o nulo
            }
            else if(empty($username)){
              $errorMsg[]="Ingrese el nombre de usuario";	//Revisar password vacio o nulo
            }
            else if(strlen($password) < 6){
              $errorMsg[] = "Password de tener minimo 6 caracteres";	//Revisar password 6 caracteres
            }
            else if(empty($centro)){
              $errorMsg[]="Seleccione centro";	//Revisar password vacio o nulo
            }
            else if(empty($role)){
              $errorMsg[]="Seleccione rol";	//Revisar etiqueta select vacio
            }
            else
            {
              try
              {
                $select_stmt=$db->prepare("SELECT Correo,Username FROM usuario WHERE Correo=:correo OR Username=:uusername"); // consulta sql
      					$select_stmt->bindParam(":correo",$correo);
      					$select_stmt->bindParam(":uusername",$username);      //parámetros de enlace
      					$select_stmt->execute();
      					$row=$select_stmt->fetch(PDO::FETCH_ASSOC);

      				if($row['Correo']==$correo){
      						$errorMsg[]="Correo ya existe";
      					}
      					else if($row['Username']==$username){
      						$errorMsg[]="Usuario ya existe";
      }
      					else if(!isset($errorMsg))
                {
                  $insert_stmt=$db->prepare("INSERT INTO usuario(ID_Usuario,Nombre_y_apellido, Telefono, Correo, Direccion, Username, Password, Centro_ID, Rol_ID) VALUES(,:nombres,:telefono,:correo,:direccion,:uusername,:password,:centro,:role)"); //Consulta sql de insertar
      						$insert_stmt->bindParam(":nombres",$nombres);
      						$insert_stmt->bindParam(":telefeno",$telefono);	  		//parámetros de enlace
      						$insert_stmt->bindParam(":correo",$correo);
      						$insert_stmt->bindParam(":direccion",$direccion);
      						$insert_stmt->bindParam(":uusername",$username);
      						$insert_stmt->bindParam(":password",$password);
      						$insert_stmt->bindParam(":centro",$centro);
      						$insert_stmt->bindParam(":role",$role);

                  if($insert_stmt->execute())
                  {
                    $registerMsg="¡Bien hecho!, Registro exitoso"; //Ejecuta consultas
                    header("refresh:2;usuarios.php"); //Actualizar despues de 2 segundo a la portada
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
                <input type="text" value="" class="form-control" placeholder="Buscar...">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="now-ui-icons ui-1_zoom-bold"></i>
                  </div>
                </div>
              </div>
            </form>
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="">
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
                <a class="nav-link" href="#pablo">
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
                <h5 class="title">Registro de Usuarios</h5>
              </div>
              <div class="card-body">
                <form>
                  <div class="row">

                    <div class="col-md-3 px-1">
                      <div class="form-group">
                        <label>Identificación</label>
                        <input type="text" class="form-control" placeholder="Ingrese la id" name="txt_id" required>
                      </div>
                    </div>

                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label >Nombres y apellidos</label>
                        <input type="text" class="form-control" placeholder="Ingrese nombres y apellidos" name="txt_nombres" required>
                      </div>
                    </div>

                    <div class="col-md-3 pl-1">
                      <div class="form-group">
                        <label >Teléfono</label>
                        <input type="text" class="form-control" placeholder="Ingrese telefóno" name="txt_telefono" required>
                      </div>
                    </div>

                  </div>

                  <div class="row">


                    <div class="col-md-4 px-1">
                      <div class="form-group">
                        <label>Correo</label>
                        <input type="text" class="form-control" placeholder="Ingrese correo" name="txt_correo" required>
                      </div>
                    </div>

                    <div class="col-md-5 pl-1">
                      <div class="form-group">
                        <label >Dirección</label>
                        <input type="text" class="form-control" placeholder="Ingrese dirección" name="txt_direccion" required>
                      </div>
                    </div>

                    <div class="col-md-3 pl-1">
                      <div class="form-group">
                        <label >Nombre de usuario</label>
                        <input type="text" class="form-control" placeholder="Ingrese username" name="txt_username" required>
                      </div>
                    </div>


                  </div>

                  <div class="row">

                    <div class="col-md-4 px-1">
                      <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" placeholder="Ingrese password" name="txt_password" required>
                      </div>
                    </div>

                    <div class="col-md-5 pl-1">
                      <div class="form-group">
                        <label >Seleccione centro</label>
                        <select class="form-control"  name="txt_centro">
                		        <option value="0" selected="selected"> - seleccione centro- </option>
                		        <!--<option value="admin">Admin</option>-->
                						<?php
                						require_once '../DBconect.php';
                						$select_stmt=$db->prepare("SELECT * FROM centro");
                						$select_stmt->execute();

                						while($row=$select_stmt->fetch(PDO::FETCH_ASSOC))
                						{
                							echo '<option value="'.$row[ID_Centro].'">'.$row[Centro].'</option>';
                						}
                						?>
                		    </select>
                      </div>
                    </div>

                    <div class="col-md-3 pl-1">
                      <div class="form-group">
                        <label >Seleccione rol</label>
                        <select class="form-control" name="txt_role">
                		        <option value="0" selected="selected"> - seleccione rol - </option>
                		        <!--<option value="admin">Admin</option>-->
                						<?php
                						require_once '../DBconect.php';
                						$select_stmt=$db->prepare("SELECT * FROM rol");
                						$select_stmt->execute();

                						while($row=$select_stmt->fetch(PDO::FETCH_ASSOC))
                						{
                							echo '<option value="'.$row[ID_Rol].'">'.$row[Rol].'</option>';
                						}
                						?>
                		    </select>
                      </div>
                    </div>

                  </div>



                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <input type="submit" name="btn_register" class="btn btn-primary btn-block" value="Registro">
                      </div>
                    </div>

                      <div class="col-md-6 pr-1">
                        <div class="form-group">
                          <a href="index.php" class="btn btn-primary btn-danger">Cancelar</a>
                        </div>

                    </div>

                  </div>
                  </form>
              </div>
            </div>
          </div>





<!---PANEL DE CIUDADES DENTRO DE LA BASE DE DATOS-->
          <div class="col-lg-12">
              <div class="panel panel-default">
                  <div class="panel-heading">
                      Panel de usuarios
                  </div>

                  <div class="col-md-4 px-1">
                    <div class="form-group">
                      <label>Busquedas</label>
                      <input type="text" class="form-control" placeholder="Buscar..." name="txt_buscar">
                      <button class="btn btn-danger"><span class="glyphicon" aria-hidden="true"></span>Buscar</button>
                    </div>
                  </div>

                  <!-- /.panel-heading -->
                  <div class="panel-body">
                      <div class="table-responsive">
                          <table class="table table-striped table-bordered table-hover">
                              <thead>
                                  <tr>
                                    <th width="4%">ID</th>
                                    <th width="18%">Nombres y Apellidos</th>
                                    <th width="10%">Telefono</th>
                                    <th width="15%">Correo</th>
                                    <th width="18%">Dirección</th>
                                    <th width="10%">Usuario</th>
                                    <th width="10%">password</th>
                                    <th width="9%">Centro Id</th>
                                    <th width="4%">Rol</th>
                                    <th colspan="2">Opciones</th>
                                  </tr>
                              </thead>
                              <tbody>
            <?php
            require_once '../DBconect.php';
            $select_stmt=$db->prepare("SELECT * FROM usuario");
            $select_stmt->execute();

            while($row=$select_stmt->fetch(PDO::FETCH_ASSOC))
            {
            ?>
                                  <tr>
                                    <td><?php echo $row["ID_Usuario"]; ?></td>
                                    <td><?php echo $row["Nombre_y_apellido"]; ?></td>
                                    <td><?php echo $row["Telefono"]; ?></td>
                                    <td><?php echo $row["Correo"]; ?></td>
                                    <td><?php echo $row["Direccion"]; ?></td>
                                    <td><?php echo $row["Username"]; ?></td>
                                    <td><?php echo $row["Password"]; ?></td>
                                    <td><?php echo $row["Centro_ID"]; ?></td>
                                    <td><?php echo $row["Rol_ID"]; ?></td>

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
