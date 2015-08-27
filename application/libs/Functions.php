<?php

	class Functions
	{
		public static function secure($s) 
		{
			if(is_bool($s)) return $s;
			if($s === "") return NULL;
	        return stripslashes(htmlspecialchars(trim($s)));
	    }

		public static function upload($index,$destination,$name,$pictureFormats)
		{
            $upload = new Upload();
            $upload->set_file($_FILES[$index]);
            $upload->set_name($name);
            $upload->set_directory( $destination );

            $param = array('type' => 'return');
            $return = UploadManager::upload($upload, $pictureFormats, $param);
            $json = json_decode($return, true);

            return $json['status'] == 'success';

		}

		public static function isLogged()
		{
			return isset($_COOKIE['login']) && isset($_COOKIE['password']) && $_COOKIE['login'] === 'admin' && md5($_COOKIE['password']) === 'a826e9303d8dc8f1f5e5e7fff1b01c15';
		}

		public static function isValidEmail()
		{
			return true;
		}

	}