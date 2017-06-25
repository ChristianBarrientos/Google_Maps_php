<?php

class mp_punto{
    
    private $id_punto;
    private $latitud;
    private $longitud;
    

	function  __construct($latitud, $longitud, $id_punto=0){
       
       $this->id_punto=$id_punto; 
       $this->latitud=$latitud; 
       $this->longitud=$longitud; 

	}

    function insert_punto_bd ($punto){

        global $baseDatos;
        //print_r($punto);
        $lat = $punto->getLatitud();
        $lng = $punto->getLongitud();
        
        $sql = "INSERT INTO `mp_punto`(`id_punto`, `latitud`, `longitud`) 
                VALUES (0,$lat,$lng)";
        $result = $baseDatos->query($sql); 
        $id_punto = $punto->setId($punto->obtener_ultimo_insert());

        return $result;
    }

    function obtener_ultimo_insert(){
        global $baseDatos;
        $sql = "SELECT count(id_punto) AS id FROM mp_punto";
        $result = $baseDatos->query($sql); 
        $res = $result->fetch_assoc();
        return  $res['id'];
        
    } 


    public function setId($id_punto)
    {
        $this->id_punto=$id_punto; 
    }

    public function getId()
    {
        return $this->id_punto;
    }

    public function getLatitud()
    {
        return $this->latitud;
    }

    public function getLongitud()
    {
        return $this->longitud;
    }

    


}

?>