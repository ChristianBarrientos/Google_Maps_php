
<?php

//===========================================================================================================
// OPEN SESSION |
//---------------
	session_start();

//===========================================================================================================
// INCLUDES |
//-----------

include("inc.includes.php");

//===========================================================================================================
// OPEN CONNECTION |
//------------------
global $config;
if ($config["motordb"]=="MYSQL"){
	$baseDatos = new mysqli($config["dbhost"],$config["dbuser"],$config["dbpass"],$config["db"]);
	
}

//===========================================================================================================
// INSTANCIA CLASES Y METODOS |
//-----------------------------

	if ((!isset($_REQUEST["action"])) || ($_REQUEST["action"]=="")) {
        $_REQUEST["action"] = "Ingreso::login"; 
    }
	if ($_REQUEST["action"]=="") {
        $html = "";
    }
	else{
		if (!strpos($_REQUEST["action"],"::")) {
            $_REQUEST["action"].="::login";
        }
		list($classParam,$method) = explode('::',$_REQUEST["action"]);
		if ($method=="") {
		    $method="login";// AGREGAR Condición PARA SABER SI YA INICIO Sesión
        }
		$classToInstaciate = $classParam."_Controller";
		if (class_exists($classToInstaciate)){
			if (method_exists($classToInstaciate,$method)) {
				$claseTemp = new $classToInstaciate;
				$html=call_user_func_array(array($claseTemp, $method),array());
			}
			else{
				echo "ERROR";
				$html="No tiene permitido acceder a ese contenido.";
			}
		}
		else{
			$html="La página solicitada no está disponible.";
		}
	}
//===========================================================================================================
// INSTANCIA TEMPLATE |
//---------------------

    $tpl = new TemplatePower("templates/index.html");
	$tpl->prepare();
	$tpl->gotoBlock("_ROOT");
//===========================================================================================================
// LEVANTA TEMPLATE	|
//-------------------		
//if(isset($_SESSION["usuario"]))...
	/*$tpl->gotoBlock("_ROOT");
	$tpl->newBlock("bloque_mapa");

	//$tpl->assign("contenido",$html);
    //$tpl->printToScreen();
   
	$tpl->printToScreen();
	//$webapp=$tpl->getOutputContent();
	//echo $webapp;
	
	if($html == null){
		//echo "htmnull";
		$tpl->assign("contenido",Ingreso_Controller::menu());
		$tpl->printToScreen();
	}
	else{

		$tpl->assign("contenido",$html);
    	$tpl->printToScreen();
	}
	*/		

if (isset($_SESSION["nombre"])){

	
	

	if($html == null){
		$tpl->assign("contenido",Ingreso_Controller::menu());
		//$tpl->assign("markets",Mapa_Controller::markets_de_bd());
		//$tpl->newBlock("bloque_mapa");
		
	}
	else{
		$tpl->assign("contenido",$html);
    	
	}

	$tpl->printToScreen();
}
else{
	$tpl->assign("contenido",$html);
    $tpl->printToScreen();
    
}

?>