<?php

namespace YPStorageEngine;

/**
 * Class ClientBlackholeTest
 * @package YPStorageEngine
 */
class ClientBlackholeTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var \YPStorageEngine\ClientBlackhole
     */
	private $clientBlackhole;

    /**
     *  Prepare each test with pure fixture
     */
    public function setUp() {
		$this->clientBlackhole = new ClientBlackhole();
	}

	/**
	 * 	@covers \YPStorageEngine\ClientBlackhole::__construct
	 */
	public function testConstructor() {
		
		$clientBlackhole = new ClientBlackhole();
		$this->assertInstanceOf('\YPStorageEngine\IClient', $clientBlackhole);

	}

    /**
     *  @covers \YPStorageEngine\ClientBlackhole::fetchOne
     */
    public function testFetchOne(){
        $this->assertNull($this->clientBlackhole->fetchOne('domain-name', array()));
    }

    /**
     *  @covers \YPStorageEngine\ClientBlackhole::insert
     */
    public function testInsert(){
        $this->clientBlackhole->insert('domain-name', array());
    }

    /**
     *  @covers \YPStorageEngine\ClientBlackhole::upsert
     */
    public function testUpsert(){
        $this->clientBlackhole->upsert('domain-name', array(), array());
    }

    /**
     *  @covers \YPStorageEngine\ClientBlackhole::update
     */
    public function testUpdate(){
        $this->clientBlackhole->update('domain-name', array(), array());
    }

}