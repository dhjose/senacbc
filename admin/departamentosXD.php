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
					El susuario en sesion es,
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
			$departamento = $_REQUEST['txt_departamento'];	//input nombre "txt_username"

			if(empty($departamento)){
				$errorMsg[]="Ingrese departamento";	//Compruebe input nombre de usuario no vacío
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
						$errorMsg[]="Departamento ya existe";	//Verificar usuario existente
					}
					/*else if($row['Correo']==$correo){
						$errorMsg[]="Correo ya existe";	//Verificar email existente
					}

					else */if(!isset($errorMsg))
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
		<center><h2>Registrar Departamento</h2></center>
		<form method="post" class="form-horizontal">

		<div class="form-group">
		<label class="col-sm-9 text-left">Nombres Departamento</label>
		<div class="col-sm-12">
		<input type="text" name="txt_departamento" class="form-control" placeholder="Ingrese Departamento" />
		</div>
		</div>

		<div class="form-group">
		<div class="col-sm-12">
		<input type="submit" name="btn_register" class="btn btn-primary btn-block" value="Registro">
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
                            Panel de Departamentos
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th width="4%">ID</th>
                                            <th width="18%">Departamentos</th>
                                            <th colspan="2">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									require_once '../DBconect.php';
									$select_stmt=$db->prepare("SELECT ID_Departamento, Departamento FROM departamento");
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
	<?php include("../header.php");?>
	</body>
</html>
