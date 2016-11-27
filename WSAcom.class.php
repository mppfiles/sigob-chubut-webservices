<?php

require "WSClientChubut.class.php";

/**
 * Ejemplo de Accion Comunicacional (clase de dominio)
 *
 * @author mppfiles
 */
class WSAcom extends WSClientChubut
{
  
  public function getPorCodigo($codigo)
  {
    $this->query("ObtenerDatosACOM", array("Codigo" => $codigo));
    
    $res = $this->parseResponseObtenerDatosACOM();
    
    return $res;
  }
  
  protected function parseResponseObtenerDatosACOM()
  {
     return $this->getResponse()->NewDataSet->Table;
  }
}
