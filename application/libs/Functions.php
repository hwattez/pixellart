<?php

	class Functions{

		public static function secure($s) {
	        return stripslashes(htmlspecialchars(trim($s)));
	    }

	}