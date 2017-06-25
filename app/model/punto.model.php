<?php

class mp_punto{
    
    private $id_punto;
    private $latitud;
    private $longitud;
    

	function  __construct($latitud, $longitud, $id_punto=null){
       
       $this->id_punto=$id_punto; 
       $this->latitud=$latitud; 
       $this->longitud=$longitud; 

	}


}

?>