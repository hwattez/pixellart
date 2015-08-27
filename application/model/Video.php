<?php

class Video extends Model
{
	public $id, $title, $tags, $youtube, $picture, $date;
	
	public function __construct() 
	{
		// On renseigne au constructeur parent les attributs de la classe et le typage des colonnes dans le même ordre que les attributs
		$tableColumns = get_object_vars($this);
		$tableColumnsType = array('number','text','text','text','input','date');
		$pictureFormats = array( 
		    array('suffix' => 'large', 'width' => '725', 'height' => '', 'quality' => 100, 'watermark' => '', 'verifSize' => false),
		    array('suffix' => 'medium', 'width' => '360', 'height' => '', 'quality' => 100, 'watermark' => '', 'verifSize' => false)
		);
		parent::__construct($tableColumns, $tableColumnsType, $pictureFormats);
	}

	public function get($attr, $complt=null)
	{
		switch($attr){
            case 'id':
                return isset($this->id) ? $this->id : $this->getNextId();
			case 'youtube':
				return empty($this->youtube) ? null : 'https://www.youtube.com/embed/' . $this->youtube;
			case 'picture':
				$complt = isset($complt) ? "_$complt" : "";
				return empty($this->picture) ? null : URL . 'img/videos/' . $this->id . '/picture' . $complt . '.jpg';
			default:
				return $this->$attr;
		}
	}

	public function save() 
    {
    	$success = parent::save();

    	// Insertion si inexistant des tags dans leur table et liaison dans la table correspondance
    	foreach(explode(' ', $this->tags) as $key)
    	{
	    	$tag = TagsManager::getOrInsertByTag($key);
	    	$videotag = new VideoTag();
	    	$videotag->id_video = $this->get('id');
	    	$videotag->id_tag = $tag->get('id');
	    	$videotag->save();
	    }

    	return $success;
    }
}