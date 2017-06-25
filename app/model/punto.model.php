<?php

class mp_punto{
    
    private $id_punto;
    private $latitud;
    private $longitud;
    private $id_zona;
    private $ok_bd;

	function  __construct($latitud, $longitud, $id_zona, $id_punto=0){
       
       $this->id_punto=$id_punto; 
       $this->latitud=$latitud; 
       $this->longitud=$longitud; 
       $this->id_zona=$id_zona->getId();

	}

    function insert_punto_bd ($punto){

        global $baseDatos;
        //print_r($punto);
        $lat = $punto->getLatitud();
        $lng = $punto->getLongitud();
        $id_zona = $punto->getId_zona();
        
        $sql = "INSERT INTO `mp_punto`(`id_punto`, `latitud`, `longitud`, `id_zona`) 
                VALUES (0,$lat,$lng,$id_zona)";
        $result = $baseDatos->query($sql); 
        $punto->setId($punto->obtener_ultimo_insert());
        $punto->setOk_bd($result);
        return $punto;
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

    public function setOk_bd($ok_bd)
    {
        $this->ok_bd=$ok_bd; 
    }

    public function getOk_bd()
    {
        return $this->ok_bd; 
    }

    public function getId()
    {
        return $this->id_punto;
    }

    public function getLatitud()
    {
        return $this->latitud;
    }

    public function getId_zona()
    {
        return $this->id_zona;
    }

    public function getLongitud()
    {
        return $this->longitud;
    }

    

    


}

?>