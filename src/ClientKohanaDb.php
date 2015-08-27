<?php

namespace YPStorageEngine;

/**
 * This storage client is not efficient and shouldn't be used for production, only for testing purposes
 *
 * Class ClientSessionOnly
 * @package YPStorageEngine
 */
class ClientKohanaDb implements IClient {

    // Query types
    const SELECT =  1;
    const INSERT =  2;
    const UPDATE =  3;
    const DELETE =  4;

    /**
     * @var array
     */
    private $data = array();

    /**
     * @var Database
     */
    private $db = null;

    /**
     *
     */
    public function __construct($database) {
        $this->db = $database;
    }

    /**
     * @param string $domain
     * @param array $fields
     */
    public function insert($table, $fields)
    {
        $names = implode(',', array_keys($fields));

        $valuesArr = array();
        foreach ($fields as $field) {
            $valuesArr[] = "'$field'";
        }
        $values = implode(',', $valuesArr);

        $sql = "INSERT INTO `$table` (" . $names . ") VALUES (" . $values . ")";
        $this->db->query(self::INSERT, $sql);
    }

    /**
     * @param Table $domain
     * @param $criteria
     * @param $fields
     */
    public function upsert($table, $criteria, $fields)
    {
        $slot = $this->fetchOne($table, $criteria);
        if (isset($slot)) {
            $this->update($table, $criteria, $fields);
        } else {
            $this->insert($table, array_merge($criteria, $fields));
        }

    }

    /**
     * @param Table $domain
     * @param $criteria
     * @return null|Cell
     */
    public function fetchOne($table, $criteria)
    {
        $whereStatements = array();
        foreach ($criteria as $name => $field) {
            $whereStatements[] = "$name = '$field'";
        }

        $sql = "SELECT * FROM `$table` WHERE " . implode(' AND ', $whereStatements) . " LIMIT 1";
        $res = $this->db->query(self::SELECT, $sql);

        if (!is_object($res)) {
            return null;
        }
        $resArray = $res->as_array();

        return count($resArray) > 0 ? new Slot($resArray[0]) : null;
    }

    /**
     * @param string $domain table name in terms of SQl
     * @param array $criteria WHERE in terms of SQl
     * @param array $fields SET in terms of SQL
     * @return int How many blocks were updated
     */
    public function update($table, $criteria, $fields)
    {

        $whereStatements = array();
        foreach ($criteria as $name => $field) {
            $whereStatements[] = "$name = '$field'";
        }

        $setStatements = array();
        foreach ($fields as $name => $field) {
            $setStatements[] = "$name = '$field'";
        }

        $sql = "UPDATE `$table` SET " . implode(', ', $setStatements) . " WHERE " . implode(' AND ', $whereStatements);
        $this->db->query(self::UPDATE, $sql);
    }

}
