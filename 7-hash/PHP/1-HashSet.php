<?php

class HashSet {

    public $hashTable;

    public function __construct(int $capacity = 10000) {
        $this->hashTable = array_fill(0, $capacity, []);
    }

    public function getHashCode($key) {
        return $key % count($this->hashTable);
    }

    public function add($key) {

        $hashCode = $this->getHashCode($key);
        
        # on collision -> update value
        foreach($this->hashTable[$hashCode] as $index => $bucket) {
            # set to new value for same key
            if($key == $bucket[0]) {
                $this->hashTable[$hashCode][$index] = [$key];
                return;
            }
        }

        # otherwise insert
        $this->hashTable[$hashCode][] = [$key];
    }

    public function contains($key)
    {

        $hashCode = $this->getHashCode($key);

        foreach($this->hashTable[$hashCode] as $index => $bucket) {
            if($key == $bucket[0]) {    
                return true;
            }
        }

        return false;
    }

    public function remove($key)
    {
        $hashCode = $this->getHashCode($key);

        foreach($this->hashTable[$hashCode] as $index => $bucket) {
            if($key == $bucket[0]) {
                $this->hashTable[$hashCode][$index] = null;         
            }
        }
    }
}