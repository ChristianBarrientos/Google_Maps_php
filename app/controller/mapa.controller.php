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
        
        $zonas = $this->obtener_zonas($p0_geocoding);
        
        try{
            $zona = new mp_zona($zonas['Pais'], $zonas['Provincia'], $zonas['Localidad'], $zonas['Direccion']);
            $zona::insert_zona_bd($zona);

            
            $punto = new mp_punto($p0_lat, $p0_lng, $zona);
            $punto::insert_punto_bd($punto);
            //throw new Exception("Error",0);
            $mark = new mp_market($titulo,$punto);
            $mark::insert_market_bd($mark);

        }catch(Exception $e){
            echo "Al cargar a BD. Detalle : ".$e;
         }

        if ($zona->getOk_bd() && $punto->getOk_bd() && $mark->getOk_bd() ) {

            $tpl->newBlock("insert_ok");
        }
        else{
            $tpl->newBlock("insert_ok_no");
        }

        return $tpl->getOutputContent();

	}


    function obtener_zonas($p0_geocoding){

        $aux;
       
        for ($i = 0; $i <= 4; $i++) { 
            switch ($i) {
                case 0:
                    $pais = substr(strrchr($p0_geocoding, ","), 1);
                    $aux = str_replace (','.$pais , '' ,$p0_geocoding);
                    break;
                case 1:
                    $provincia = substr(strrchr($aux, ","), 1);
                    $aux = str_replace (','.$provincia , '' ,$aux);
                    break;
                case 2:
                    $localidad = substr(strrchr($aux, ","), 1);
                    $aux = str_replace (','.$localidad , '' ,$aux);
                    break;
                case 3:
                    $direccion = $aux;
                    break;

            }
        }
        $zona = $arrayName = array('Pais' => $pais,
                                   'Provincia' => $provincia,
                                   'Localidad' => $localidad,
                                   'Direccion' => $direccion,
                                 );
        return $zona;

    }


    function markets_de_bd(){
        
        $tpl = new TemplatePower("templates/markets.html");
        $tpl->prepare();
        $tpl->gotoBlock("_ROOT");

        
        return $tpl->getOutputContent();

    }


}

?>