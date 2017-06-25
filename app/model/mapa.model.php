<?php

class Mapa{


	function  __construct(){
       
       echo "ACa////";
        $p0_lat = $_POST["p0_lat"];
        $p0_lng = $_POST["p0_lng"];
        $p0_geocoding = $_POST["p0_geocoding"];
        $titulo = $_POST["Titulo"];

        echo $p0_lat;
        echo $p0_lng;
        echo $p0_geocoding;
        echo $titulo;
		/*$tpl = new TemplatePower("templates/login.html");
		$tpl->prepare();
		return $tpl->getOutputContent();*/

	}


}

?>