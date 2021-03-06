<?php

namespace Waddle\Parsers;

class GPXParserTest extends \PHPUnit\Framework\TestCase
{
    
    public $parser, $activity;
    
    public function setUp() {
        $this->parser = new \Waddle\Parsers\GPXParser();
        $this->activity = $this->parser->parse( __DIR__ . '/../run.gpx' );
    }
    
    public function testActivityStartTime(){
        $this->assertEquals('2017-05-27 09:13:01', $this->activity->getStartTime('Y-m-d H:i:s'));
    }
    
    public function testActivityLaps(){
        $this->assertEquals(1, count($this->activity->getLaps()));
    }
    
    public function testActivityTotalDistance(){
        $this->assertEquals(4808.3455233594, $this->activity->getTotalDistance()); # This calculates a different value to the value given by TCX
    }
    
    public function testActivityTotalDuration(){
        $this->assertEquals(1423, $this->activity->getTotalDuration()); # This calculates a different value to the value given by TCX
    }
    
    public function testActivityAveragePacePerMile(){
        $this->assertEquals('00:07:56', $this->activity->getAveragePacePerMile()); # This calculates a different value to the value given by TCX
    }
    
    public function testActivityAveragePacePerKilometre(){
        $this->assertEquals('00:04:55', $this->activity->getAveragePacePerKilometre());
    }
    
    public function testActivityAverageSpeedMPH(){
        $this->assertEquals(7.56, round($this->activity->getAverageSpeedInMPH(), 2)); # This calculates a different value to the value given by TCX
    }
    
    public function testActivityAverageSpeedKPH(){
        $this->assertEquals(12.16, round($this->activity->getAverageSpeedInKPH(), 2)); # This calculates a different value to the value given by TCX
    }
    
    public function testActivityTotalCalories(){
        $this->assertEquals(0, $this->activity->getTotalCalories()); # Not able to calculate this, as GPX does not support it
    }
    
    public function testActivityMaxSpeedMPH(){
        $this->assertEquals(12.21, round($this->activity->getMaxSpeedInMPH(), 2)); # This calculates a different value to the value given by TCX
    }
    
    public function testActivityMaxSpeedKPH(){
        $this->assertEquals(19.66, round($this->activity->getMaxSpeedInKPH(), 2)); # This calculates a different value to the value given by TCX
    }
    
    public function testActivityTotalAscent(){
        $result = $this->activity->getTotalAscentDescent();
        $this->assertEquals(50.9, $result['ascent']);
    }
    
    public function testActivityTotalDescent(){
        $result = $this->activity->getTotalAscentDescent();
        $this->assertEquals(50.2, $result['descent']);
    }
    
    public function testActivitySplitsInMiles(){
        $this->assertEquals(3, count($this->activity->getSplits('mi')));
    }
    
    public function testActivitySplitsInKilometres(){
        $this->assertEquals(5, count($this->activity->getSplits('k')));
    }
    
}