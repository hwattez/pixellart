<?php
function __autoload($className) {

	if(in_array($className, array("Functions","Forms")))
		include APP . "libs/$className.php";

	elseif(in_array($className, array("Upload","UploadManager")))
		include APP . "libs/upload/$className.php";

	elseif(in_array($className, array("DB","Model","ModelManager")))
		include APP . "model/extends/$className.php";

	elseif($className == "Seo")
		include APP . "model/interfaces/$className.php";

	else
    	include APP . "model/$className.php";
}