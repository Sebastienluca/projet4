<?php
namespace App\Backend\Modules\Connexion;

use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\Connect;

class ConnexionController extends BackController
{
	public function executeIndex(HTTPRequest $request)

	{ // On ajoute une définition pour le titre.
		$this->page->addVar('title', 'Connexion au site internet');

		if ($request->postExists('username'))
		{
			$username = $request->postData('username'); //var_dump($username);
			$password = $request->postData('password'); //var_dump($password);

			$manager = $this->managers->getManagerOf('Connexion'); //var_dump($manager);

			$admin = $manager->getAdmin($username);

			if ( $admin && password_verify($password, $admin->password()))
			{ 
				$this->app->user()->setAuthenticated(true);

				$this->app->user()->setAttribute('username', $admin->username());

				$this->app->httpResponse()->redirect('/admin/');

			} else {
				$this->app->user()->setFlasherreur('Le pseudo ou le mot de passe est incorrect.');
			}
		} 
	}
		public function executeDeconnexion()
	{
		session_unset();
				session_destroy();
				$this->app->httpResponse()->redirect('/admin/');
	}
}