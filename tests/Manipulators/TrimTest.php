<?php

namespace League\Glide\Manipulators;

use Mockery;

class TrimTest extends \PHPUnit_Framework_TestCase
{
    private $manipulator;

    public function setUp()
    {
        $this->manipulator = new Trim();
    }

    public function tearDown()
    {
        Mockery::close();
    }

    public function testCreateInstance()
    {
        $this->assertInstanceOf('League\Glide\Manipulators\Trim', $this->manipulator);
    }

    public function testRun()
    {
        // $image = Mockery::mock('Intervention\Image\Image', function ($mock) {
        //     $mock->shouldReceive('base')->with('top-left')->once();
        // });

        // $this->assertInstanceOf(
        //     'Intervention\Image\Image',
        //     $this->manipulator->setParams(['trimbase' => 'top-left'])->run($image)
        // );
    }

    public function testGetBase()
    {
        $this->assertSame('top-left', $this->manipulator->setParams(['trimbase' => 'top-left'])->getBase());
        $this->assertSame('bottom-right', $this->manipulator->setParams(['trimbase' => 'bottom-right'])->getBase());
        $this->assertSame('transparent', $this->manipulator->setParams(['trimbase' => 'transparent'])->getBase());
        $this->assertSame('top-left', $this->manipulator->setParams(['trimbase' => null])->getBase());
    }

    public function testGetAway()
    {
        $this->assertSame(['top'], $this->manipulator->setParams(['trimaway' => 'top'])->getAway());
        $this->assertSame(['right'], $this->manipulator->setParams(['trimaway' => 'right'])->getAway());
        $this->assertSame(['bottom'], $this->manipulator->setParams(['trimaway' => 'bottom'])->getAway());
        $this->assertSame(['left'], $this->manipulator->setParams(['trimaway' => 'left'])->getAway());
        $this->assertSame(['top', 'left', 'bottom', 'right'], $this->manipulator->setParams(['trimaway' => 'top,left,bottom,right'])->getAway());
        $this->assertSame(null, $this->manipulator->setParams(['trimaway' => 'a,b,c,d'])->getAway());
        $this->assertSame(null, $this->manipulator->setParams(['trimaway' => null])->getAway());
    }

    public function testGetTolerance()
    {
        $this->assertSame(50, $this->manipulator->setParams(['trimtol' => '50'])->getTolerance());
        $this->assertSame(50, $this->manipulator->setParams(['trimtol' => 50])->getTolerance());
        $this->assertSame(null, $this->manipulator->setParams(['trimtol' => null])->getTolerance());
        $this->assertSame(null, $this->manipulator->setParams(['trimtol' => '101'])->getTolerance());
        $this->assertSame(null, $this->manipulator->setParams(['trimtol' => '-101'])->getTolerance());
        $this->assertSame(null, $this->manipulator->setParams(['trimtol' => 'a'])->getTolerance());
    }

    public function testGetFeather()
    {
        $this->assertSame(50, $this->manipulator->setParams(['trimfea' => '50'])->getFeather());
        $this->assertSame(50, $this->manipulator->setParams(['trimfea' => 50])->getFeather());
        $this->assertSame(null, $this->manipulator->setParams(['trimfea' => null])->getFeather());
        $this->assertSame(null, $this->manipulator->setParams(['trimfea' => '-101'])->getFeather());
        $this->assertSame(null, $this->manipulator->setParams(['trimfea' => 'a'])->getFeather());
    }
}
