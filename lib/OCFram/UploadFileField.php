<?php
namespace OCFram;

class UploadFileField extends Field
{
  
 
  protected $size;
    
    
public function buildWidget()
  {
    $widget = '';
    
    if (!empty($this->errorMessage))
    {
      $widget .= $this->errorMessage.'<br />';
    }
    
    $widget .= '<label>'.$this->label.'</label><br/><input type="hidden" name="MAX_FILE_SIZE" value="'.$this->size.'"//>';
    
    $widget .='<input type="'.$this->type .'" name="'.$this->name .'">';
    
    
  
    
    
   
    return $widget;
  }
  
   
        public function setSize($size)
  {
  
    
    if (is_int($size))
    {
      $this->size = $size;
    }
  }
}
