<?php

use \YStorageEngine;

class ClientBlackholeTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var \YStorageEngine\ClientBlackhole
     */
	private $clientBlackhole;

	public function setUp() {
		$this->clientBlackhole = new \YStorageEngine\ClientBlackhole();
	}

	/**
	 * 	@covers \YStorageEngine\ClientBlackhole::__construct
	 */
	public function testConstructor() {
		
		$clientBlackhole = new \YStorageEngine\ClientBlackhole();

		$this->assertInstanceOf('\YStorageEngine\IClient', $clientBlackhole);

	}

    public function testFetchOne(){
        $this->assertNull($this->clientBlackhole->fetchOne(array()));
    }

}