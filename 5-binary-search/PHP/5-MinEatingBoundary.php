<?php

/**
 * https://leetcode.com/problems/koko-eating-bananas/description/
 * Work in progress
 */

class MinEatingBoundary {

    
    public $binarySearch;

    function __construct()
    {
        $this->binarySearch = new BinarySearch();
    }

    /**
     * @param Integer[] $obstacles
     * @return Integer[]
     */
    function minEatingSpeed($piles, $h) {

        $arrLength  = count($piles); 
        $low        = 1;
        $high       = 0;

        for($i = 0; $i < $arrLength; $i++) {
            if($piles[$i] > $high) {
                $high = $piles[$i];
            }
        }
        
        while($low < $high) {

            $mid = floor($low + ($high - $low) / 2);

            $totalHour = 0;

            for($i = 0; $i < $arrLength; $i++) {
                $totalHour += ceil($piles[$i] / $mid);
            }   

            if($totalHour <= $h) {      # max_boundary works(eating_fast) => reduced max_boundary
                $high = $mid;           
            } else {
                $low  = $mid + 1;       # min_boundary works(eating_slow) => increase min_boundary
            }
        }
        
        return $low;

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

$solution = new MinEatingBoundary();


echo $solution->minEatingSpeed([3,6,7,11], 8)       . "\n";      # Output: 4
echo $solution->minEatingSpeed([30,11,23,4,20], 5)  . "\n";      # Output: 30
echo $solution->minEatingSpeed([30,11,23,4,20], 6)  . "\n";      # Output: 23
