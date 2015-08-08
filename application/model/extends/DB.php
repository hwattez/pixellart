<?php
	class DB{
		
		private static $instance=null;
		private $connexion=null;
	
		private function __construct(){
			
			$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);

			try{
				$this->connexion=new PDO(DB_TYPE . ':host=' . DB_HOST  . ';dbname=' . DB_NAME, DB_USER, DB_PASS, $options);
			}catch(PDOException $exception){
				echo "Connection error: " . $exception->getMessage();
			}
		
		}
		
		public static function getInstance(){
		
			if(DB::$instance==null)
				DB::$instance = new DB();
				
			return DB::$instance->connexion;
		
		}
	
	}