<?php

  /**
   * Clase que representa una conexión a web service
   * 
   * @author mppfiles <mppfiles@gmail.com>
   */
  class WSClientChubut {
    
    protected $default_location = "http://example.net/webservices/example.asmx";
    protected $client_options = array();
    protected $debug = false;
    protected $xml;                //full xml
    protected $response;          //response "payload"
    protected $error = null;
    
    /**
     * Constructor
     * @param boolean $debug usar modo debug o no
     */
    public function __construct($debug = false, $location = null, $endpoint = null)
    {
      $this->setLocation($location);
      $this->setEndpoint($endpoint);
      
      $this->debug = (bool)$debug;
      
      if(TRUE === $this->debug)
      {
        //en desarrollo, evitar cachear el wsdl
        ini_set("soap.wsdl_cache_enabled","0");
        
        $this->client_options["trace"] = 1;
      }
      
      try
      {
        $this->client = $this->initClient();
      } catch(Exception $e)
      {
        $this->error = "No se pudo construir el WebService: ".$e->getMessage();
        throw $e;
      }
    }
    
    protected function initClient()
    {
      try
      {
        $client = new SoapClient($this->endpoint, $this->client_options);
      } catch(Exception $e)
      {
        throw $e;
      }
      
      return $client;
    }
    
    public function getXml()
    {
      return $this->xml;
    }
    
    public function getResponse()
    {
      return $this->response;
    }
    
    public function query($query_method, $arguments = array(), $result_method = null)
    {
      try {
       $this->doQuery($query_method, $arguments, $result_method);
      } catch(Exception $e)
      {
         $this->error = $e->getMessage();
         throw $e;
      }
      
      $this->response = simplexml_load_string($this->xml->any);
      $this->responseCount = $this->response->count();
    }
    
    protected function doQuery($query_method, $arguments = array(), $result_method = null)
    {
      if(!$result_method)
      {
        $result_method = $query_method.'Result';
      }
              
      try
      {
        $result               = $this->client->$query_method($arguments);
        $this->xml            = $result->$result_method;
      } catch(Exception $e)
      {
        $this->error = "Error al consultar web service: ".$e->getMessage();
        throw $e;
      }
      
      $this->error = null;
    }
    
    private function setEndpoint($endpoint = null)
    {
      if(!$endpoint)
      {
        $this->endpoint = $this->default_location."?wsdl";
      }
      else
      {
        $this->endpoint = $endpoint;
      }
    }
    
    private function setLocation($location = null)
    {
      $settings = array();
      
      if(!$location)
      {
        $settings = parse_ini_file("settings.ini", true);
        
        if(isset($settings["urls"]["default_location"]))
        {
          $this->default_location = $settings["urls"]["default_location"];
        }
        $this->client_options["location"] = $this->default_location;
      }
      else
      {
        $this->client_options["location"] = $location;
      }
    }
  }