<?php

class MaxNumbOfKPairSum {

    public function __construct() {

    }

    /**
     * @param Integer[] $nums
     * @param Integer $k
     * @return Integer
     */
    function maxOperations($nums, $k) {
        
        $hashTable  = [];
        $counting   = 0;
        foreach ($nums as $num) {

            $complement = $k - $num;
            
            # 
            if(isset($hashTable[$complement]) && $hashTable[$complement] > 0) {
                
                $counting++;
                $hashTable[$complement]--;
            } else {
                $hashTable[$num] = !isset($hashTable[$num]) ? 1 : ($hashTable[$num] + 1);     
            }
        }

        return $counting;
    }


    function maxOperations2($nums, $k) {
        
        # Time Exceeded Limit
        # Even with a larger capacity, if there are duplicate keys, the bucket chain grows and contains()/remove() become slow.
        # Since this is a multiset and we allow duplicates, the bucket can have many entries for the same key. 
        # The linear scan through nulled-out entries makes it O(n) per operation.
        $hashTable  = new HashSet(count($nums) + 100);
        $counting   = 0;
        foreach ($nums as $num) {

            $complement = $k - $num;
            
            # 
            if($hashTable->contains($complement)) {
                
                $counting++;
                $hashTable->remove($complement);
            } else {
                $hashTable->add($num);
            }
        }

        return $counting;
    }
}


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

        # always insert — duplicates allowed (multiset)
        $this->hashTable[$hashCode][] = [$key];
    }

    public function contains($key)
    {

        $hashCode = $this->getHashCode($key);
        # linear scan O(n) through every entry in the bucket chain
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
        # linear scan O(n) through every entry in the bucket chain
        foreach($this->hashTable[$hashCode] as $index => $bucket) {
            if(isset($bucket[0]) && $key == $bucket[0]) {
                $this->hashTable[$hashCode][$index] = null;
                return; # remove ONE occurrence only and return
            }
        }
    }
}

$data = [1,2,3,4];
$data1 = [3,1,3,4,3];
$solution  = new MaxNumbOfKPairSum();
echo $solution->maxOperations($data, 5) . "\n";  # output: 2
echo $solution->maxOperations($data1, 6) . "\n";  # output: 1

echo $solution->maxOperations2($data, 5) . "\n";  # output: 2
echo $solution->maxOperations2($data1, 6) . "\n";  # output: 1
