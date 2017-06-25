<?php

class Ingreso_Controller{


	function login (){
        
		$tpl = new TemplatePower("templates/login.html");
		$tpl->prepare();
		return $tpl->getOutputContent();

	}

	function verificar_usuario(){
		
		$usuario = $_POST['usuario'];
		
		$usuario = new usuario($usuario);
		//llamado al modelo. 
		
		$_user_ok = $usuario -> verificar_user($usuario->getNomUs());
	
		if($_user_ok){
	
			$this->iniciar_session($usuario);

		}
		else{
			
			$tpl = new TemplatePower("templates/login.html");
			$tpl->prepare();
			$tpl->newBlock("error_");
			return $tpl->getOutputContent();

  		
			}

	}

	

	function iniciar_session($usuario){

		$_SESSION["nombre"] = $usuario->getNomUs();

	}

	
	function menu (){
        if (!($_SESSION['nombre'])) {
    		header('Location: index.php');
  		}

		$tpl = new TemplatePower("templates/opciones.html");
		$tpl->prepare();
		$tp1 = Mapa_Controller::markets_de_bd();
		$tpl = $tpl->getOutputContent();
		return $tp1.$tpl;

	}


}

?>