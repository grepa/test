<?php
error_reporting(-1);
ini_set('error_reporting', E_ALL);
error_reporting(E_ALL);




class api_quadruple{
	
	     
	     private $login='*****';
	     private $heslo='****';
	     private $ip='****';
	     private $soap;
	     private $verze=1.01;
	
	    public function __construct(){
		  
		  $url='http://'.$this->ip.'/pmwpartner/pmwpartner.soap.fcgi?wsdl';
		  $options = array("login" => $this->login,"password" => $this->heslo);
	      
	      $this->soap = new SoapClient($url,$options);
	  
	
	}
	
	
	public function portace_list()
	{
	
	        
            $vysledek=$this->soap->__soapCall('portInList',array('parameters' =>array()));
             
		
		   return $vysledek;

	}
	public function cenika_default(){
			               
            $params = array('pricelistId' => 378);
			
			$vysledek=$this->soap->__soapCall('pricelistGet', array('parameters' => $params));
			
			return $vysledek;
		}
	public function sms_sablony_show(){
			
			$vysledek=$this->soap->__soapCall('smsNotificationTemplateList',array('parameters' =>array()));
		
		   return $vysledek;
	
	
	}
	public function sms_sablony_set($code,$jazyk,$text){
			
			$vysledek=$this->soap->__soapCall('smsNotificationTemplateSet',array('parameters' =>array('code'=>$code,'lang'=>$jazyk,'text'=>$text)));
		
		   return $vysledek;
	
	
	}	
	public function quadruple_verze(){
		
		  return $this->verze;
		}	

//konec tridy
}

	
?>

