<?php
error_reporting(E_ALL);							
ini_set("display_errors", "on");
header('Content-Type: text/html; charset=utf-8');

require "WSFotoAcom.class.php";

try
{
  $ws_acom = new WSFotoAcom(true);
  $res = $ws_acom->getUrlFoto(2015);
  
} catch(Exception $e)
{
  die("Error: ".$e->getMessage());
}

?>

<h3>Ejemplo de WS: ACOM código 2015</h3>


<img src="<?php echo $res;?>"/>