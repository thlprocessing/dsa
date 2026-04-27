<?php

/**
 * https://leetcode.com/problems/design-hashmap/description/
 * 
 * Time complexity: O(n)
 * Space complexity: O(n)
 * 
 * Constraints:
 * 0 <= key, value <= 106
 * At most 10^4 calls will be made to put, get, and remove => total calls = rehasing 0.75% capacity
 */


class HashMap {

    public $hashTable;

    public function __construct(int $capacity = 100000) {
        $this->hashTable = array_fill(0, $capacity, []);
    }

    public function getHashCode($key) {

        # Time Exceeded Limit
        # Even with a larger capacity, if there are duplicate keys, the bucket chain grows and contains()/remove() become slow.
        # Since this is a multiset and we allow duplicates, the bucket can have many entries for the same key. 
        # The linear scan through nulled-out entries makes it O(n) per operation.
        return $key % count($this->hashTable);
        
    }

    public function put($key, $value) {

        $hashCode = $this->getHashCode($key);
        
        # on collision -> update value
        foreach($this->hashTable[$hashCode] as $index => $bucket) {
            # set to new value for same key
            if($key == $bucket[0]) {
                $this->hashTable[$hashCode][$index] = [$key, $value];
                return;
            }
        }

        # otherwise insert
        $this->hashTable[$hashCode][] = [$key, $value];
    }

    public function get($key)
    {

        $hashCode = $this->getHashCode($key);

        foreach($this->hashTable[$hashCode] as $index => $bucket) {
            if(isset($bucket[0]) && $key == $bucket[0]) {    
                return $bucket[1];
            }
        }

        return -1;
    }

    public function remove($key)
    {
        $hashCode = $this->getHashCode($key);

        foreach($this->hashTable[$hashCode] as $index => $bucket) {
            if(isset($bucket[0]) && $key == $bucket[0]) {
                unset($this->hashTable[$hashCode][$index]);         
            }
        }
    }
}