<?php
	
class Task extends Model
{
	public $id, $task, $description, $date, $completed;
	
	public function __construct() 
	{
		// On renseigne au constructeur parent les attributs de la classe et le typage des colonnes dans le même ordre que les attributs
		$tableColumns = get_object_vars($this);
		$tableColumnsType = array('number','text','textarea', 'date', 'number');
		$this->date = date('Y-m-d');
		$this->completed = 0;
		parent::__construct($tableColumns, $tableColumnsType);
	}

	// Le delete est transformé implicitement en un update qui dit juste que la tâche est complétée
    public function delete()
    {
        $sql = "UPDATE " . parent::get('table') . " SET";

        foreach(parent::get('tableColumns') as $key => &$val)
            $sql .= " $key = :$key,";

        $sql = substr($sql,0,-1);
        $sql .= " WHERE id = :id";
        $query = parent::get('pdo')->prepare($sql);
        
        $this->completed = !$this->completed;

        return $query->execute(parent::get('tableColumns'));
    }
}