<?php

namespace YStorageEngine;

class ClientBlackhole implements IClient {
	
	public function __construct() {

	}

    public function fetchOne($criteria)
    {
        return null;
    }

}