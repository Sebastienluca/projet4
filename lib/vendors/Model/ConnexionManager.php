<?php
namespace Model;

use \OCFram\Manager;
use \Entity\Users;

abstract class ConnexionManager extends Manager
{
  /**
   * Méthode permettant de ce connecter.
   * @param $id L'identifiant du commentaire à supprimer
   * @return void
   */
  abstract public function getAdmin($username);
}