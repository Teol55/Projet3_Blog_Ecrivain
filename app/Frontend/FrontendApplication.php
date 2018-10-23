<?php
namespace App\Frontend;

use \OCFram\Application;

class FrontendApplication extends Application
{
  public function __construct()
  {
    parent::__construct();

    $this->name = 'Frontend';
  }

  public function run()
  {
    $controller = $this->getController();
    $content = $controller->getFromCache();

    if ($content === null)
    {
      $controller->execute();

      $this->httpResponse->setPage($controller->page());
      $content = $this->httpResponse->send();
      $controller->setToCache($content);
      exit();
    }
    $this->httpResponse->sendContent($content);
  }
}