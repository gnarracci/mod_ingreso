<?php 
session_start();
//quitamos la variable global
unset($_SESSION['INGRESO']);
if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
	$uri = 'https://';
}else{
	$uri = 'http://';
}
$uri .= $_SERVER['HTTP_HOST'];
// se redirecciona a la pagina de inicio
header("location: index.php");		   

?>


