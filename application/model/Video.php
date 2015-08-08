<?php
	
	class Video extends Model{
	
		public $id,
			   $title,
			   $tags,
			   $youtube,
			   $picture;
		
		public function __construct($title=null,$tags=null,$youtube=null,$picture=null,$id=null) {
			
			parent::__construct();

			foreach($this->tableColumns as $key => &$value)
	            $value = ${$key};
			
		}

		public function getYoutube(){

			return empty($this->youtube) ? null : 'https://www.youtube.com/embed/' . $this->youtube;

		}

		public function getPicture(){

			return empty($this->picture) ? null : URL . 'img/videos/' . $this->id . '.jpg';

		}
	}