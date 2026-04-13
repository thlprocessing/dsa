<?php

/**
 * https://leetcode.com/problems/find-the-longest-valid-obstacle-course-at-each-position/
 * Work in progress
 */

class LongestIncreasingSubsequence {

    public $longestInscreasingSubsequence;
    public $ans;
    public $binarySearch;

    function __construct()
    {
        $this->binarySearch = new BinarySearch();
    }

    /**
     * @param Integer[] $obstacles
     * @return Integer[]
     */
    function longestObstacleCourseAtEachPosition($obstacles) {

        $arrLength = count($obstacles);
        
        $longestInscreasingSubsequence = [];
        $ans          = [];
    
        for($i = 0; $i < $arrLength; $i++) {
            
            
                $rightBound = $this->binarySearch->upperBound($longestInscreasingSubsequence, $obstacles[$i]);

                if($rightBound == count($longestInscreasingSubsequence)) {
                    $longestInscreasingSubsequence[] = $obstacles[$i];
                }
                else {
                    $longestInscreasingSubsequence[$rightBound] = $obstacles[$i];
                }

                $ans[] = $rightBound + 1;
            
        }

        return $ans;
    }
}


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

$solution = new LongestIncreasingSubsequence();


echo implode(",", $solution->longestObstacleCourseAtEachPosition([1,2,3,2])) . "\n";      # Output: 4
echo implode(",", $solution->longestObstacleCourseAtEachPosition([2,2,1])) . "\n";      # Output: 2
echo implode(",", $solution->longestObstacleCourseAtEachPosition([3,1,5,6,4,2])) . "\n";      # Output: 0
