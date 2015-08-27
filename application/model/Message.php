<?php
	
	class Message extends Model
	{
		public $id, $nom, $email, $website, $message, $date;
		
		public function __construct() 
		{
			// On renseigne au constructeur parent les attributs de la classe et le typage des colonnes dans le même ordre que les attributs
			$tableColumns = get_object_vars($this);
			$tableColumnsType = array('number','text','text','text','textarea','date');
			$this->date = date('Y-m-d');
			parent::__construct($tableColumns, $tableColumnsType);
		}
	}