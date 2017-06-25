<?php
// incluimos los archivos y clases generales que el sistema requiere
include("inc.configuration.php");
//include("class.MySQL.php");
//include("class.MySQL.php");
include ("../recursos/php/class.TemplatePower.inc.php");


//CONTROLADORES
include("/controller/ingreso.controller.php");
include("/controller/mapa.controller.php");

//MODELOS
include("model/usuario.model.php");
include("model/zona.model.php");
include("model/punto.model.php");
include("model/market.model.php");


?>