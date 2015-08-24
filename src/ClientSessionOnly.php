<?php

namespace YPStorageEngine;

/**
 * This storage client is not efficient and shouldn't be used for production, only for testing purposes
 *
 * Class ClientSessionOnly
 * @package YPStorageEngine
 */
class ClientSessionOnly implements IClient {

    /**
     * @var array
     */
    private $data = array();

    /**
     *
     */
    public function __construct() {

    }

    /**
     * @param Table $domain
     * @param array $fields
     */
    public function insert($domain, $fields)
    {
        $this->upsertDomain($domain);

        $slot = new Slot();
        foreach ($fields as $name => $value) {
            $slot->{$name} = $value;
        }
        $this->data[$domain][] = $slot;
    }

    /**
     * @param Table $domain
     * @param $criteria
     * @param $fields
     */
    public function upsert($domain, $criteria, $fields)
    {
        $slot = $this->fetchOne($domain, $criteria);
        if (isset($slot)) {
            $this->update($domain, $criteria, $fields);
        } else {
            $this->insert($domain, array_merge($criteria, $fields));
        }

    }

    /**
     * @param Table $domain
     * @param $criteria
     * @return null|Cell
     */
    public function fetchOne($domain, $criteria)
    {
        $this->upsertDomain($domain);

        foreach ($this->data[$domain] as $cell) {
            if ($cell->matchCriteria($criteria)) {
                return $cell;
            }
        }

        return null;
    }

    /**
     * @param string $domain table name in terms of SQl
     * @param array $criteria WHERE in terms of SQl
     * @param array $fields SET in terms of SQL
     * @return int How many blocks were updated
     */
    public function update($domain, $criteria, $fields)
    {
        $this->upsertDomain($domain);

        $count = 0;

        foreach ($this->data[$domain] as $cell) {
            if ($cell->matchCriteria($criteria)) {
                $cell->update($fields);
                $count++;
            }
        }

        return $count;
    }

    /**
     * @param $domain
     */
    private function upsertDomain($domain) {
        if (!isset($this->data[$domain])) {
            $this->data[$domain] = array();
        }
    }

}
