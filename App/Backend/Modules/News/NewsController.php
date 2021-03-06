<?php
namespace App\Backend\Modules\News;

use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\News;
use \Entity\Comment;
use \FormBuilder\CommentFormBuilder;
use \FormBuilder\NewsFormBuilder;
use \OCFram\FormHandler;

class NewsController extends BackController
{
  public function executeDelete(HTTPRequest $request)
  {
    $newsId = $request->getData('id');
    
    $this->managers->getManagerOf('News')->delete($newsId);
    $this->managers->getManagerOf('Comments')->deleteFromNews($newsId);

    $this->app->user()->setFlash('Le chapitre a bien été supprimée !');

    $this->app->httpResponse()->redirect('.');
  }

  public function executeDeleteComment(HTTPRequest $request)
  {
    $this->managers->getManagerOf('Comments')->delete($request->getData('id'));
    
    $this->app->user()->setFlash('Le commentaire a bien été supprimé !');
    
    $this->app->httpResponse()->redirect('/admin/comment-gestion.html');
  }

  public function executegcommets(HTTPRequest $request)
  {
    $this->page->addVar('title', 'Gestion des commentaires');

    $manager = $this->managers->getManagerOf('Comments');

    $this->page->addVar('listeCommentsAutre', $manager->getListAutre());
    $this->page->addVar('nombreComments', $manager->countComments());

    $this->page->addVar('listeCommentsSignaler', $manager->getList());
    $this->page->addVar('nombreCommentsSignaler', $manager->countSignaler());
  }

  public function executeIndex(HTTPRequest $request)
  {
    $this->page->addVar('title', 'Gestion des Chapitres');

    $manager = $this->managers->getManagerOf('News');

    $this->page->addVar('listeNews', $manager->getList());
    $this->page->addVar('nombreNews', $manager->count());

  }

   public function executeStatutActiver(HTTPRequest $request)
  {
    $manager = $this->managers->getManagerOf('Comments');
    $comment = $manager->get($request->getData('id'));
    $manager->statutActiver($comment);

    $this->app->user()->setFlash('Le commentaire a bien été activé !');
    $this->app->httpResponse()->redirect('/admin/comment-gestion.html'); 
  }

  public function executeStatutDesactiver(HTTPRequest $request)
  {
    $manager = $this->managers->getManagerOf('Comments');
    $comment = $manager->get($request->getData('id'));
    $manager->statutDesactiver($comment);

    $this->app->user()->setFlash('Le commentaire a bien été désactivé !');
    $this->app->httpResponse()->redirect('/admin/comment-gestion.html'); 
  }

  public function executeClearSignaler(HTTPRequest $request)
  {
    $manager = $this->managers->getManagerOf('Comments');
    $comment = $manager->get($request->getData('id'));
    $manager->clearSignaler($comment);

    $this->app->user()->setFlash('Le commentaire a bien été réaffecté !');
    $this->app->httpResponse()->redirect('/admin/comment-gestion.html'); 
  }

  public function executeInsert(HTTPRequest $request)
  {
    $this->processForm($request);

    $this->page->addVar('title', 'Ajout d\'un chapitre');
  }

  public function executeUpdate(HTTPRequest $request)
  {
    $this->processForm($request);

    $this->page->addVar('title', 'Modification d\'un chapitre');
  }

  public function executeUpdateComment(HTTPRequest $request)
  {
    $this->page->addVar('title', 'Modification d\'un commentaire');

    if ($request->method() == 'POST')
    {
      $comment = new Comment([
        'id' => $request->getData('id'),
        'auteur' => $request->postData('auteur'),
        'contenu' => $request->postData('contenu')
      ]);
    }
    else
    {
      $comment = $this->managers->getManagerOf('Comments')->get($request->getData('id'));
    }

    $formBuilder = new CommentFormBuilder($comment);
    $formBuilder->build();

    $form = $formBuilder->form();

    $formHandler = new FormHandler($form, $this->managers->getManagerOf('Comments'), $request);

    if ($formHandler->process())
    {
      $this->app->user()->setFlash('Le commentaire a bien été modifié');

      $this->app->httpResponse()->redirect('/admin/comment-gestion.html');
    }

    $this->page->addVar('form', $form->createView());
  }

  public function processForm(HTTPRequest $request)
  {
    if ($request->method() == 'POST')
    {
      $news = new News([
        'auteur' => $request->postData('auteur'),
        'titre' => $request->postData('titre'),
        'contenu' => $request->postData('contenu')
      ]);

      if ($request->getExists('id'))
      {
        $news->setId($request->getData('id'));
      }
    }
    else
    {
      // L'identifiant de la news est transmis si on veut la modifier
      if ($request->getExists('id'))
      {
        $news = $this->managers->getManagerOf('News')->getUnique($request->getData('id'));
      }
      else
      {
        $news = new News;
      }
    }

    $formBuilder = new NewsFormBuilder($news);
    $formBuilder->build();

    $form = $formBuilder->form();

    $formHandler = new FormHandler($form, $this->managers->getManagerOf('News'), $request);

    if ($formHandler->process())
    {
      $this->app->user()->setFlash($news->isNew() ? 'Le chapitre a bien été ajoutée !' : 'Le chapitre a bien été modifiée !');
      
      $this->app->httpResponse()->redirect('/admin/');
    }

    $this->page->addVar('form', $form->createView());
  }
}