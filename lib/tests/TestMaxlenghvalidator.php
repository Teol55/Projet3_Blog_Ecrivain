<?php
namespace tests;

use PHPUnit\Framework\TestCase;
use \OCFram\MaxLengthValidator;
require __DIR__.'/../OCFram/Validator.php';
require __DIR__.'/../OCFram/MaxLengthValidator.php';


class TestMaxlenghvalidator extends TestCase
{
    
   public function testTrueNotNullValidator()
    {  
    
    $essai= new MaxLengthValidator('Merci de spécifier le titre du chapitre',10);
    $value='hello';
    
    $result=$essai->isValid($value);
    
    $this->assertTrue($result);
    
        
   }
    
     public function testFalseNotNullValidator()
    {  
    
    $essai= new MaxLengthValidator('Merci de spécifier le titre du chapitre',10);
    $value='Hello world i m happy';
    
    $result=$essai->isValid($value);
    
    $this->assertFalse($result);
    
        
   } 
    
    
    
    
    
    
    
    
}
