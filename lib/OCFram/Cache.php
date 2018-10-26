<?php
namespace OCFram;

class Cache
{
  protected $cacheDirectory;
  protected $cacheSubDirectory;

  /**
   * Cache constructor
   */
  public function __construct()
  {
    $this->cacheDirectory = __DIR__.'/../../tmp/cache/';
  }


  /**
   * Retourne le contenu en cache, ou null si on n'a pas de cache ou si le cache est p�rim�
   *
   * @param string $file Nom du fichier
   *
   * @return string
   */
  public function getFromCache($file)
  {
    // On regarde si le fichier cache existe
    if (!file_exists($this->cacheDirectory.$this->cacheSubDirectory.$file))
      return null;

    // Ouverture du fichier
    if (!($handle = fopen($this->cacheDirectory.$this->cacheSubDirectory.$file, 'r')))
      return null;

    // Lecture de la premi�re ligne qui contient la date de fin de validit�
    $timestamp = fgets($handle)."\n";

    if ($timestamp < time())
    {
      fclose($handle);

      // Le fichier n'est plus valide, on l'efface
      unlink($this->cacheDirectory.$this->cacheSubDirectory.$file);
      return null;
    }

    // On poursuit la lecture et on retourne le r�sultat
    $content = '';
    while (!feof($handle))
      $content .= fgets($handle);

    fclose($handle);

    return $content;
  }

  /**
   * @param string $file Nom du fichier
   * @param string $content Contenu � �crire
   * @param int $delai D�lai en heure de la mise en cace
   */
  public function setToCache($file, $content, $delai)
  {
    // Calcul du timestamp de fin
    $timestamp = time() + $delai * 60 * 60;

    file_put_contents($this->cacheDirectory.$this->cacheSubDirectory.$file, $timestamp."\n".$content, LOCK_EX);
  }

  /**
   * Efface un fichier du cache
   *
   * @param string $file
   * @param string $subDirectory R�pertoire sp�cifique au cache du type � effacer (datas ou wiews)donn�. Permet de
   * surcharger le repertoire du type actuel
   *
   * @return bool
   */
  public function deleteCache($file, $subDirectory = '')
  {
    if ($subDirectory == '')
      $subDirectory = $this->cacheSubDirectory;

    echo "Effacement cache ".$this->cacheDirectory.$subDirectory.$file."\n";

    if (!file_exists($this->cacheDirectory.$subDirectory.$file))
      return false;

    unlink($this->cacheDirectory.$subDirectory.$file);

    return true;
  }
}