<?php
namespace Model;

use \Entity\Comment;
use OCFram\CacheDatas;

class CommentsManagerPDO extends CommentsManager
{
  protected function getCacheName($idNews)
  {
    return 'comments_'.$idNews;
  }

  /**
   * Supprime la liste des commentaires de la news du cache
   *
   * @param int $idNews Identifiant de la news
   * @param int $idComment Identifiant du commentaire, utilisé si on n'a pas l'id de la news
   *
   */
  protected function deleteCache($idNews, $idComment = 0)
  {
    if ($this->cache)
    {
      if ($idNews == 0)
        $idNews = $this->getNewsId($idComment);

      $this->cache->deleteCache($this->getCacheName($idNews));
    }
  }

  protected function add(Comment $comment)
  {
    $q = $this->dao->prepare('INSERT INTO comments SET news = :news, auteur = :auteur, contenu = :contenu, date = NOW()');
    
    $q->bindValue(':news', $comment->news(), \PDO::PARAM_INT);
    $q->bindValue(':auteur', $comment->auteur());
    $q->bindValue(':contenu', $comment->contenu());
    
    $q->execute();
    
    $comment->setId($this->dao->lastInsertId());

    $this->deleteCache($comment->news());
  }

  public function delete($id)
  {
    $this->deleteCache(0, $id);

    $this->dao->exec('DELETE FROM comments WHERE id = '.(int) $id);
  }

  public function deleteFromNews($news)
  {
    $this->dao->exec('DELETE FROM comments WHERE news = '.(int) $news);

    $this->deleteCache($news);
  }
  
  public function getListOf($news)
  {
    // On regarde si on a le résultat en cache
    $cacheName = '';
    if ($this->cache && ($this->cache instanceof CacheDatas))
    {
      $cacheName = $this->getCacheName($news);
      if ($comments = $this->cache->getObjectFromCache($cacheName))
      {
        echo "RECUPERATION DEPUIS LE CACHE\n";
        return $comments;
      }
    }

    if (!ctype_digit($news))
    {
      throw new \InvalidArgumentException('L\'identifiant de la news passé doit être un nombre entier valide');
    }
    
    $q = $this->dao->prepare('SELECT id, news, auteur, contenu, date FROM comments WHERE news = :news');
    $q->bindValue(':news', $news, \PDO::PARAM_INT);
    $q->execute();
    
    $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');
    
    $comments = $q->fetchAll();
    
    foreach ($comments as $comment)
    {
      $comment->setDate(new \DateTime($comment->date()));
    }

    // On enregistre la donnée en cache pendant 7 jours
    if ($cacheName != '')
      $this->cache->setObjectToCache($cacheName, $comments, 24 * 7);

    return $comments;
  }

  protected function modify(Comment $comment)
  {
    $q = $this->dao->prepare('UPDATE comments SET auteur = :auteur, contenu = :contenu WHERE id = :id');
    
    $q->bindValue(':auteur', $comment->auteur());
    $q->bindValue(':contenu', $comment->contenu());
    $q->bindValue(':id', $comment->id(), \PDO::PARAM_INT);
    
    $q->execute();

    $this->deleteCache(0, $comment->id());
  }

  public function getNewsId($id)
  {
    $q = $this->dao->prepare('SELECT news FROM comments WHERE id = :id');
    $q->bindValue(':id', (int) $id, \PDO::PARAM_INT);
    $q->execute();

    $q->setFetchMode(\PDO::FETCH_NUM);

    if ($row = $q->fetch())
      return $row[0];

    return 0;
  }

  public function get($id)
  {
    $q = $this->dao->prepare('SELECT id, news, auteur, contenu FROM comments WHERE id = :id');
    $q->bindValue(':id', (int) $id, \PDO::PARAM_INT);
    $q->execute();
    
    $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');
    
    return $q->fetch();
  }
}