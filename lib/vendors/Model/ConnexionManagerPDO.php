<?php
namespace Model;

use \Entity\Users;

class ConnexionManagerPDO extends ConnexionManager
{
	public function getAdmin($username)
	{	

		$req = $this->dao->prepare('SELECT username, password FROM connect WHERE username = :username');

		$req->execute(array(
		    ':username' => $username
		));

		$req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Connect');

		$resultat = $req->fetch();

		return $resultat;
	}


}