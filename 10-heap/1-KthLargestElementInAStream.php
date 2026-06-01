<?php

/**
 * https://leetcode.com/problems/kth-largest-element-in-an-array/
 */

class KthLargest extends SplMinHeap{

    public $k;

    /**
     * @param Integer $k
     * @param Integer[] $nums
     */
    function __construct($k, $nums)
    {
        
        $this->k = $k;
        
        foreach($nums as $num) { 

            $this->add($num);

        }
    }

    /**
     * @param Integer $val
     * @return Integer
     */
    function add($val)
    {
        $this->insert($val);
        
        # Restrict the heap size to k
        # the smallest of k-th largest element of heap size k is situated at the top
        if($this->count() > $this->k) {
            $this->extract();
        }

        return $this->top();
    }
}


$kthLargest = new KthLargest(3, [4, 5, 8, 2]);
echo $kthLargest->add(3) . "\n"; // return 4
echo $kthLargest->add(5) . "\n"; // return 5
echo $kthLargest->add(10) . "\n"; // return 5
echo $kthLargest->add(9) . "\n"; // return 8
echo $kthLargest->add(4) . "\n"; // return 8
