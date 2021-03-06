<?php

namespace YPFlatStorage;

class Database {

    // Query types
    const SELECT =  1;
    const INSERT =  2;
    const UPDATE =  3;
    const DELETE =  4;

    public function query($type, $sql, $as_object = FALSE, array $params = NULL) {
        return null;
    }

    public function as_array(){
        return null;
    }

}

class ClientKohanaDbTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var \YPFlatStorage\ClientKohanaDb
     */
    private $clientKohanaDb;

    /**
     *  Prepare each test with pure fixture
     */
    public function setUp() {
        $this->clientKohanaDb = new ClientKohanaDb(new Database());
    }

    /**
     * 	@covers \YPFlatStorage\ClientKohanaDb::__construct
     */
    public function testConstructor() {

        $clientKohanaDb = new ClientKohanaDb(new Database());
        $this->assertInstanceOf('\YPFlatStorage\IClient', $clientKohanaDb);

    }

    /**
     *  @covers \YPFlatStorage\ClientKohanaDb::fetchOne
     */
    public function testFetchOne(){

        // prepare input and expected
        $inputDomain = 'domain';
        $inputFields = array('f1' => 'v1');
        $expectedOperation = Database::SELECT;
        $expectedSql = "SELECT * FROM `domain` WHERE f1 = 'v1' LIMIT 1";

        // prepare mock object with condition
        $dbMock = $this->getDbMockWithQueryAndAsArrayMethods($expectedOperation, $expectedSql, null);

        // execute code
        $clientKohanaDb = new ClientKohanaDb($dbMock);
        $result = $clientKohanaDb->fetchOne($inputDomain, $inputFields);

        $this->assertInstanceOf('YPFlatStorage\Slot', $result);
    }

    /**
     *  @covers \YPFlatStorage\ClientKohanaDb::insert
     */
    public function testInsert(){

        // prepare input and expected
        $inputDomain = 'domain';
        $inputFields = array('f1' => 'v1');
        $expectedOperation = Database::INSERT;
        $expectedSql = "INSERT INTO `domain` (f1) VALUES ('v1')";

        // prepare mock object with condition
        $dbMock = $this->getDbMockWithQueryAndAsArrayMethods($expectedOperation, $expectedSql);

        // execute code
        $clientKohanaDb = new ClientKohanaDb($dbMock);
        $clientKohanaDb->insert($inputDomain, $inputFields);
    }

    /**
     *  @covers \YPFlatStorage\ClientKohanaDb::upsert
     */
    public function testUpsert(){
        $this->clientKohanaDb->upsert('domain', array('f1' => 'v1'), array('f2' => 'v2'));
    }

    /**
     *  @covers \YPFlatStorage\ClientKohanaDb::update
     */
    public function testUpdate(){
        // prepare input and expected
        $inputDomain = 'domain';
        $inputCriteria = array('f2' => 'v2', 'f3' => 'v3');
        $inputFields = array('f1' => 'v1', 'f4' => 'v4');
        $expectedOperation = Database::UPDATE;
        $expectedSql = "UPDATE `domain` SET f1 = 'v1', f4 = 'v4' WHERE f2 = 'v2' AND f3 = 'v3'";

        // prepare mock object with condition
        $dbMock = $this->getDbMockWithQueryAndAsArrayMethods($expectedOperation, $expectedSql);

        // execute code
        $clientKohanaDb = new ClientKohanaDb($dbMock);
        $clientKohanaDb->update($inputDomain, $inputCriteria, $inputFields);
    }

    /**
     * @param $expectedOperation
     * @param $expectedSql
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getDbMockWithQueryAndAsArrayMethods($expectedOperation, $expectedSql)
    {
        $dbMock = $this->getMockBuilder('Database')
            ->setMethods(array('query', 'as_array'))
            ->getMock();
        $dbMock->expects($this->once())
            ->method('query')
            ->with($this->equalTo($expectedOperation), $this->equalTo($expectedSql))
            ->willReturnSelf();
        $dbMock->expects($this->any())
            ->method('as_array')
            ->will($this->returnValue(array(array('f1' => 'v1', 'f2' => 'v2'))));
        return $dbMock;
    }

}