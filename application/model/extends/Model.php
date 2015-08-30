<?php

abstract class Model
{
    private $pdo, $table, $tableColumns, $tableColumnsType, $pictureFormats;
    
    protected function __construct($tc, $tct, $pf=null)
    {
        // Assignation de l'instance unique de PDO
        $this->pdo = DB::getInstance();
        // Assignation du nom de la table grâce à la classe appelante
        $this->table = strtolower(get_called_class()) . 's';
        // Recensement de l'ensemble des colonnes de la table avec les valeurs associées par référence
        // Et recensement des types HTML de chaque colonne
        $this->tableColumns = $tc;
        $this->tableColumnsType = $tct;
        foreach(array_keys($this->tableColumns) as $key)
            $this->tableColumns[$key] = &$this->$key;

        $this->pictureFormats = $pf;
    }

    public function get($attr)
    {
        switch($attr)
        {
            case 'id':
                return isset($this->id) ? $this->id : $this->getNextId();
            default:
                return $this->$attr;
        }
    }

    public function getTableColumnsType()
    {
        // Vérifie si tableColumnsType est un tableau associatif
        if((array_keys($this->tableColumnsType)[0]) !== 'id')
            foreach(array_keys($this->tableColumns) as $key){
                $firstValue = array_shift($this->tableColumnsType);
                $this->tableColumnsType[$key] = $firstValue;
            }

        return $this->tableColumnsType;
    }

    public function set($attr, $value)
    {
        return $this->$attr = $value;
    }

    public function setFromForms()
    {
        foreach($_POST as $key => $val)
            $this->$key = empty($val) ? $this->$key : Functions::secure($val);
        foreach($_FILES as $key => $val)
            $this->$key = (Functions::upload($key, ROOT . 'public/img/' . $this->table . '/' . $this->get('id') . '/', 'picture', $this->pictureFormats) OR $this->$key);
    }

    /////////////////////////
    ///// Fonctions sql /////
    /////////////////////////

    public function getNextId()
    {
        $req = $this->pdo->query("SHOW TABLE STATUS FROM " . DB_NAME . " LIKE '" . $this->table . "' ");
        return $req->fetch()['Auto_increment'];
    }

    public function save() 
    {
        if(empty($this->id))
            return $this->insert();
        return $this->update();
    }

    public function delete()
    {
        $sql = "DELETE FROM " . $this->table . " WHERE id = ?";
        $query = $this->pdo->prepare($sql);

        return $query->execute(array($this->id));
    }

    protected function insert()
    {
        $sql = "INSERT INTO " . $this->table . " VALUES(";

        foreach($this->tableColumns as $key => &$val)
            $sql .= ":$key,";

        $sql = substr($sql,0,-1) . ')';
        $query = $this->pdo->prepare($sql);

        $success = $query->execute($this->tableColumns);

        if($success)
            $this->id = $this->pdo->lastInsertId();

        return $success;
    }
        
    protected function update() 
    {
        $sql = "UPDATE " . $this->table . " SET";

        foreach($this->tableColumns as $key => &$val)
            $sql .= " $key = :$key,";

        $sql = substr($sql,0,-1);
        $sql .= " WHERE id = :id";
        $query = $this->pdo->prepare($sql);
        
        return $query->execute($this->tableColumns);
    }

}
