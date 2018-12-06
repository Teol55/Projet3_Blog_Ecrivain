<?php
namespace OCFram;

class TextField extends Field
{
  protected $cols;
  protected $rows;
  
  public function buildWidget()
  {
    $widget = '';
    $widget .='<div class="form-group">';
    
    if (!empty($this->errorMessage))
    {
      $widget .='<div class="has-error has-feedback"><label class="control-label  class="col-lg-6" for="idError">' .$this->errorMessage.'</label></div><br />';
    }
    
    $widget .= '<label for="text" class="col-lg-4 control-label">'.$this->label.'</label><div class="col-lg-8"><textarea class="'.$this->classe .'" name="'.$this->name.'"';
    
    if (!empty($this->cols))
    {
      $widget .= ' cols="'.$this->cols.'"';
    }
    
    if (!empty($this->rows))
    {
      $widget .= ' rows="'.$this->rows.'"';
    }
    
    $widget .= '>';
    
    if (!empty($this->value))
    {
      $widget .= htmlspecialchars($this->value);
    }
    
    return $widget.'</textarea></div></div>';
  }
  
  public function setCols($cols)
  {
    $cols = (int) $cols;
    
    if ($cols > 0)
    {
      $this->cols = $cols;
    }
  }
  
  public function setRows($rows)
  {
    $rows = (int) $rows;
    
    if ($rows > 0)
    {
      $this->rows = $rows;
    }
  }
}
