<?php

class Mapa_Controller{


	function cargar_punto (){
        $tpl = new TemplatePower("templates/opciones.html");
        $tpl->prepare();
        global $baseDatos;

        $p0_lat = $baseDatos->real_escape_string($_POST["p0_lat"]);
        $p0_lng = $baseDatos->real_escape_string($_POST["p0_lng"]);
        $p0_geocoding = $baseDatos->real_escape_string($_POST["p0_geocoding"]);
        $titulo = $baseDatos->real_escape_string($_POST["Titulo"]);

        //instanciar punto
        $punto = new mp_punto($p0_lat, $p0_lng);
        $carga_punto = $punto::insert_punto_bd($punto);
        $id_punto = $punto::obtener_ultimo_insert();
        //instanciar market
        $mark = new mp_market($titulo,$punto);
        $carga_market = $mark::insert_market_bd($mark);

        if ($carga_punto && $carga_market) {

            $tpl->newBlock("insert_ok");
        }
        else{
            $tpl->newBlock("insert_ok_no");
        }

        return $tpl->getOutputContent();

	}


}

?>