<?php
namespace OCFram;

class CacheDatas extends Cache
{
  const SUBDIRECTORY = 'datas/';

  /**
   * Cache constructor.
   *
   * @param int $delai Délai de validation du cache en heure
   */
  public function __construct()
  {
    parent::__construct();

    $this->cacheSubDirectory = self::SUBDIRECTORY;
  }

  /**
   * Récupération d'un objet depuis le cache
   *
   * @param string $file Nom du fichier
   *
   * @return mixed|null
   */
  public function getObjectFromCache($file)
  {
    $serializedObject = $this->getFromCache($file);

    if ($serializedObject == '')
      return null;

    return unserialize($serializedObject);
  }

  /**
   * Mise en cache d'un objet
   *
   * @param string $file Nom du fichier
   * @param Object $object Objet à enregistrer
   * @param int $delai temps de mise en cace
   */
  public function setObjectToCache($file, $object, $delai)
  {
    $this->setToCache($file, serialize($object), $delai);
  }
}