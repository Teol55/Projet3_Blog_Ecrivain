<?php
namespace tests;

use PHPUnit\Framework\TestCase;
use \OCFram\NotNullValidator;
require __DIR__.'/../OCFram/Validator.php';
require __DIR__.'/../OCFram/NotNullValidator.php';


class TestNotNulValidator extends TestCase
{
    
   public function testFalseNotNullValidator()
    {  
    
    $essai= new NotNullValidator('Merci de spécifier le titre du chapitre');
    $value='';
    
    $result=$essai->isValid($value);
    
    $this->assertFalse($result);
    
        
   }
    
     public function testTrueNotNullValidator()
    {  
    
    $essai= new NotNullValidator('Merci de spécifier le titre du chapitre');
    $value='Hello world';
    
    $result=$essai->isValid($value);
    
    $this->assertTrue($result);
    
        
   } 
    
    
    
    
    
    
    
    
}
