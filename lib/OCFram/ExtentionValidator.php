<?php
namespace OCFram;
 
class ExtentionValidator extends Validator
{
 protected $extentions;
 
  
  public function __construct($errorMessage,array $extensions)
  {
    parent::__construct($errorMessage);
    
    $this->setExtentions($extensions);
  
  }
  
  public function isValid($nameFile)
  {
 
$extension = strrchr($nameFile, '.');
 
    return in_array($extension,$this->extentions);
  }
  
  public function setExtentions( array $extentions)
  {
  $this->extentions[]= $extentions;
    }
 
}
