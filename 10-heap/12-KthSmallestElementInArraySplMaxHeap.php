<?php


class KthSmallestElementInArraySplMaxHeap extends SplMaxHeap {

    /**
     * @param Integer[] $nums
     * @param Integer $k
     * @return Integer
     */
    function findKthLargest($nums, $k) {
        
        foreach($nums as $num) { 

            $this->insert($num);
                
            
            # similar sliding window 2 and extract smallest element out of the heap    
            if($this->count() > $k) {
                $this->extract();
            }
        }

        return $this->top();

    }
}


$solution = new KthSmallestElementInArraySplMaxHeap();
echo $solution->findKthLargest([3,2,1,5,6,4], 2) . "\n";    #