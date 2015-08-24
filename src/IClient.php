<?php

namespace YStorageEngine;

interface IClient {

    public function fetchOne($criteria);

    public function update($criteria, $fields);

}