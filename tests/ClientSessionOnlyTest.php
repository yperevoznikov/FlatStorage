<?php

namespace YPFlatStorage;

class ClientSessionOnlyTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var \YPFlatStorage\ClientSessionOnly
     */
    private $client;

    /**
     *  Prepare each test with pure fixture
     */
    public function setUp() {
        $this->client = new ClientSessionOnly();
    }

    /**
     * 	@covers \YPFlatStorage\ClientSessionOnly::__construct
     */
    public function testConstructor() {

        $client = new ClientSessionOnly();
        $this->assertInstanceOf('\YPFlatStorage\IClient', $client);

    }

    /**
     *  @covers \YPFlatStorage\ClientSessionOnly::fetchOne
     *  @covers \YPFlatStorage\ClientSessionOnly::insert
     *  @covers \YPFlatStorage\ClientSessionOnly::upsertDomain
     */
    public function testFetchOne(){

        # when no data inside storage
        $this->assertNull($this->client->fetchOne('domain', array('fieldName' => 'fieldValue')));

        # insert a slot
        $this->client->insert('domain', array('fieldName' => 'fieldValue'));

        # test that we have not
        $res = $this->client->fetchOne('domain', array('fieldName' => 'fieldValue'));
        $this->assertEquals($res->fieldName, 'fieldValue');

    }

    /**
     *  @covers \YPFlatStorage\ClientSessionOnly::upsert
     */
    public function testUpsert(){

        # when no slot found -> need insert new slot
        $foundSlot = $this->client->upsert('domain', array('f1' => 'v1'), array('f2' => 'v2', 'f3' => 'v3'));
        $res = $this->client->fetchOne('domain', array('f1' => 'v1'));
        $this->assertEquals($res->f2, 'v2');

        # when no slot found -> need insert new slot
        $foundSlot = $this->client->upsert('domain', array('f1' => 'v1'), array('f2' => 'v2-modified'));
        $res = $this->client->fetchOne('domain', array('f1' => 'v1'));
        $this->assertEquals($res->f2, 'v2-modified');
        $this->assertEquals($res->f3, 'v3');


    }

    /**
     *  @covers \YPFlatStorage\ClientSessionOnly::update
     */
    public function testUpdate(){

        # when no data inside storage
        $this->assertNull($this->client->fetchOne('domain', array('fieldName' => 'fieldValue')));

        # insert a slot
        $this->client->insert('domain', array('fieldName' => 'fieldValue'));
        $this->client->update('domain', array('fieldName' => 'fieldValue'), array('newField' => 'newValue'));

        # test that we have not
        $res = $this->client->fetchOne('domain', array('fieldName' => 'fieldValue'));
        $this->assertEquals($res->newField, 'newValue');

    }

}