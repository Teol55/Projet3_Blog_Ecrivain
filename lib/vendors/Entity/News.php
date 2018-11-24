<?php
namespace Entity;

use \OCFram\Entity;

class News extends Entity
{
  protected $chapitre,
            $titre,
            $contenu,
            $dateAjout,
            $dateModif,
            $image,
            $sizeFile,
            $nameImage;

  const CHAPITRE_INVALIDE = 1;
  const TITRE_INVALIDE = 2;
  const CONTENU_INVALIDE = 3;
  const IMAGE_INVALIDE = 4;

  public function isValid()
  {
    return !(empty($this->chapitre) || empty($this->titre) || empty($this->contenu) || empty($this->image));
  }


  // SETTERS //

  public function setChapitre($chapitre)
  {
    if (!is_string($chapitre) || empty($chapitre))
    {
      $this->erreurs[] = self::CHAPITRE_INVALIDE;
    }

    $this->chapitre = $chapitre;
  }

  public function setTitre($titre)
  {
    if (!is_string($titre) || empty($titre))
    {
      $this->erreurs[] = self::TITRE_INVALIDE;
    }

    $this->titre = $titre;
  }

  public function setContenu($contenu)
  {
    if (!is_string($contenu) || empty($contenu))
    {
      $this->erreurs[] = self::CONTENU_INVALIDE;
    }

    $this->contenu = $contenu;
  }

  public function setDateAjout(\DateTime $dateAjout)
  {
    $this->dateAjout = $dateAjout;
  }

  public function setDateModif(\DateTime $dateModif)
  {
    $this->dateModif = $dateModif;
  }

public function setImage($image)
{
    if(empty($image))
    {
      $this->erreurs[]= self::IMAGE_INVALIDE;   
    }
    $this->image=$image;
    
  error_log("set image :" .print_r($image,true).PHP_EOL,3,"../../../tmp/mes-erreurs.log");  
    
}
public function setSizeFile($sizeFile)
{
    $this->sizeFile=$sizeFile;
 

    
}
    
 public function setNameImage($nameImage)
     
 {
     $this->nameImage= $nameImage;
 }
  // GETTERS //

  public function chapitre()
  {
    return $this->chapitre;
  }

  public function titre()
  {
    return $this->titre;
  }

  public function contenu()
  {
    return $this->contenu;
  }

  public function dateAjout()
  {
    return $this->dateAjout;
  }

  public function dateModif()
  {
    return $this->dateModif;
  }
  public function image()
  {
        return $this->image;
  }
public function sizeFile()
  {
        return $this->sizeFile;
  }
public function nameImage()
{
    return $this->nameImage;
}
}
