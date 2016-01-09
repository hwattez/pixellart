<?php

class TagsManager extends ModelManager 
{
	public static function getAll(array $options = array())
	{
		$sql = "SELECT t.*";
		$sql .= isset($options['count']) ? ", (select count(*) from videos_tags where id_tag=t.id) as count" : "";
		$sql .= ' FROM ' . self::get('table') . ' t';
		$sql .= isset($options['order']) ? " ORDER BY " . $options['order'] : "";
		$query=DB::getInstance()->prepare($sql);
		$query->execute();
		$query->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, self::get('class'));

		return $query->fetchAll();
	}

	public static function getOrInsertByTag($tag)
	{
		$sql = "SELECT * FROM " . self::get('table');
		$sql .= " WHERE tag=?";
		$query=DB::getInstance()->prepare($sql);
		$query->execute(array($tag));
		$query->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, self::get('class'));
		$result=$query->fetch();

		if(empty($result))
		{
			$tagg = new Tag();
			$tagg->set('tag', $tag);
			$tagg->save();
			$result = $tagg;
		}
		
		return $result;
	}
}