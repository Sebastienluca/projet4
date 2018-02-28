<?php
namespace Model;

use \Entity\Comment;

class CommentsManagerPDO extends CommentsManager
{
	protected function add(Comment $comment)
	{
		$q = $this->dao->prepare('INSERT INTO comments SET news = :news, auteur = :auteur, contenu = :contenu, date = NOW()');
		
		$q->bindValue(':news', $comment->news(), \PDO::PARAM_INT);
		$q->bindValue(':auteur', $comment->auteur());
		$q->bindValue(':contenu', $comment->contenu());
		
		$q->execute();
		
		$comment->setId($this->dao->lastInsertId());
	}

	public function delete($id)
	{
		$this->dao->exec('DELETE FROM comments WHERE id = '.(int) $id);
	}

	public function deleteFromNews($news)
	{
		$this->dao->exec('DELETE FROM comments WHERE news = '.(int) $news);
	}
	
	public function getListOf($news)
	{
		if (!ctype_digit($news))
		{
			throw new \InvalidArgumentException('L\'identifiant de la news passé doit être un nombre entier valide');
		}
		
		$q = $this->dao->prepare('SELECT id, news, auteur, contenu, statut, date FROM comments WHERE news = :news AND statut = 0');
		$q->bindValue(':news', $news, \PDO::PARAM_INT);
		$q->execute();
		
		$q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');
		
		$comments = $q->fetchAll();
		
		foreach ($comments as $comment)
		{
			$comment->setDate(new \DateTime($comment->date()));
		}
		
		return $comments;
	}

	protected function modify(Comment $comment)
	{
		$q = $this->dao->prepare('UPDATE comments SET auteur = :auteur, contenu = :contenu WHERE id = :id');
		
		$q->bindValue(':auteur', $comment->auteur());
		$q->bindValue(':contenu', $comment->contenu());
		$q->bindValue(':id', $comment->id(), \PDO::PARAM_INT);
		
		$q->execute();
	}
	
	public function get($id)
	{
		$q = $this->dao->prepare('SELECT id, news, auteur, contenu FROM comments WHERE id = :id');
		$q->bindValue(':id', (int) $id, \PDO::PARAM_INT);
		$q->execute();
		
		$q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');
		
		return $q->fetch();
	}
	
	public function signaler(Comment $comment)
	{
		$q = $this->dao->prepare('UPDATE comments SET signaler = :signaler WHERE id = :id');
		$q->bindValue(':signaler', 1);
		$q->bindValue(':id', $comment->id(), \PDO::PARAM_INT);
			
		$q->execute();
	}

	public function clearSignaler(Comment $comment)
	{
			$q = $this->dao->prepare('UPDATE comments SET signaler = :signaler WHERE id = :id');
			$q->bindValue(':signaler', 0);
			$q->bindValue(':id', $comment->id(), \PDO::PARAM_INT);
			
			$q->execute();
	}

	public function statutActiver(Comment $comment)
	{
			$q = $this->dao->prepare('UPDATE comments SET statut = :statut WHERE id = :id');
			$q->bindValue(':statut', 0);
			$q->bindValue(':id', $comment->id(), \PDO::PARAM_INT);
			
			$q->execute();
	}

	public function statutDesactiver(Comment $comment)
	{
			$q = $this->dao->prepare('UPDATE comments SET statut = :statut WHERE id = :id');
			$q->bindValue(':statut', 1);
			$q->bindValue(':id', $comment->id(), \PDO::PARAM_INT);
			
			$q->execute();
	}

	public function countComments()
	{
		return $this->dao->query('SELECT COUNT(*) FROM comments WHERE id')->fetchColumn() ;
	}

	public function countSignaler()
	{
		return $this->dao->query('SELECT COUNT(*) FROM comments WHERE signaler')->fetchColumn() ;
	}

	public function getList($debut = -1, $limite = -1)
	{
		$sql = 'SELECT id, auteur, contenu, signaler, statut, date FROM comments WHERE signaler ORDER BY id DESC';
		
		if ($debut != -1 || $limite != -1)
		{
			$sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
		}
		
		$requete = $this->dao->query($sql);
		$requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');
		
		$listeCommentsSignaler = $requete->fetchAll();
		
		foreach ($listeCommentsSignaler as $comments)
		{
			$comments->setDate(new \DateTime($comments->date()));
			
		}
		
		$requete->closeCursor();
		
		return $listeCommentsSignaler;
	}

	public function getListAutre($debut = -1, $limite = -1)
	{
		$sql = 'SELECT id, auteur, contenu, signaler, statut, date FROM comments WHERE id ORDER BY id DESC';
		
		if ($debut != -1 || $limite != -1)
		{
			$sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
		}
		
		$requete = $this->dao->query($sql);
		$requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');
		
		$listeCommentsAutre = $requete->fetchAll();
		
		foreach ($listeCommentsAutre as $comments)
		{
			$comments->setDate(new \DateTime($comments->date()));
			
		}
		
		$requete->closeCursor();
		
		return $listeCommentsAutre;
	}
}