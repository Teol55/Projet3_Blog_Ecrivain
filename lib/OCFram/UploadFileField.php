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
    
    $widget .= '<div class="form-group"> <label for="text" class="col-lg-4 control-label">'.$this->label.'</label><div class="col-lg-6"><input type="hidden" name="MAX_FILE_SIZE" value="'.$this->size.'"//>';
    
    $widget .='<input type="'.$this->type .'" name="'.$this->name .'"></div> </div>';
    
    
  
    
    
   
    return $widget;
  }
  
   
  
}
