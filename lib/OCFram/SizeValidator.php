<?php
namespace OCFram;
 
class SizeValidator extends Validator
{
 protected $maxSize;
 
  
  public function __construct($errorMessage, $maxSize)
  {
    parent::__construct($errorMessage);
    
    $this->setMaxSize($maxSize);
    
    
  }
  
  public function isValid($file)
  {
$size = filesize($file);
 
return $this->maxSize > $size;
 
   
  }
  
  public function setMaxSize($maxSize)
    {
    $maxSize = (int) $maxSize;
    
    if ($maxSize > 0)
    {
      $this->maxSize = $maxSize;
    }
    else
    {
      throw new \RuntimeException('La taille minimum doit être un nombre supérieur à 0');
    }
  }
 
}
