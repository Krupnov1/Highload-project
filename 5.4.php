<?php

class RedisCacheProvider {

    private $connection = null;

    private function getConnection() {
        if($this->connection === null) {
            $this->connection = new Redis();
            $this->connection->connect('localhost', 6379);
        }
        return $this->connection;
    }

    public function getValueFromCache(string $key) {
    	return $this->getconnection()->rawCommand('GET', unserialize($key));
	}

	public function setValueToCache(string $key, $value, $time = 0) {
    	$this->getconnection()->rawCommand('SET', $key, serialize($value), $time);
	}

	public function delValueFromCache(string $key) {
    	$this->getconnection()->rawCommand('DEL', $key);
	}

	public function clearValueFromCache() {
    	$this->getconnection()->rawCommand('flushDB');
	}  
}