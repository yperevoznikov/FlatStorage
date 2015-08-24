<?php

namespace YPStorageEngine;

/**
 * Interface for storage adapters
 *
 * Interface IClient
 * @package YPStorageEngine
 */
interface IClient {

    /**
     * @param $domain Table name or file name or other domain are where to look for data
     * @param $criteria
     * @return mixed
     */
    public function fetchOne($domain, $criteria);

    /**
     * @param $domain Table name or file name or other domain are where to save
     * @param $criteria
     * @param $fields
     * @return mixed
     */
    public function update($domain, $criteria, $fields);

    /**
     * @param $domain Table name or file name or other domain are where to look for and update data
     * @param $fields
     * @return mixed
     */
    public function insert($domain, $fields);

    /**
     * @param $domain Table name or file name or other domain are where to insert data
     * @param $criteria
     * @param $fields
     * @return mixed
     */
    public function upsert($domain, $criteria, $fields);

}