<?php

class mp_zona{

	private $id_zona;
    private $pais;
    private $provincia;
    private $localidad;
    private $direccion;
    private $ok_bd;

	function  __construct($pais, $provincia, $localidad,$direccion, $id_zona=0){
       
       $this->id_zona=$id_zona;
       $this->pais=$pais; 
       $this->provincia=$provincia; 
       $this->localidad=$localidad; 
       $this->direccion=$direccion;
     

	}


	function insert_zona_bd ($zona){


        global $baseDatos;
        //print_r($punto);
        $pais = $zona->getPais();
        $provincia = $zona->getProvincia();
        $localidad = $zona->getLocalidad();
        $direccion = $zona->getDireccion();

        $sql = "INSERT INTO `mp_zona`(`id_zona`, `pais`, `provincia`, `localidad`, `direccion`) 
        VALUES (0,'$pais','$provincia','$localidad','$direccion')";
        
        $result = $baseDatos->query($sql); 
        $zona->setId($zona->obtener_ultimo_insert());
        $zona->setOk_bd($result);
        
        return $zona;
    }


    function obtener_ultimo_insert(){

        global $baseDatos;
        $sql = "SELECT count(id_zona) AS id FROM mp_zona";
        $result = $baseDatos->query($sql); 
        $res = $result->fetch_assoc();

        return  $res['id'];
        
    }

    public function setId($id_zona)
    {
        $this->id_zona=$id_zona; 
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
        return $this->id_zona;
    }

    public function getPais()
    {
        return $this->pais;
    }

    public function getProvincia()
    {
        return $this->provincia;
    } 

    public function getLocalidad()
    {
        return $this->localidad;
    }

    public function getDireccion()
    {
        return $this->direccion;
    } 

}

?>