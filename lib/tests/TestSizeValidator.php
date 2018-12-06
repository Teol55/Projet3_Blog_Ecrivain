<?php
namespace tests;

use PHPUnit\Framework\TestCase;
use \OCFram\SizeValidator;
require __DIR__.'/../OCFram/Validator.php';
require __DIR__.'/../OCFram/SizeValidator.php';

class TestSizeValidator extends TestCase
{
   
    public function testTrueSizeValidator()
    {
        $test=  new SizeValidator('ce n est pas une extention Valide', 6000);
        
        $value=[
                'name'=>'generic.png',
                'size' =>0,
                'tmp_name' => 'generic.jpg'

            ];
        
        $result= $test->isValid($value);
        $this->assertTrue($result);
            
    }
    
    public function testFalseSizeValidator()
    {
        $test=  new SizeValidator('ce n est pas une extention Valide', 10);
        
          $value=[
                'name'=>'generic.pnt',
                'size' =>0,
                'tmp_name' => 'generic.jpg'

            ];
        
        $result= $test->isValid($value);
        $this->assertTrue($result);
            
    }

   
}
