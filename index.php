<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
<title>Génesis - Sistema de correspondencia</title>

<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<script src="js/jquery-1.12.4-jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
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

		.contenido1{
			width: 40%;
		  float: left;
		  margin: 0;
}
.contenido2{
	width: 40%;
	float: right;
	margin: 0;
}
</style>
</head>
	<body>
<?php
require_once 'DBconect.php';
session_start();
if(isset($_SESSION["admin_login"]))	//Condicion admin
{
	header("location: admin/index.php");
}
if(isset($_SESSION["personal_login"]))	//Condicion personal
{
	header("location: personal/index.php");
}
if(isset($_SESSION["usuarios_login"]))	//Condicion Usuarios
{
	header("location: usuarios/index.php");
}

if(isset($_REQUEST['btn_login']))
{
	$usuario =$_REQUEST["txt_usuario"];	//textbox nombre "txt_email"
	$password	=$_REQUEST["txt_password"];	//textbox nombre "txt_password"
	$role		=$_REQUEST["txt_role"];		//select opcion nombre "txt_role"

	if(empty($usuario)){
		$errorMsg[]="Por favor ingrese el usuario";	//Revisar email
	}
	else if(empty($password)){
		$errorMsg[]="Por favor ingrese Password";	//Revisar password vacio
	}
	else if(empty($role)){
		$errorMsg[]="Por favor seleccione rol ";	//Revisar rol vacio
	}
	else if($usuario AND $password AND $role)
	{
		try
		{
			$select_stmt=$db->prepare("SELECT Username, Password, Rol_ID FROM usuario WHERE Username=:uusuario AND Password=:upassword AND Rol_ID=:urole");
			$select_stmt->bindParam(":uusuario",$usuario);
			$select_stmt->bindParam(":upassword",$password);
			$select_stmt->bindParam(":urole",$role);
			$select_stmt->execute();	//execute query

			while($row=$select_stmt->fetch(PDO::FETCH_ASSOC))
			{
				$dbusuario	=$row["Username"];
				$dbpassword	=$row["Password"];
				$dbrole		=$row["Rol_ID"];
			}
			if($usuario!=null AND $password!=null AND $role!=null)
			{
				if($select_stmt->rowCount()>0)
				{
					if($usuario==$dbusuario and $password==$dbpassword and $role==$dbrole)
					{
						switch($dbrole)		//inicio de sesión de usuario base de roles
						{
							case "1":
								$_SESSION["admin_login"]=$usuario;
								$loginMsg="Admin: Inicio sesión con éxito";
								header("refresh:1;admin/index.php");
								break;

							case "2";
								$_SESSION["personal_login"]=$usuario;
								$loginMsg="Personal: Inicio sesión con éxito";
								header("refresh:1;personal/personal_portada.php");
								break;

							case "usuarios":
								$_SESSION["usuarios_login"]=$usuario;
								$loginMsg="Usuario: Inicio sesión con éxito";
								header("refresh:1;usuarios/usuarios_portada.php");
								break;

							default:
								$errorMsg[]="Usuario, contraseña o rol incorrectos";
						}
					}
					else
					{
						$errorMsg[]="Usuario, contraseña o rol incorrectos";
					}
				}
				else
				{
					$errorMsg[]="Usuario, contraseña o rol incorrectos";
				}
			}
			else
			{
				$errorMsg[]="Usuario, contraseña o rol incorrectos";
			}
		}
		catch(PDOException $e)
		{
			$e->getMessage();
		}
	}
	else
	{
		$errorMsg[]="Usuario, contraseña o rol incorrectos";
	}
}

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
					<strong><?php echo $error; ?></strong>
				</div>
            <?php
			}
		}
		if(isset($loginMsg))
		{
		?>
			<div class="alert alert-success">
				<strong>ÉXITO ! <?php echo $loginMsg; ?></strong>
			</div>
        <?php
		}
		?>
<div class="contenido1">
		<div class="login-form">
			<h1>Bienvenido</h1>
			<p><strong>GÉNESIS:</strong>
	Es el sistemta de gestión de correspondencia utilizado para conocer estado y lugar de tú correspondencia, fue desarrollado para hacer más efectivo la consecución de tu correspondencia</p>

	</div>
</div>
<div class="contenido2">
<div class="login-form">
<center><h1>Iniciar sesión</h1></center>
<form method="post" class="form-horizontal">
  <div class="form-group">
  <label class="col-sm-6 text-left">Usuario</label>
  <div class="col-sm-12">
  <input type="text" name="txt_usuario" class="form-control" placeholder="Ingrese usuario" />
  </div>
  </div>

  <div class="form-group">
  <label class="col-sm-6 text-left">Password</label>
  <div class="col-sm-12">
  <input type="password" name="txt_password" class="form-control" placeholder="Ingrese passowrd" />
  </div>
  </div>

  <div class="form-group">
      <label class="col-sm-6 text-left">Seleccionar rol</label>
      <div class="col-sm-12">
      <select class="form-control" name="txt_role">
          <option value="" selected="selected"> - selecccionar rol - </option>
          <option value="1">Admin</option>
          <option value="2">Usuario</option>
      </select>
      </div>
  </div>

  <div class="form-group">
  <div class="col-sm-12">
  <input type="submit" name="btn_login" class="btn btn-success btn-block" value="Iniciar Sesion">
  </div>
  </div>

  <!--<div class="form-group">
  <div class="col-sm-12">
  ¿No tienes una cuenta? <a href="registro.php"><p class="text-info">Registrar Cuenta</p></a>
  </div>
</div>-->

</form>
</div>
</div>
</div>
<!--Cierra div login-->
		</div>

	</div>

	</div>
<?php include("cabecerainicial.php"); ?>
	</body>
</html>
