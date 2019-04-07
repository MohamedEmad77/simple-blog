<?php

/**
* 
*/
class User
{
	
	protected $id = null;
	protected $username = null;
	protected $userType = null;
	protected $email = null;
	protected $password = null;
	protected $dateAdded = null;

	public function getId(){
		return $this->id;
	}

	public function isAdmin(){
		return ($this->userType == 'admin');
	}

	public function canEditPage(Page $p){
		return ($this->isAdmin() || ($this->id == $p->getCreatorId())); 
	}

	public function canCreatePage(){
		return ($this->isAdmin() || ($this->userType == 'author'));
	}


}

 ?>