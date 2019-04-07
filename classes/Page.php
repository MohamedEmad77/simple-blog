<?php

/**
* 
*/
class Page
{
	
	protected $id = null;
	protected $creatorId = null;
	protected $title = null;
	protected $content = null;
	protected $dateAdded = null;
	protected $dateUpdated = null;

	public function getId(){
		return $this->id;
	}

	public function getCreatorId(){
		return $this->creatorId;
	}

	public function getTitle(){
		return $this->title;
	}

	public function getContent(){
		return $this->content;
	}

	public function getDateAdded(){
		return $this->dateAdded;
	}

	public function getDateUpdated(){
		return $this->dateUpdated;
	}


	public function getIntro($count = 200){

		return substr(strip_tags($this->content), 0, $count);
	}



}

 ?>