<?php
class usuario {
	
	private $nombre;
    private $id_user;
    private $ok_bd;
    private $markets;
	
     public function __construct($nombre, $id_user = null)
    {
        $this->nombre = $nombre;
        $this->id_user = $id_user;
        
        
    }

    function verificar_user (){

        global $baseDatos;
        $nombre = $this->getNomUs();
        $res = $baseDatos->query("SELECT * FROM usuarios WHERE usuario = '$nombre'");  
        $res_fil = $res->fetch_assoc();
        print_r($res_fil);
        if (count($res_fil) != 0) {
            $this->setId_user($res_fil['id_usuario']);
            return true;
        }
        else{
            return false;
        }
        
    }


    public function getNomUs()
    {
        return $this->nombre;
    }

    public function setId_user($id_user)
    {
        $this->id_user = $id_user;
    }

    public function getId_user()
    {
        return $this->id_user;
    }

    public function setOk_bd($ok_bd)
    {
        $this->ok_bd = $ok_bd;
    }

    public function getOk_bd()
    {
        return $this->ok_bd;
    }

     public function setMarkets($markets)
    {
        $this->markets = $markets;
    }

    public function getMarkets()
    {
        return $this->markets;
    }

}

?>