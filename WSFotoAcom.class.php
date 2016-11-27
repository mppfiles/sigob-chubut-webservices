<?php

require "WSClientChubut.class.php";

/**
 * Ejemplo de Accion Comunicacional (clase de dominio)
 *
 * @author mppfiles
 */
class WSFotoAcom extends WSClientChubut
{
  
  public function getUrlFoto($codigo)
  {
    $this->query("ObtenerURLFotoACOM", array("CodigoAccion" => $codigo));
    
    $res = $this->parseResponseObtenerURLFotoACOM();
    
    return $res;
  }
  
  protected function parseResponseObtenerURLFotoACOM()
  {
     $resp = $this->getResponse();
     
     $url = str_replace("localhost", "sigob.chubut.gov.ar", $resp->Url);
     
     return $url;
  }
}
