<?php

namespace YStorageEngine;

class ClientBlackhole implements IClient {
	
	public function __construct() {

	}

    public function fetchOne($criteria)
    {
        return null;
    }

    /**
     * @param array $criteria WHERE in terms of SQl
     * @param array $fields SET in terms of SQL
     * @return int How many blocks were updated
     */
    public function update($criteria, $fields)
    {
        return 1;
    }

}
