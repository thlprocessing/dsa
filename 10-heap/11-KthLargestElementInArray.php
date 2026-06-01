<?php

/**
 * https://leetcode.com/problems/kth-largest-element-in-an-array/
 */

class KthLargestElementInArraySplMinHeap extends SplMinHeap{
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

class KthLargestElementInArraySplMaxHeap extends SplMaxHeap{
    /**
     * @param Integer[] $nums
     * @param Integer $k
     * @return Integer
     */
    function findKthLargest($nums, $k) {
        
        # Convert the nums array into maxHeap
        foreach($nums as $num) { 

            $this->insert($num);
        }
        
        # Remove k-1 elements from the max heap.
        for($i = 0; $i < $k - 1; $i++) {
            $this->extract();
        }
        
        return $this->top();
    }
}

# nums = [3,2,1,5,6,4], k = 2 Output: 5
# 1 2 3 4 5 6

$solution = new KthLargestElementInArraySplMinHeap();
echo $solution->findKthLargest([3,2,1,5,6,4], 2) . "\n";   # 5

# 1 2 3 k = 3 > 2
# 2 3

# 2 3 5 k = 3 > 2
# 3 5

# 3 5 6 k = 3 > 2
# 5 6
# -> top = 5


$solution = new KthLargestElementInArraySplMaxHeap();
echo $solution->findKthLargest([3,2,1,5,6,4], 2) . "\n";
