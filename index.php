<?php
ini_set ('display_errors', 0);
    error_reporting (0);
?>

<html>
<head>
	<style>
		.principal{
			width: 22%;
			margin-right: auto;
			margin-bottom: auto;
			margin-top:  auto;
			margin-left: auto;	
			background: #CDC9C9;
			border: 1;
			padding: 20px;
			box-shadow: 0px 0px 10px 12px #8B8682;
		}
		body{
			margin-right: auto;
			margin-bottom: auto;
			margin-top:  auto;
			margin-left: auto;	
			background: #FFFAFA;
			padding: 20px;
			font-family: Arial;
			font-weight: bold;
			font-size: 15px;
			
		}
		.espaco{ height: 15px; display: block;}
		input{ font-size: 15px; padding: 5px; }
		button{ font-size: 12px; padding: 2px; }
		label{ font-size: 18px; padding: 2px; font-family: colibri; font-weight: bold; }
		.titulo{font-weight: bold;
				font-family: Arial Black;
				font-size: 20px;
				text-align: center; 
				margin: 0 auto;}
		.conteudo{font-weight: bold;
				  color: red;
				  font-family: Arial Black;
				  font-size: 15px; 
				  margin: auto;
				  }
		a:link {
			text-decoration:none;
			color: #4F4F4F;
			}
		a:visited {
			text-decoration:none;
			color: #4F4F4F;	
		}
		
	</style>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Método da Secante</title>
</head>
<body>
	
	
	<form action="index.php" method="POST" class="principal">
		<center><h3 class="titulo">Método da Secante</h1></center>
	<p class="espaco"></p>

		<TABLE>
			<TR>
				<TD>
					<label>f(x): </label>
				</TD>
				<TD>
				    <input required type="text" name="funcao" value="<?php if(isset($_SESSION)) { echo $_SESSION['funcao'];}?>" >
				</TD>
			</TR>
			<TR>
				<TD>
					<label>Chute Inicial: </label>
				</TD>
				<td>
					<label>x0:</label>
		   			<input required type="float" size="2" name="x0" value="<?php echo $_SESSION['x0'] ?>">
					<label>x1:</label>
		            <input required type="float" size="2" name="x1" value="<?php if(isset($_SESSION)) { echo $_SESSION['x1'];} ?>" >
		        </TD>
		
			</TR>
			<TR>
				<TD>
					<label>Erro: </label>
				</TD>
				<TD>
					<input required type="float" name="erro"  value="<?php if(isset($_SESSION)) {echo $_SESSION['erro']; }?>">
				</TD>
			</TR>
			<TR>
				<TD>
					<label>Max de interações: </label> 
				</TD>
				<td>
				    <input requided type="number" name="nks" min="1" value="<?php if(isset($_SESSION)) { echo $_SESSION['nks']; }?>">
				</TD>
			</TR>
			<TR>
				<TD>
				</TD>
				<td><input type="submit" name="confirmar" value="Calcular"></td>
			</TR>
		<TABLE>
	</form>


<?php 

	if(isset($_POST['confirmar'])){


	if(!isset($_SESSION))
			session_start();

		foreach ($_POST as $chave => $valor) {
			$_SESSION[$chave] = $valor;
		}

	
	$x[0]   = $_SESSION['x0'];
	$x[1]   = $_SESSION['x1'];
	$e      = $_SESSION['erro'];
	$nks    = $_SESSION['nks'];
	$k      = 0;

	
	$funcao = $_SESSION['funcao'];
    $fx  = str_ireplace("xk","\$x[\$k]", $funcao);
    $fx  = str_replace(" ", "", $fx);
    
    eval('$f[$k] = '.$fx.';');
  
	

?>

	<table border=2 cellpadding=8 bgcolor="#E6E8FA" cellspacing="0">
	
	<p class="espaco"></p>

	<tr class=titulo>
		<td>k </td>
		<td>xk </td>
		<td>f(xk)</td>
	</tr>
		
	
			<tr>
				<td> <?php echo $k; ?> </td>

				<td> <?php echo $x[$k]; ?> </td>

				<td> <?php echo $f[$k] ?> </td>
			</tr>
			<tr>
	<?php do{ 
				$k = $k+1;
	
				eval('$f[$k] = '.$fx.';');
	
				$x[$k+1] = $x[$k] - (( $f[$k] * ($x[$k] - $x[$k-1])) /  ( $f[$k] - $f[$k-1] ));
	?>
				
				<td> <?php echo $k; ?> </td>

				<td> <?php echo $x[$k]; ?> </td>

				<td> <?php echo $f[$k]; ?> </td>
			</tr>
<?php	
			}while ( (abs($x[$k+1] - $x[$k]) /  abs($x[$k+1])) > $e && $k < $nks-1 );

			$k = $k+1;
	
				eval('$f[$k] = '.$fx.';');
	
				$x[$k+1] = $x[$k] - (( $f[$k] * ($x[$k] - $x[$k-1])) /  ( $f[$k] - $f[$k-1] ));
		 		
	 		

?>
			<tr class="conteudo">
				<td> <?php echo $k; ?> </td>

				<td> <?php echo $x[$k]; ?> </td>

				<td> <?php echo $f[$k] ?> </td>
			</tr>
	</table>
<?php
}			
?>
	<p class="espaco"></p>
	<center><a href="listadefuncoes.php">Lista de Funções</a></center>
	
</body>