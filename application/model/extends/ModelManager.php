<?php

abstract class ModelManager{

	static protected $table;
	static protected $class;

	protected static function getTable(){

		return self::$table = is_null(self::$table) ? str_replace("manager","",strtolower(get_called_class())) : self::$table;

	}

	protected static function getClass(){

		return self::$class = is_null(self::$class) ? str_replace("sManager","",get_called_class()) : self::$class;

	}

	public static function getAll(){

		$sql = "SELECT * FROM " . self::getTable();
		$query=DB::getInstance()->prepare($sql);
		$query->execute();
		$query->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, self::getClass());
		return $query->fetchAll();
		
	}

}