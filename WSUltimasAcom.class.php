<?php

require "WSClientChubut.class.php";

/**
 * Ejemplo de uso de WebService (clase de dominio)
 *
 * @author mppfiles <mppfiles@gmail.com>
 */
class WSUltimasAcom extends WSClientChubut
{
  
  public function getUltimasAcom($cantidad = 10)
  {
    $this->query("ObtenerUltimasACOM", array("Cantidad" => $cantidad));
    
    $res = $this->parseResponseObtenerUltimasACOM();
    
    return $res;
  }
  
  protected function parseResponseObtenerUltimasACOM()
  {
    $items = array();

    if(!$this->getResponse()->count())
    {
      return $items;
    }

    foreach($this->getResponse()->NewDataSet->Table as $item) {
      $items[] = $item;
    }

    return $items;
  }
}