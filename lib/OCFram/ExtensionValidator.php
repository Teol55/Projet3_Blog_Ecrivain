<?php
namespace OCFram;
 
class ExtensionValidator extends Validator
{
 protected $extensions;
 
  
  public function __construct($errorMessage,array $extensions)
  {
    parent::__construct($errorMessage);
    error_log( "Valeur extensions= " .print_r($extensions,true) .PHP_EOL,3,"../../../tmp/mes-erreurs.log");
    $this->setExtensions($extensions);
  
  }
  
  public function isValid($value)
  {
 error_log( "value = " .print_r($value,true).PHP_EOL,3,"../../../tmp/mes-erreurs.log");
      
$extension = strrchr($value['name'],'.');
      
      error_log( "Valeur extension " .$extension .PHP_EOL,3,"../../../tmp/mes-erreurs.log");
       error_log( "Valeur extensions " .print_r($this->extensions,true)  .PHP_EOL,3,"../../../tmp/mes-erreurs.log");
      
  if (in_array($extension,$this->extensions))
    {
 error_log( "trouvé dans le tableau "  .PHP_EOL,3,"../../../tmp/mes-erreurs.log");
  }
      else  error_log( "pas trouvé dans le tableau " .PHP_EOL,3,"../../../tmp/mes-erreurs.log");
      
    return in_array($extension,$this->extensions);
  }
  
  public function setExtensions( array $extensions)
  {
  $this->extensions = $extensions;
    }
 
}
