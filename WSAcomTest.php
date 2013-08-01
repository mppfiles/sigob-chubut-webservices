<?php
error_reporting(E_ALL);							
ini_set("display_errors", "on");
header('Content-Type: text/html; charset=utf-8');

require "WSAcom.class.php";

try
{
  $ws_acom = new WSAcom(true);
  $res = $ws_acom->getPorCodigo(2015);
  
} catch(Exception $e)
{
  die("Error: ".$e->getMessage());
}
?>

<h3>Ejemplo de WS: ACOM código 2015</h3>

<h4><?php echo $res->codigo_accion. " - ". $res->volanta;?></h4>
<p><?php echo $res->bajada1_texto;?></p>