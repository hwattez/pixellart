<?php

abstract class ModelManager{

	protected static function get($attr)
	{
		switch($attr)
		{
			case 'table':
				return str_replace("manager","",strtolower(get_called_class()));
			case 'class':
				return str_replace("sManager","",get_called_class());
		}
	}

	public static function getAll(array $options = array()){

		$sql = "SELECT * FROM " . self::get('table');
		$sql .= isset($options['order']) ? " ORDER BY " . $options['order'] : "";
		$query=DB::getInstance()->prepare($sql);
		$query->execute();
		$query->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, self::get('class'));
		
		return $query->fetchAll();
		
	}

	public static function getById($id){

		$sql = "SELECT * FROM " . self::get('table') . " WHERE id=?";
		$query=DB::getInstance()->prepare($sql);
		$query->execute(array($id));
		$query->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, self::get('class'));
		
		return $query->fetch();
		
	}

	public static function count(){

		$sql = "SELECT count(*) as count FROM " . self::get('table');
		$query=DB::getInstance()->prepare($sql);
		$query->execute();
		
		return $query->fetch()['count'];
		
	}

}