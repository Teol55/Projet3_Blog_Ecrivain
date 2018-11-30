<?php
namespace OCFram;

class StringField extends Field
{
  protected $maxLength;
  
  public function buildWidget()
  {
    $widget = '';
    $widget .='<div class="form-group">';
    
    if (!empty($this->errorMessage))
    {
      $widget .='<div class="has-error has-feedback"><label class="control-label  class="col-lg-6" for="idError">' .$this->errorMessage.'</label></div><br />';
    }
    
    $widget .= '
            <label for="text" class="col-lg-4 control-label">
'.$this->label.'</label><div class="col-lg-6"><input type="text" name="'.$this->name.'"';
    
    if (!empty($this->value))
    {
      $widget .= ' value="'.htmlspecialchars($this->value).'"';
    }
    
    if (!empty($this->maxLength))
    {
      $widget .= ' maxlength="'.$this->maxLength.'"';
    }
      
     
    if (!empty($this->size))
    {
      $widget .= ' size="'.$this->size.'"';
    }
    
    return $widget .= ' /> </div> </div>';
  }
  
  public function setMaxLength($maxLength)
  {
    $maxLength = (int) $maxLength;
    
    if ($maxLength > 0)
    {
      $this->maxLength = $maxLength;
    }
    else
    {
      throw new \RuntimeException('La longueur maximale doit être un nombre supérieur à 0');
    }
  }
}
