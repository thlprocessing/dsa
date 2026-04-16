<?php 

/**
 * Merge sorted Two Arrays
 * https://leetcode.com/problems/merge-sorted-array/description/
 */
class MergeShortedTwoArrays {

    /**
     * 
     */
    public $mergeSort;

    /**
     * 
     */
    public function __construct()
    {
        $this->mergeShort = new MergeShort();
    }

    /**
     * @param Integer[] $nums1
     * @param Integer $m
     * @param Integer[] $nums2
     * @param Integer $n
     * @return NULL
     */
    function merge(&$nums1, $m, $nums2, $n) {

        // clone subarray nums1 [0, m] and subarray nums2 [0,n]
        $nums1Length = count($nums1);

        $j = 0;

        for($i = 0; $i < $nums1Length; $i++) {
            //echo "i: $i| m: $m| j: $j \n";
            if(($i >= $m) && isset($nums2[$j])) {
                $nums1[$i] = $nums2[$j++];
            } else if (($i >= $m) && !isset($nums2[$j])) {
                unset($nums1[$i]);
            }
        }

        $nums1 = $this->mergeShort->mergeShort($nums1);
    }


}

class MergeShort
{

    function mergeShort($numbs)
    {
        return $this->mergeShortRecv($numbs);
    }   


    function mergeShortRecv($numbs)
    {

        $low = 0;
        $high = count($numbs) - 1;
        
        if(count($numbs) == 1) {
            return $numbs;
        }

        if(count($numbs) == 0) {
            exit;
        }

        $mid = ceil($high / 2);

        // slice left
        $lowSliceArray = [];
        for($i = 0; $i < $mid; $i++) {
            $lowSliceArray[$i] = $numbs[$i];
        }

        // slice right
        $highSliceArray = [];
        for($j = $mid, $index = 0; $j <= $high; $j++, $index++) {
            $highSliceArray[$index] = $numbs[$j];
        }


        $lowArr  = $this->mergeShortRecv($lowSliceArray);
        $highArr = $this->mergeShortRecv($highSliceArray);
    
        $mergedArraySorted = $this->mergeShortTwoArray($lowArr, $highArr);
        

        return $mergedArraySorted;
    }


    public function mergeShortTwoArray($left, $right)
    {
        $i = 0; $j = 0; $count = 0;
        $leftLength = count($left);
        $rightLength = count($right);
        $numbs = [];
        while($i < $leftLength && $j < $rightLength) {
            
            $leftI = $left[$i];
            $rightJ = $right[$j];
            
            if($left[$i] < $right[$j]) {
                $numbs[$count++] = $left[$i++];
            } else {
                $numbs[$count++] = $right[$j++];
            }
        }

        // When we exit the first while loop, one array is exhausted
        // The remaining elements are already sorted AND are all larger than what's already been placed
        //echo "i < leftLength : $i < $leftLength \n";

        // either left or right is exhausted => the Copy remaining elements from left (if any)
        // Case 1 (left exhausted): All elements in right are ≥ the last element taken from right (due to sorting), and that last element was ≥ the last element taken from left (due to merge logic). Therefore, all remaining right elements ≥ everything already placed.
        while($i < $leftLength) {
            $numbs[$count++] = $left[$i++];    
        }

        //echo "j < rightLength : $j < $rightLength \n";
        // either left or right is exhausted => the Copy remaining elements from right (if any)
        // Case 2 (right exhausted): Similarly, all remaining left elements ≥ everything already placed.
        
        while($j < $rightLength) {
            $numbs[$count++] = $right[$j++];    
        }

        return $numbs;
    }
}

$solution = new MergeShortedArray();

/**
 * Input: nums = [-1,0,3,5,9,12], target = 9
 * Output: 4
 * Explanation: 9 exists in nums and its index is 4
 */

echo "Merge Sort \n";
$numbs1 = [1,2,3,0,0,0];
$numbs2 = [2,5,6];
echo "before mergeSort numbs1: " . implode(",", $numbs1) . "\n";
echo "before mergeSort numbs2: " . implode(",", $numbs2) . "\n";

$solution->merge($numbs1, 3, $numbs2, 3);
echo "after mergeSort: " . implode(",", $numbs1) . "\n";


$numbs3 = [1];
$numbs4 = [];
echo "before mergeSort numbs3: " . implode(",", $numbs3) . "\n";
echo "before mergeSort numbs4: " . implode(",", $numbs4) . "\n";

$solution->merge($numbs3, 1, $numbs4, 0);
echo "after mergeSort: " . implode(",", $numbs3) . "\n";


$numbs5 = [0];
$numbs6 = [1];
echo "before mergeSort numbs1: " . implode(",", $numbs5) . "\n";
echo "before mergeSort numbs2: " . implode(",", $numbs6) . "\n";

$solution->merge($numbs1, 0, $numbs5, 1);
echo "after mergeSort: " . implode(",", $numbs6) . "\n";
