<?php
namespace Model;

use \OCFram\Manager;
use \Entity\News;

abstract class NewsManager extends Manager
{
  /**
   * Méthode permettant d'ajouter une news.
   * @param $news News La news à ajouter
   * @return void
   */
  abstract protected function add(News $news);
  
  /**
   * Méthode permettant d'enregistrer une news.
   * @param $news News la news à enregistrer
   * @see self::add()
   * @see self::modify()
   * @return void
   */
  public function save(News $news)
  {
    if ($news->isValid())
    {
         $this->formatImage($news);
     error_log( "news dans fonction save= " .print_r($news,true) .PHP_EOL,3,"../../../tmp/mes-erreurs.log");
    
        $this->saveImage($news['image']);
        
      $news->isNew() ? $this->add($news) : $this->modify($news);
    }
    else
    {
      throw new \RuntimeException('La news doit être validée pour être enregistrée');
    }
  }

  /**
   * Méthode renvoyant le nombre de news total.
   * @return int
   */
  abstract public function count();

  /**
   * Méthode permettant de supprimer une news.
   * @param $id int L'identifiant de la news à supprimer
   * @return void
   */
  abstract public function delete($id);

  /**
   * Méthode retournant une liste de news demandée.
   * @param $debut int La première news à sélectionner
   * @param $limite int Le nombre de news à sélectionner
   * @return array La liste des news. Chaque entrée est une instance de News.
   */
  abstract public function getList($debut = -1, $limite = -1);
  
  /**
   * Méthode retournant une news précise.
   * @param $id int L'identifiant de la news à récupérer
   * @return News La news demandée
   */
  abstract public function getUnique($id);

  /**
   * Méthode permettant de modifier une news.
   * @param $news news la news à modifier
   * @return void
   */
  abstract protected function modify(News $news);

    /**
    *Méthode permettant de retourner toutes les Chapitres
    */
 abstract protected function getAll();
    
    /**
    *Methode permettant une jointure externe entre News et commentaire
    */
 abstract public function getNewsComment();

public function saveImage(array $image)
{
    $dossier = '../upload/';
     $fichier = basename($image['name']);
     if(move_uploaded_file($image['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
     {
          error_log("Upload effectué avec succès !".PHP_EOL ,3,"../../../tmp/mes-erreurs.log");
     }
     else //Sinon (la fonction renvoie FALSE).
     {
         error_log("Echec de l\'upload !".PHP_EOL ,3,"../../../tmp/mes-erreurs.log");
     }

}
public function formatImage(News $news)
    
{
    $image=$news['image'];
    $extension = strrchr($image['name'],'.');
    $name=$news['chapitre'];
//on modifie le nom de l image par le chapitre
    $fichier = strtr($name,
     'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
     'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy'); 
//On remplace les lettres accentutées par les non accentuées dans $fichier.
//Et on récupère le résultat dans fichier
 
//En dessous, il y a l'expression régulière qui remplace tout ce qui n'est pas une lettre non accentuées ou un chiffre
//dans $fichier par un tiret "-" et qui place le résultat dans $fichier.
$fichier = preg_replace('/([^.a-z0-9]+)/i', '_', $fichier);
    
    $image['name']=$fichier.$extension;

    
    $news['image']=$image;
     error_log( "news sortie fonction format= " .print_r($news,true).PHP_EOL,3,"../../../tmp/mes-erreurs.log");
    $news->setNameImage($image['name']);
    return $news;
    
   
    
}
    

}
