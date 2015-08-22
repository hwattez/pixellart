<?php
	
class VideoTag
{
	private $pdo, $table;
	public $id_video, $id_tag;
	
	public function __construct() 
	{
		$this->pdo = DB::getInstance();
		$this->table = 'videos_tags';
	}

	public function get($attr)
    {
        return $this->$attr;
    }

    public function set($attr, $value)
    {
        return $this->$attr = $value;
    }

	public function save() 
    {
        return $this->insert();
    }

    protected function insert()
    {
        $sql = "INSERT IGNORE INTO " . $this->table . " VALUES(?,?)";
        $query = $this->pdo->prepare($sql);

        return $query->execute(array($this->id_video, $this->id_tag));
    }
}