<?php
namespace OCFram;

class HTTPRequest extends ApplicationComponent
{
  public function cookieData($key)
  {
    return isset($_COOKIE[$key]) ? $_COOKIE[$key] : null;
  }

  public function cookieExists($key)
  {
    return isset($_COOKIE[$key]);
  }

  public function getData($key)
  {
    return isset($_GET[$key]) ? $_GET[$key] : null;
  }

  public function getExists($key)
  {
    return isset($_GET[$key]);
  }

  public function method()
  {
    return $_SERVER['REQUEST_METHOD'];
  }

  public function postData($key)
  {
    return isset($_POST[$key]) ? $_POST[$key] : null;
  }

  public function postExists($key)
  {
    return isset($_POST[$key]);
  }

  public function requestURI()
  {
    return $_SERVER['REQUEST_URI'];
  }
 
  public function filesExists($key)
    {
        $test=$_FILES[$key];
      error_log( "test dans httprequest: ".print_r($test,true).PHP_EOL,3,"../../../tmp/mes-erreurs.log");
      if(!($test['error']=== 4))
      {return true;
      }
    }
  public function filesData($key)
  {
      return isset($_FILES[$key]) ? $_FILES[$key] : null;
  }
}
