<?php
error_reporting(E_ALL);							
ini_set("display_errors", "on");
header('Content-Type: text/html; charset=utf-8');

require "WSUltimasAcom.class.php";

try
{
  $ws_acom = new WSUltimasAcom(true);

  $res = $ws_acom->getUltimasACOM();
  
} catch(Exception $e)
{
  die("Error: ".$e->getMessage());
}

?>


<h3>Ejemplo de WS: últimas ACOM</h3>

<?php foreach($res as $item):?>
<h4><?php echo $item->volanta;?></h4>
  <p><?php echo $item->bajada1_texto;?></p>
  
<?php endforeach;?>
