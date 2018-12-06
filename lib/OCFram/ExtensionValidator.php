<?php
namespace OCFram;
 
class ExtensionValidator extends Validator
{
 protected $extensions;
 
  
  public function __construct($errorMessage,array $extensions)
  {
    parent::__construct($errorMessage);
    $this->setExtensions($extensions);
  
  }
  
  public function isValid($value)
  {

      
      $extension = strrchr($value['name'],'.');     
           
    
    return in_array($extension,$this->extensions);
  }
  
  public function setExtensions( array $extensions)
  {
  $this->extensions = $extensions;
    }
 
}
