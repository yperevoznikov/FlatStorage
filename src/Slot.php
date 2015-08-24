<?php

namespace YPStorageEngine;

class Slot {

    private $data = array();

    public function __construct($fields=array()){
        foreach ($fields as $name => $value) {
            $this->data[$name] = $value;
        }
    }

    public function __get($name){
        return isset($this->data[$name]) ? $this->data[$name] : null;
    }

    public function __set($name, $value){
        $this->data[$name] = $value;
    }

    public function matchCriteria($criteria){
        foreach ($criteria as $name => $value) {
            if (!isset($value) && !isset($this->data[$name])) {
                continue;
            }
            if (!isset($this->data[$name]) || $this->data[$name] != $value) {
                return false;
            }
        }
        return true;
    }

    public function update($fields) {
        foreach ($fields as $name => $value) {
            $this->__set($name, $value);
        }
    }

}