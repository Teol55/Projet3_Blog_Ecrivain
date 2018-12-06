<?php
namespace tests;

use PHPUnit\Framework\TestCase;
use \OCFram\ExtensionValidator;
require __DIR__.'/../OCFram/Validator.php';
require __DIR__.'/../OCFram/ExtensionValidator.php';

class TestExtensionValidator extends TestCase
{
   
    public function testTrueExtension()
    {
        $test=  new ExtensionValidator('ce n est pas une extention Valide', ['.png']);
        
        $value=[
                'name'=>'generic.png',
                'size' =>0,
                'tmp_name' => '/generic.jpg'

            ];
        
        $result= $test->isValid($value);
        $this->assertTrue($result);
            
    }
    
    public function testFalseExtension()
    {
        $test=  new ExtensionValidator('ce n est pas une extention Valide', ['.png']);
        
          $value=[
                'name'=>'generic.pnt',
                'size' =>0,
                'tmp_name' => '/generic.jpg'

            ];
        
        $result= $test->isValid($value);
        $this->assertFalse($result);
            
    }

   
}
