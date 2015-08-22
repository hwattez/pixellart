<?php
	
class Tag extends Model
{
	public $id, $tag;
	
	public function __construct() 
	{
		// On renseigne au constructeur parent les attributs de la classe et le typage des colonnes dans le même ordre que les attributs
		parent::__construct(get_object_vars($this), array('number','text'));
	}

	public function get($attr)
	{
		switch($attr){
			default:
				return $this->$attr;
		}
	}

    protected function insert()
    {
        $sql = "INSERT IGNORE INTO " . parent::get('table') . " VALUES(";

        foreach(parent::get('tableColumns') as $key => &$val)
            $sql .= ":$key,";

        $sql = substr($sql,0,-1) . ')';
		$pdo = parent::get('pdo');
        $query = $pdo->prepare($sql);

        return $query->execute(parent::get('tableColumns'));
    }
	
}