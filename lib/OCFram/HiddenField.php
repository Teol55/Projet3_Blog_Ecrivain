<?php
namespace OCFram;

class HiddenField extends Field
{
 
  
  public function buildWidget()
  {
    $widget = '';
    
    
    
    $widget .= ' <input type="hidden" name="'.$this->name .'" ';
      
    if (!empty($this->value))
    {
      $widget .= ' value="'.htmlspecialchars($this->value).'"';
    }
      
   $widget .='//>';
     return $widget;
  }
}
