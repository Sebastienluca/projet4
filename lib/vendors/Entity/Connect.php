<?php
namespace Entity;

use \OCFram\Entity;

class Connect extends Entity
{
	protected $username,
			$password,
			$email;

	public function isValid()
	{
		
	}

	public function setUsername($username)
	{
		$this->username = $username;
	}

	public function setPassword($password)
	{
	    $this->password = $password;
	}

	public function setemail($email)
	{
		$this->email = $email;
	}

	public function username()
	{
		return $this->username;
	}

	public function password()
	{
		return $this->password;
	}

	public function email()
	{
		return $this->email;
	}
}