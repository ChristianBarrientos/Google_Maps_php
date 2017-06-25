<?php

class mp_market{
    
    private $id_market;
    private $titulo;
    private $punto;
    private $ruta;


	public static function __construct($id_market=null, $titulo, $punto, $ruta=null){
       
       $this->id_market=$id_market; 
       $this->titulo=$titulo; 
       $this->punto=$punto; 
       if (isset($ruta)) {
           $this->ruta = $ruta;
       }
	}


    public static function getId()
    {
        return $this->id_market;
    }

    public static function getTitulo()
    {
        return $this->titulo;
    }

    public static function getPunto()
    {
        return $this->punto;
    }

    public static function getRuta()
    {
        return $this->ruta;
    }

    

}

?>