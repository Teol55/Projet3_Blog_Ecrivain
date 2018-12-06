<?php
namespace OCFram;

class UploadFileField extends Field
{
  
 
 protected $size;
    
    
public function buildWidget()
  {
    $widget = '';
    $widget .='<div class="form-group">';
    
    if (!empty($this->errorMessage))
    {
      $widget .='<div class="has-error has-feedback"><label class="control-label  class="col-lg-6" for="idError">' .$this->errorMessage.'</label></div><br />';
    }
    
    
    $widget .= '<label for="text" class="col-lg-4 control-label">'.$this->label.'</label><div class="col-lg-6"><input type="hidden" name="MAX_FILE_SIZE" value="'.$this->size.'"//>';
    
    $widget .='<input type="'.$this->type .'" name="'.$this->name .'"></div> </div>';
    
    
  
    
    
   
    return $widget;
  }
  
   
  
}
