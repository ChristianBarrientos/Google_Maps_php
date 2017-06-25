<?php

class mp_market{
    
    private $id_market;
    private $titulo;
    private $punto;
    private $ruta;


	public function __construct($titulo, $punto, $ruta=null, $id_market=0){
       
       $this->id_market=$id_market; 
       $this->titulo=$titulo; 
       $this->punto=$punto; 
       $this->ruta = $ruta;

	}

    function insert_market_bd ($mark){

        global $baseDatos;
        //print_r($punto);
        //$id_market = $mark->getId();
        $titulo = $mark->getTitulo();
        $id_punto = $mark->getPunto()->getId();
        $id_ruta = $mark->getRuta();
        //print_r($mark);
        if ($id_ruta == null) {
            $sql = "INSERT INTO `mp_market`(`id_market`, `id_ruta`, `id_punto`, `titulo`) 
                VALUES (0,null,$id_punto,'$titulo')";
        }
        else{
            $sql = "INSERT INTO `mp_market`(`id_market`, `id_ruta`, `id_punto`, `titulo`) 
                VALUES (0,$id_ruta,$id_punto,'$titulo')";
        }
        
        
        $result = $baseDatos->query($sql);       
        return $result;
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
        return $this->punto;
    }

    public function getRuta()
    {
        return $this->ruta;
    }

    

}

?>