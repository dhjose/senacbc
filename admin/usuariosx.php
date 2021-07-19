<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
<title>Génesis - Sistema de correspondencia</title>

<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<script src="../js/jquery-1.12.4-jquery.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<style type="text/css">
	.login-form {
		width: 340px;
    	margin: 20px auto;
	}
    .login-form form {
    	margin-bottom: 15px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
    .login-form h2 {
        margin: 0 0 15px;
    }
    .form-control, .btn {
        min-height: 38px;
        border-radius: 2px;
    }
    .btn {
        font-size: 15px;
        font-weight: bold;
    }
		.redonda {
			width:200px;
    	height:200px;
    	border-radius:150px;
		}
</style>
</head>
	<body>

	<div class="wrapper">

	<div class="container">

		<div class="col-lg-12">

			<center>
			<h3>
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

				if(isset($_SESSION['admin_login']))
				{
				?>
					El usuario en sesion es,
				<?php
						echo $_SESSION['admin_login'];
				}
				?>
				</h3>

			</center>

		</div>
		<?php

		require_once "../DBconect.php";

		if(isset($_REQUEST['btn_register'])) //compruebe el nombre del botón "btn_register" y configúrelo
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
							header("refresh:2;index.php"); //Actualizar despues de 2 segundo a la portada
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
			<div class="wrapper">

			<div class="container">

				<div class="col-lg-12">

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
		<div class="login-form">
		<center><h2>Registrar Usuarios</h2></center>
		<form method="post" class="form-horizontal">

		<div class="form-group">
		<label class="col-sm-9 text-left">Nombres y apellidos</label>
		<div class="col-sm-12">
		<input type="text" name="txt_nombres" class="form-control" placeholder="Ingrese nombres y apellidos" />
		</div>
		</div>

		<div class="form-group">
		<label class="col-sm-9 text-left">Teléfono</label>
		<div class="col-sm-12">
		<input type="text" name="txt_telefono" class="form-control" placeholder="Ingrese teléfono" />
		</div>
		</div>

		<div class="form-group">
		<label class="col-sm-9 text-left">Correo</label>
		<div class="col-sm-12">
		<input type="text" name="txt_correo" class="form-control" placeholder="Ingrese correo" />
		</div>
		</div>

		<div class="form-group">
		<label class="col-sm-9 text-left">Dirección</label>
		<div class="col-sm-12">
		<input type="text" name="txt_direccion" class="form-control" placeholder="Ingrese dirección" />
		</div>
		</div>

		<div class="form-group">
		<label class="col-sm-9 text-left">Nombre de usuario</label>
		<div class="col-sm-12">
		<input type="text" name="txt_username" class="form-control" placeholder="Ingrese nombre de usuario" />
		</div>
		</div>

		<div class="form-group">
		<label class="col-sm-9 text-left">Password</label>
		<div class="col-sm-12">
		<input type="password" name="txt_password" class="form-control" placeholder="Ingrese password" />
		</div>
		</div>

		<div class="form-group">
		    <label class="col-sm-9 text-left">Seleccione centro</label>
		    <div class="col-sm-12">
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


		<div class="form-group">
		    <label class="col-sm-9 text-left">Seleccione rol</label>
		    <div class="col-sm-12">
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

		<div class="form-group">
		<div class="col-sm-12">
		<input type="submit" name="btn_register" class="btn btn-warning btn-block" value="Registro">
		<!--<a href="index.php" class="btn btn-danger">Cancel</a>-->
		</div>
		</div>


		</form>
		</div><!--Cierra div login-->
				</div>

			</div>

			</div>
		<br><br><br>
		<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Panel de usuarios
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th width="4%">ID</th>
                                            <th width="18%">Nombre y Apellido</th>
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
	<?php include("../header.php");?>
	</body>
</html>
