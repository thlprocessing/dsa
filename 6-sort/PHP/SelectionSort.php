<?php

class SelectionSort
{

    /**
     * Initialize `current_index` to 0.
     * Iterate through the elements of the array to find the smallest element within the range from `current_index` to the end of the sequence; let's assume this element is located at `min_index`.
     * Swap the two elements at positions `current_index` and `min_index`.
     * Increment `current_index` by 1.
     * Repeat until the sequence is sorted.
     */
    function sortArray($numbs) {

        $current_index = 0;

        for ($i = 0; $i < count($numbs); $i++) {

            $min_index = $current_index;

            for ($j = $min_index + 1; $j < count($numbs); $j++) {

                if ($numbs[$j] < $numbs[$min_index]) {
                    $min_index = $j;
                }
            }

            // swap
            $current_value = $numbs[$current_index];
            $numbs[$current_index] = $numbs[$min_index];
            $numbs[$min_index] = $current_value;

            $current_index++;
        }

        return $numbs;
    }
}


$solution = new SelectionSort();

/**
 * Input: nums = [-1,0,3,5,9,12], target = 9
 * Output: 4
 * Explanation: 9 exists in nums and its index is 4
 */

echo "Selection Search \n";
$sortedResult1 =  $solution->sortArray([5,2,3,1]);

print_r($sortedResult1);


$sortedResult2 =  $solution->sortArray([5,1,1,2,0,0]);

print_r($sortedResult1);
