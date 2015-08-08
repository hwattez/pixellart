<?php
function __autoload($className) {

	if($className == "Functions")
		include APP . 'libs/Functions.php';

	elseif(in_array($className, array("DB","Model","ModelManager")))
		include APP . "model/extends/$className.php";

	else
    	include APP . "model/$className.php";
}