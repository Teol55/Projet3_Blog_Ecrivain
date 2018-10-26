<?php
namespace OCFram;

class CacheViews extends Cache
{
  const SUBDIRECTORY = 'views/';

  protected $application;
  protected $module;
  protected $action;
  protected $delai;

  /**
   * Cache constructor.
   *
   * @param string $application
   * @param string $module
   * @param string $action
   */
  public function __construct($application, $module, $action, $delai)
  {
    parent::__construct();

    $this->application = $application;
    $this->module = $module;
    $this->action = $action;
    $this->delai = $delai;

    $this->cacheSubDirectory = self::SUBDIRECTORY;
  }

  /**
   * Retourne le contenu en cache, ou null si on n'a pas de cache ou si le cache est périmé
   *
   * @return string
   */
  public function getPageFromCache()
  {
    return $this->getFromCache($this->application.'_'.$this->module.'_'.$this->action);
  }

  /**
   * Met en cache une page
   *
   * @param string $content Contenu à écrire
   * @param int $delai Délai en heure de la mise en cace
   */
  public function setPageToCache($content)
  {
    $this->setToCache($this->application.'_'.$this->module.'_'.$this->action, $content, $this->delai);
  }

}