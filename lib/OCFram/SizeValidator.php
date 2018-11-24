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
  
  public function isValid($value)
  {
 error_log( "value SizeValidator= " .print_r($value['tmp_name'],true).PHP_EOL,3,"../../../tmp/mes-erreurs.log");
  $adresse="C:\cache\\evenement.png"  ;  
$size = filesize($value['tmp_name']);
  error_log( "Size SizeValidator= " .$size .PHP_EOL,3,"../../../tmp/mes-erreurs.log");
      
      if(!($this->maxSize > $size) || !($value['error'] == 2))
      {
          return true;
      }
   
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
