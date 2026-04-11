<?php

/**
 * https://leetcode.com/problems/binary-search/
 */

class BinarySearch {

    /**
     * @param Integer[] $numbs
     * @param Integer $target
     * @return Integer
     */
    function search($numbs, $target) {

        # initialize 2 pointers: low, high
        $low = 0;
        $high = count($numbs) - 1;


        # Iterate and Compare
        while ($low <= $high) {

            # Recalculate $mid for each new boundary
            $mid = floor($low + ($high - $low) / 2);        # Round down: 0.99 ~ 0.00

            # Divide
            if (isset($numbs[$mid]) && $numbs[$mid] == $target) {
                return $mid;        # found => return mid
            } else if (isset($numbs[$mid]) && $target < $numbs[$mid]) {
                $high = $mid -1;            # search the left half => discard Half Right (high = mid - 1)
            } else {
                $low = $mid + 1;            # search the right half => discard Half Left (low = mid + 1)
            }
        }

        # target is not in array
        return -1;
    }

    public function lowerBound($numbs, $target) {

        # initialize 2 pointers: low, high
        $low = 0;
        $high = count($numbs) - 1;
        $leftMost = count($numbs);

        # Iterate and Compare
        while ($low <= $high) {

            # Recalculate $mid for each new boundary
            $mid = floor($low + ($high - $low) / 2);        # Round down: 0.99 ~ 0.00

            # Divide
            if (isset($numbs[$mid]) && $target <= $numbs[$mid]) {
                $leftMost = $mid;
                $high = $mid -1;            # search the left half => discard Half Right (high = mid - 1)
            } else {
                $low = $mid + 1;            # search the right half => discard Half Left (low = mid + 1)
            }
        }

        return $leftMost;
    }


    public function upperBound($numbs, $target) {

        # initialize 2 pointers: low, high
        $low = 0;
        $high = count($numbs) - 1;
        $rightMost = count($numbs);

        # Iterate and Compare
        while ($low <= $high) {

            # Recalculate $mid for each new boundary
            $mid = (int)($low + ($high - $low) / 2);        # Round down: 0.99 ~ 0.00

            # Divide
            if (isset($numbs[$mid]) && $target < $numbs[$mid]) {
                $rightMost = $mid;
                $high = $mid -1;            # search the left half => discard Half Right (high = mid - 1)
            } else {
                $low = $mid + 1;            # search the right half => discard Half Left (low = mid + 1)
            }
        }

        return $rightMost;
    }
}


$solution = new BinarySearch();

/**
 * Input: nums = [-1,0,3,5,9,12], target = 9
 * Output: 4
 * Explanation: 9 exists in nums and its index is 4
 */

echo "Binary Search \n";
echo $solution->search([-1,0,3,5,9,12], 9) . "\n";

/**
 * Input: nums = [-1,0,3,5,9,12], target = 2
 * Output: -1
 * Explanation: 2 does not exist in nums so return -1
 */
echo $solution->search([-1,0,3,5,9,12], 2) . "\n";

echo "LowerBound: Left-Boundary \n";
echo $solution->lowerBound([1, 2, 4, 4, 7], 4) . "\n";      # Output: 2
echo $solution->lowerBound([1, 2, 4, 4, 7], 3) . "\n";      # Output: 2
echo $solution->lowerBound([1, 2, 4, 4, 7], 0) . "\n";      # Output: 0
echo $solution->lowerBound([1, 2, 4, 4, 7], 8) . "\n";      # Output: 5

echo "UpperBound: Right-Boundary \n";
echo $solution->upperBound([1, 2, 4, 4, 7], 4) . "\n";      # Output: 4
echo $solution->upperBound([1, 2, 4, 4, 7], 3) . "\n";      # Output: 2
echo $solution->upperBound([1, 2, 4, 4, 7], 0) . "\n";      # Output: 0
echo $solution->upperBound([1, 2, 4, 4, 7], 8) . "\n";      # Output: 5

$data  = [0, 1, 1, 0, 0, 1, 0];
$index =  $solution->upperBound([0, 5, 10, 15, 20, 25, 30], 12) . "\n";
echo $index;
echo $data[(int)($index -1)] . "\n";