<?php
class usuario {
	
	private $nombre;
	
     public function __construct($nombre)
    {
        $this->nombre = $nombre;
    }

    function verificar_user ($nombre){

        global $baseDatos;
        
        $resultsc = $baseDatos->query("SELECT * FROM usuarios WHERE usuario = '$nombre'");       
        return $res = $resultsc->fetch_assoc();
    }


    public function getNomUs()
    {
        return $this->nombre;
    }

}

?>