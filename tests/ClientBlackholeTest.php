<?php

namespace YPStorageEngine;

class ClientBlackholeTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var \YPStorageEngine\ClientBlackhole
     */
	private $clientBlackhole;

	public function setUp() {
		$this->clientBlackhole = new ClientBlackhole();
	}

	/**
	 * 	@covers \YPStorageEngine\ClientBlackhole::__construct
	 */
	public function testConstructor() {
		
		$clientBlackhole = new ClientBlackhole();
		$this->assertInstanceOf('\YStorageEngine\IClient', $clientBlackhole);

	}

    public function testFetchOne(){
        $this->assertNull($this->clientBlackhole->fetchOne(array()));
    }

    public function testInsert(){
        $this->clientBlackhole->insert(array());
    }

    public function testUpsert(){
        $this->clientBlackhole->upsert(array(), array());
    }

    public function testUpdate(){
        $this->clientBlackhole->update(array(), array());
    }

}