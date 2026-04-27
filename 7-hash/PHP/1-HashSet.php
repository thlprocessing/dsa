<?php


/**
 * https://leetcode.com/problems/design-hashset/
 * 
 * Time complexity: O(n)
 * Space complexity: O(n)
 * 
 * Constraints:
 * 0 <= key <= 106
 * At most 104 calls will be made to add, remove, and contains.
 */

class HashSet {

    public $hashTable;

    public function __construct(int $capacity = 10000) {
        $this->hashTable = array_fill(0, $capacity, []);
    }

    public function getHashCode($key) {

        # Time Exceeded Limit
        # Even with a larger capacity, if there are duplicate keys, the bucket chain grows and contains()/remove() become slow.
        # Since this is a multiset and we allow duplicates, the bucket can have many entries for the same key. 
        # The linear scan through nulled-out entries makes it O(n) per operation.
        
        return $key % count($this->hashTable);
    }

    public function add($key) {

        $hashCode = $this->getHashCode($key);
        
        # on collision -> update value
        foreach($this->hashTable[$hashCode] as $index => $bucket) {
            # set to new value for same key
            if(isset($bucket[0]) && $key == $bucket[0]) {
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
            if(isset($bucket[0]) && $key == $bucket[0]) {    
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