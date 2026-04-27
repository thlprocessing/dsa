<?php

/**
 * Input
 * ["RandomizedSet","insert","remove","insert","getRandom","remove","insert","getRandom"]
 * [[],[1],[2],[2],[],[1],[2],[]]
 * Expected
 * [null,true,false,true,1,true,false,2]
 * RandomizedSet randomizedSet = new RandomizedSet();
 * randomizedSet.insert(1); // Inserts 1 to the set. Returns true as 1 was inserted successfully.
 * randomizedSet.remove(2); // Returns false as 2 does not exist in the set.
 * randomizedSet.insert(2); // Inserts 2 to the set, returns true. Set now contains [1,2].
 * randomizedSet.getRandom(); // getRandom() should return either 1 or 2 randomly.
 * randomizedSet.remove(1); // Removes 1 from the set, returns true. Set now contains [2].
 * randomizedSet.insert(2); // 2 was already in the set, so return false.
 * randomizedSet.getRandom(); // Since 2 is the only number in the set, getRandom() will always return 2.
 * 
 * RandomizedSet [[]]   null
 * insert        [[1]]  true
 * remove        [[2]]  false
 */


class RandomizedSet {
  

    public $hashTable;

    public $vals = [];   # dense values — for O(1) getRandom

    public function __construct(int $capacity = 100010 * 2) {
        $this->hashTable = array_fill(0, $capacity, null);
    }

    public function hash1($key)
    {
         return  $key % count($this->hashTable);
    }

    public function hash2($key)
    {        
        $R = 9593;
        return  $R - ($key % $R);
    }

    public function getHashCode($key)
    {
        $hashCode  = null;

        $hashCode1 = $this->hash1($key);
        $hashCode  = $hashCode1;
        
        # if already existing
        if($this->hashTable[$hashCode]) {
            $i = 0; 
            $hashCode2 = $this->hash2($key);

            # until not existing
            while(!$this->hashTable[$hashCode]) {
                
                $hashCode = ($hashCode1 + ($i) * $hashCode2);
                $i++;
            }
        }

        return $hashCode;
    }

    public function insert($key) {

        $hashCode = $this->getHashCode($key);
        
        /*
        # on collision -> update value
        foreach($this->hashTable[$hashCode] as $index => $bucket) {
            # set to new value for same key
            if(isset($bucket[0]) && $key == $bucket[0]) {
                $this->hashTable[$hashCode][$index] = [$key];
                return;
            }
        }
        */

        # if 
        if($this->hashTable[$hashCode]) {
           return false;
        }
        
        $this->hashTable[$hashCode] = [$key];
        $this->vals[] = $key;  // keep $vals in sync
        return true;
        
    }

    public function contains($key)
    {

        $hashCode = $this->getHashCode($key);

        /* No separate chaining for collision
        foreach($this->hashTable[$hashCode] as $index => $bucket) {
            if(isset($bucket[0]) && $key == $bucket[0]) {    
                return true;
            }
        }
        */

        return false;
    }

    public function remove($key)
    {
        $hashCode = $this->getHashCode($key);

        /* No separate chaining for collision
        foreach($this->hashTable[$hashCode] as $index => $bucket) {
            if($key == $bucket[0]) {
                $this->hashTable[$hashCode][$index] = null;         
            }
        }
        */

        # if not existing, return false
        if(!$this->hashTable[$hashCode]) {
            return false;
        }
        
        # removed, return false
        $this->hashTable[$hashCode] = null;

        # maintain dense values — for O(1) getRandom 
        $keyIndex   = array_search($key, $this->vals);
        $this->vals[$keyIndex] = $this->vals[0];
        array_shift($this->vals);

        return true;

    }

  
    /**
     * @return Integer
     */
    function getRandom() {
        return $this->vals[random_int(0, count($this->vals) - 1)];
    }
}