<?php
namespace OCFram;

abstract class Manager
{
  protected $dao;
  /** @var Cache $cache */
  protected $cache;
  
  public function __construct($dao)
  {
    $this->dao = $dao;
  }

  public function setCache($cache)
  {
    $this->cache = $cache;
  }
}