<?php

namespace YPFlatStorage;

/**
 * Class ClientBlackholeTest
 * @package YPFlatStorage
 */
class ClientBlackholeTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var \YPFlatStorage\ClientBlackhole
     */
	private $clientBlackhole;

    /**
     *  Prepare each test with pure fixture
     */
    public function setUp() {
		$this->clientBlackhole = new ClientBlackhole();
	}

	/**
	 * 	@covers \YPFlatStorage\ClientBlackhole::__construct
	 */
	public function testConstructor() {
		
		$clientBlackhole = new ClientBlackhole();
		$this->assertInstanceOf('\YPFlatStorage\IClient', $clientBlackhole);

	}

    /**
     *  @covers \YPFlatStorage\ClientBlackhole::fetchOne
     */
    public function testFetchOne(){
        $this->assertNull($this->clientBlackhole->fetchOne('domain-name', array()));
    }

    /**
     *  @covers \YPFlatStorage\ClientBlackhole::insert
     */
    public function testInsert(){
        $this->clientBlackhole->insert('domain-name', array());
    }

    /**
     *  @covers \YPFlatStorage\ClientBlackhole::upsert
     */
    public function testUpsert(){
        $this->clientBlackhole->upsert('domain-name', array(), array());
    }

    /**
     *  @covers \YPFlatStorage\ClientBlackhole::update
     */
    public function testUpdate(){
        $this->clientBlackhole->update('domain-name', array(), array());
    }

}