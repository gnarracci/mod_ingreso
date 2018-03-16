<?php
session_start();
require_once 'PasswordHash.Class.php';
//Para redireccionar si es que no se cumple
//el logeo
if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
  $uri = 'https://';
}else{
  $uri = 'http://';
}
$uri .= $_SERVER['HTTP_HOST'];

if(!empty($_SESSION['INGRESO'])){
  if(count($_SESSION['INGRESO'])>0){
	  	  //Recuperamos datos del arreglo
    $IDusr		=$_SESSION['INGRESO']["Id"];
    $Ipusr		=$_SESSION['INGRESO']["Ip"];
    $Claveusr   =$_SESSION['INGRESO']["Clave"];
    $Nombreusr  =$_SESSION['INGRESO']["Nombre"];
    $HorSesion  =$_SESSION['INGRESO']["hora"];
	      //instancia de la clase PHpass
    $Contrasena = new PasswordHash(8, FALSE);
	      //se unen los datos para verificar
    $Ccontrase=$IDusr.$Ipusr.$Nombreusr.$HorSesion;
    if($Contrasena->CheckPassword($Ccontrase, $Claveusr)){
      ?>
      
      <!DOCTYPE html>
      <html>
      <head>
        <title>Administración del Sistema</title>
      </head>
      <body>


        <h1>Bienvenido al Sistema</h1>
        <ul>
          <li><strong>Usuario:</strong> <?php echo $Nombreusr;?></li>
          <li><a href="salir.php">Salir</a></li>
        </ul>
      </body>
      </html>


      <?php
    }else{

      header("location: ".$uri);
    }
  }else{
  	
    header("location: ".$uri);
  }

}else{

  header("location: ".$uri);
}


 /**
 * Returna el IP de usuario
 * @return [string] [devuel la io del usuario]
 */
 function IPuser() {
   $returnar ="";
   if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
     $returnar=$_SERVER['HTTP_X_FORWARDED_FOR'];}
     if (!empty($_SERVER['HTTP_CLIENT_IP'])){
       $returnar=$_SERVER['HTTP_CLIENT_IP'];}
       if(!empty($_SERVER['REMOTE_ADDR'])){
        $returnar=$_SERVER['REMOTE_ADDR'];}
        return $returnar;
      }
      ?>