<?php

namespace YPFlatStorage;

class ClientBlackhole implements IClient {
	
	public function __construct() {

	}

    public function insert($domain, $fields)
    {
        // does nothing since it's blackhole
    }

    public function upsert($domain, $criteria, $fields)
    {
        // does nothing since it's blackhole
    }

    public function fetchOne($domain, $criteria)
    {
        // does nothing since it's blackhole, just saing we found nothing
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
        // does nothing since it's blackhole, just saing we update nothing
        return 0;
    }

}
