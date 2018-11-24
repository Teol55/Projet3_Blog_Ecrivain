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
    $requete = $this->dao->prepare('INSERT INTO news SET chapitre = :chapitre, titre = :titre, contenu = :contenu,nameImage =:nameImage, dateAjout = NOW(), dateModif = NOW()');
    
    $requete->bindValue(':titre', $news->titre());
    $requete->bindValue(':chapitre', $news->chapitre());
    $requete->bindValue(':contenu', $news->contenu());
    $requete->bindValue(':nameImage',$news->nameImage());
    
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
    $sql = 'SELECT id, chapitre, titre, contenu, dateAjout,nameImage, dateModif FROM news ORDER BY id DESC';
    
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
     public function getAll()
  {
    $sql = 'SELECT id, chapitre, titre, contenu, dateAjout, dateModif,nameImage FROM news ORDER BY id ASC';
    
       
    $requete = $this->dao->query($sql);
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\News');
    
    $listeAllNews = $requete->fetchAll();
  
    foreach ($listeAllNews as $news)
    {
    
      $news->setDateAjout(new \DateTime($news->dateAjout()));
      $news->setDateModif(new \DateTime($news->dateModif()));
    }
    
    $requete->closeCursor();
    
    return $listeAllNews;
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

    $requete = $this->dao->prepare('SELECT id, chapitre, titre, contenu, dateAjout, dateModif, nameImage FROM news WHERE id = :id');
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
    $requete = $this->dao->prepare('UPDATE news SET chapitre = :chapitre, titre = :titre, contenu = :contenu, nameImage =:nameImage, dateModif = NOW() WHERE id = :id');
    
    $requete->bindValue(':titre', $news->titre());
    $requete->bindValue(':chapitre', $news->chapitre());
    $requete->bindValue(':contenu', $news->contenu());
    $requete->bindValue(':id', $news->id(), \PDO::PARAM_INT);
    $requete->bindValue(':nameImage',$news->nameImage());
    
    $requete->execute();

    $this->deleteCache($news->id());
  }
    public function getNewsComment()
    {
         $sql ='SELECT news.id as idNews, news.chapitre as chapitre , news.titre as titre,c.id as idComment, c.auteur as auteur,c. contenu as contenu, c.news as newsId, c.date as date, c.signalement as signalement FROM news LEFT JOIN comments as c ON news.id =c.news ORDER BY chapitre ';
        
        
        
    $requete = $this->dao->query($sql);
    
    
    $listeAllNews = $requete->fetchAll();
        
    foreach($listeAllNews as $listComment)
            {
                $listAllComments=array(
                "news" =>array(
                        "idNews=>" => $listComment['idNews'],
                        "chapitre"=>$listComment['chapitre'],
                        "titre"=>$listComment['titre']),
                "comments"=>array(
                    "idComment" => $listComment['idComment'],
                    "auteur" => $listComment['auteur'],
                    "contenu" => $listComment['contenu'],
                    "newsId" => $listComment['newsId'],
                    "dats" => $listComment['date'],
                    "signalement" => $listComment['signalement']));
            }
    
    return $listAllComments; 
        
    }

}
