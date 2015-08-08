<?php

abstract class Model{

    protected $pdo, $table, $tableColumns;
    
    protected function __construct(){

        $this->pdo = DB::getInstance();
        $this->table = strtolower(get_called_class()) . 's';

        $this->tableColumns = get_object_vars($this);
        unset($this->tableColumns['pdo'],$this->tableColumns['table'],$this->tableColumns['tableColumns']);

        foreach(array_keys($this->tableColumns) as $key)
            echo $this->tableColumns[$key] = &$this->$key;

    }
        
    public function save() {
        
        if(empty($this->id))
            return $this->insert();
        return $this->update();

    }

    protected function insert(){

        $sql = "INSERT INTO " . $this->table . " VALUES(";

        foreach($this->tableColumns as $key => &$val){
            $sql .= ":$key,";
            $val = empty($val) ? NULL : Functions::secure($val);
        }

        $sql = substr($sql,0,-1) . ')';
        $query = $this->pdo->prepare($sql);
        
        return $query->execute($this->tableColumns);

    }
        
    protected function update() {
        
        $sql = "UPDATE " . $this->table . " SET";

        foreach($this->tableColumns as $key => &$val){
            $sql .= " $key = :$key,";
            $val = empty($val) ? NULL : Functions::secure($val);
        }

        $sql = substr($sql,0,-1);
        $sql .= " WHERE id = :id";
        $query = $this->pdo->prepare($sql);

        return $query->execute($this->tableColumns);
    
    }

    public function delete() {

        $sql = "DELETE from " . $this->table . " WHERE id = ?";
        $query = $this->pdo->prepare($sql);

        return $query->execute(array($this->id));
        
    }

}
