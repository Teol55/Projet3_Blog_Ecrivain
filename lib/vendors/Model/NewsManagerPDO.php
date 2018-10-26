<?php
namespace Model;

use \Entity\News;
use OCFram\CacheDatas;
use OCFram\CacheViews;

class NewsManagerPDO extends NewsManager
{
  protected function getCacheName($idNews)
  {
    return 'news_'.$idNews;
  }

  protected function deleteCache($id)
  {
    // On supprime le cache de cette news et de la page d'index
    if ($this->cache)
    {
      $this->cache->deleteCache($this->getCacheName($id));
      $this->cache->deleteCache('Frontend_News_index', CacheViews::SUBDIRECTORY);
    }
  }

  protected function add(News $news)
  {
    $requete = $this->dao->prepare('INSERT INTO news SET auteur = :auteur, titre = :titre, contenu = :contenu, dateAjout = NOW(), dateModif = NOW()');
    
    $requete->bindValue(':titre', $news->titre());
    $requete->bindValue(':auteur', $news->auteur());
    $requete->bindValue(':contenu', $news->contenu());
    
    $requete->execute();

    $this->cache->deleteCache('Frontend_News_index', CacheViews::SUBDIRECTORY);
  }

  public function count()
  {
    return $this->dao->query('SELECT COUNT(*) FROM news')->fetchColumn();
  }

  public function delete($id)
  {
    $this->dao->exec('DELETE FROM news WHERE id = '.(int) $id);

    $this->deleteCache($id);
  }

  public function getList($debut = -1, $limite = -1)
  {
    $sql = 'SELECT id, auteur, titre, contenu, dateAjout, dateModif FROM news ORDER BY id DESC';
    
    if ($debut != -1 || $limite != -1)
    {
      $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
    }
    
    $requete = $this->dao->query($sql);
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\News');
    
    $listeNews = $requete->fetchAll();
    
    foreach ($listeNews as $news)
    {
      $news->setDateAjout(new \DateTime($news->dateAjout()));
      $news->setDateModif(new \DateTime($news->dateModif()));
    }
    
    $requete->closeCursor();
    
    return $listeNews;
  }
  
  public function getUnique($id)
  {
    // On regarde si on a le résultat en cache
    $cacheName = '';
    if ($this->cache && ($this->cache instanceof CacheDatas))
    {
      $cacheName = $this->getCacheName($id);
      if ($news = $this->cache->getObjectFromCache($cacheName))
        return $news;
    }

    $requete = $this->dao->prepare('SELECT id, auteur, titre, contenu, dateAjout, dateModif FROM news WHERE id = :id');
    $requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
    $requete->execute();
    
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\News');
    
    if ($news = $requete->fetch())
    {
      $news->setDateAjout(new \DateTime($news->dateAjout()));
      $news->setDateModif(new \DateTime($news->dateModif()));

      // On enregistre la donnée en cache pendant 7 jours
      if ($cacheName != '')
        $this->cache->setObjectToCache($cacheName, $news, 24 * 7);

      return $news;
    }
    
    return null;
  }

  protected function modify(News $news)
  {
    $requete = $this->dao->prepare('UPDATE news SET auteur = :auteur, titre = :titre, contenu = :contenu, dateModif = NOW() WHERE id = :id');
    
    $requete->bindValue(':titre', $news->titre());
    $requete->bindValue(':auteur', $news->auteur());
    $requete->bindValue(':contenu', $news->contenu());
    $requete->bindValue(':id', $news->id(), \PDO::PARAM_INT);
    
    $requete->execute();

    $this->deleteCache($news->id());
  }
}