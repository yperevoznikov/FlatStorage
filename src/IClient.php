<?php

namespace YPStorageEngine;

interface IClient {

    public function fetchOne($criteria);

    public function update($criteria, $fields);

    public function insert($fields);

    public function upsert($criteria, $fields);

}