<?php

class Mapa_Controller{


	function agregar_ruta (){
       
       echo "ACa////";
        $p1_lat = $_POST["p1_lat"];
        $p1_lng = $_POST["p1_lng"];
        $geocoding_origen = $_POST["geocoding_origen"];
        $p2_lat = $_POST["p2_lat"];
        $p2_lng = $_POST["p2_lng"];
        $geocoding_destino = $_POST["geocoding_destino"];


        echo $p1_lat;
        echo "//";
        echo $p1_lng;
        echo "//";
        echo $geocoding_origen;
        echo "//";
        echo $p2_lat;
        echo "//";
        echo $p2_lng;
        echo "//";
        echo $geocoding_destino;
        echo "//";
        
		/*$tpl = new TemplatePower("templates/login.html");
		$tpl->prepare();
		return $tpl->getOutputContent();*/

	}


}

?>