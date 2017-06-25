<?php

class mp_market{
    
    private $id_market;
    private $titulo;
    private $id_punto;
    private $id_ruta;
    private $ok_bd;

	public function __construct($titulo, $punto, $ruta=null, $id_market=0){
       
       $this->id_market=$id_market; 
       $this->titulo=$titulo; 
       $this->id_punto=$punto->getId(); 
       $this->ruta = $ruta;


	}

    function insert_market_bd ($mark){

        global $baseDatos;
        //print_r($punto);
        //$id_market = $mark->getId();
        $titulo = $mark->getTitulo();
        $id_punto = $mark->getPunto();
        $id_ruta = $mark->getRuta();
       
        if ($id_ruta == null) {
            $sql = "INSERT INTO `mp_market`(`id_market`, `id_ruta`, `id_punto`, `titulo`) 
                VALUES (0,null,$id_punto,'$titulo')";
        }
        else{
            $sql = "INSERT INTO `mp_market`(`id_market`, `id_ruta`, `id_punto`, `titulo`) 
                VALUES (0,$id_ruta,$id_punto,'$titulo')";
        }
        $result = $baseDatos->query($sql);       

    
        $mark->setId($mark->obtener_ultimo_insert());
        $mark->setOk_bd($result);

        

        return $mark;

        
    }


    function obtener_ultimo_insert(){

        global $baseDatos;
        $sql = "SELECT count(id_market) AS id FROM mp_market";
        $result = $baseDatos->query($sql); 
        $res = $result->fetch_assoc();
        return  $res['id'];
        
    }

    public function setId($id_market)
    {
        $this->id_market=$id_market; 
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
        return $this->id_market;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function getPunto()
    {
        return $this->id_punto;
    }

    public function getRuta()
    {
        return $this->id_ruta;
    }

    

}

?>