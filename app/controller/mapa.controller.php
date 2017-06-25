<?php

class Mapa_Controller{


	function agregar_punto (){
       
       
        $p0_lat = $_POST["p0_lat"];
        $p0_lng = $_POST["p0_lng"];
        $p0_geocoding = $_POST["p0_geocoding"];
        $titulo = $_POST["Titulo"];

        $punto = new mp_punto($p0_lat, $p0_lng);

	}


}

?>