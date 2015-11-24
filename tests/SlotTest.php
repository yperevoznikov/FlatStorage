<?php

namespace YPFlatStorage;

class SlotTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var \YPFlatStorage\Slot
     */
    private $slot;

    /**
     *  Prepare each test with pure fixture
     */
    public function setUp() {
        $this->slot = new Slot();
    }

    /**
     * @dataProvider matchCriteriaProvider
     */
    public function testMatchCriteria($inputFields, $criteria, $expected){
        $slot = new Slot($inputFields);
        $res = $slot->matchCriteria($criteria);
        $this->assertEquals($expected, $res);
    }

    public function matchCriteriaProvider() {
        return array(
            array(array('f1'=>'v1'), array('f1'=>'v1'), true),
            array(array('f1'=>'v1'), array('f1'=>'v2'), false),
            array(array('f1'=>'v1'), array('m'=>'n', 'f1'=>'v1'), false),
            array(array('m'=>'n', 'f1'=>'v1'), array('f1'=>'v1'), true),
            array(array('m'=>'n', 'f1'=>null), array('f1'=>null), true),
        );
    }

    public function testUpdate(){
        $this->slot->update(array('f1' => 'v1'));
        $this->assertEquals('v1', $this->slot->f1);
    }

}