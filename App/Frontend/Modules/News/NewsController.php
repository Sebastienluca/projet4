<?php
namespace App\Frontend\Modules\News;

use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\Comment;
use \FormBuilder\CommentFormBuilder;
use \OCFram\FormHandler;

class NewsController extends BackController
{
	public function executeIndex(HTTPRequest $request)
	{
		$nombreNews = $this->app->config()->get('nombre_news');
		$nombreCaracteres = $this->app->config()->get('nombre_caracteres');
		
		// On ajoute une définition pour le titre.
		$this->page->addVar('title', ' Jean Forteroche | Mes '.$nombreNews.' dernièrs chapitres');
		
		// On récupère le manager des news.
		$manager = $this->managers->getManagerOf('News');
		
		$listeNews = $manager->getListIndex(0, $nombreNews);
		
		foreach ($listeNews as $news)
		{
			if (strlen($news->contenu()) > $nombreCaracteres)
			{
				$debut = substr($news->contenu(), 0, $nombreCaracteres);
				$debut = substr($debut, 0, strrpos($debut, ' ')) . '...';
				
				$news->setContenu($debut);
			}
		}
		
		// On ajoute la variable $listeNews à la vue.
		$this->page->addVar('listeNews', $listeNews);
	}

	public function executeChapitres(HTTPRequest $request)
	{
		$nombreNews = $this->app->config()->get('nombre_news');
		$nombreCaracteres = $this->app->config()->get('nombre_caracteres');

		// On ajoute une définition pour le titre.
		$this->page->addVar('title', 'Les Chapitres - Billet simple pour l\'Alaska | Roman');

		// On récupère le manager des news.
		$manager = $this->managers->getManagerOf('News');

		$listeNews = $manager->getList();

		foreach ($listeNews as $news)
		{
			if (strlen($news->contenu()) > $nombreCaracteres)
			{
				$debut = substr($news->contenu(), 0, $nombreCaracteres);
				$debut = substr($debut, 0, strrpos($debut, ' ')) . '...';
				
				$news->setContenu($debut);
			}
		}
		// On ajoute la variable $listeNewsChapitres à la vue.
		$this->page->addVar('listeNewsChapitres', $listeNews);
	}
	
	public function executeShow(HTTPRequest $request)
	{
		$news = $this->managers->getManagerOf('News')->getUnique($request->getData('id'));
		
		if (empty($news))
		{
			$this->app->httpResponse()->redirect404();
		}
		
		$this->page->addVar('title', $news->titre());
		$this->page->addVar('news', $news);
		$this->page->addVar('comments', $this->managers->getManagerOf('Comments')->getListOf($news->id()));

		$manager = $this->managers->getManagerOf('News');
		$newsSuivant = $manager->getSuivant($news->id());
		foreach ($newsSuivant as $news)
		{
			$news->id();
		}
		$this->page->addVar('newsSuivant', $newsSuivant);


		$manager = $this->managers->getManagerOf('News');
		$newsPrecedent = $manager->getPrecedent($news->id());
		foreach ($newsPrecedent as $news)
		{
			$news->id();
		}
		$this->page->addVar('newsPrecedent', $newsPrecedent);
	}

	public function executeInsertComment(HTTPRequest $request)
	{
		// Si le formulaire a été envoyé.
		if ($request->method() == 'POST')
		{
			$comment = new Comment([
				'news' => $request->getData('news'),
				'auteur' => $request->postData('auteur'),
				'contenu' => $request->postData('contenu')
			]);
		}
		else
		{
			$comment = new Comment;
		}

		$formBuilder = new CommentFormBuilder($comment);
		$formBuilder->build();

		$form = $formBuilder->form();

		$formHandler = new FormHandler($form, $this->managers->getManagerOf('Comments'), $request);

		if ($formHandler->process())
		{
			$this->app->user()->setFlash('Le commentaire a bien été ajouté, merci !');
			
			$this->app->httpResponse()->redirect('chapitre-'.$request->getData('news').'.html');
		}

		$this->page->addVar('comment', $comment);
		$this->page->addVar('form', $form->createView());
		$this->page->addVar('title', 'Ajout d\'un commentaire');
	}
	
	public function executeSignalComment(HTTPRequest $request)
	{   
		$manager = $this->managers->getManagerOf('Comments');
		$comment = $manager->get($request->getData('commentId'));
		$manager->signaler($comment);

		$this->app->user()->setFlash('Le commentaire a bien été signalé, merci !');
		$this->app->httpResponse()->redirect('chapitre-'. $comment->news() .'.html'); 
	
	}
}