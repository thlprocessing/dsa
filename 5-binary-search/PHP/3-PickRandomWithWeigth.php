<?php


/**
 * Data you have: You have n boxes, say box 1, box 2,...box n. Each box has some weight, say weightOfBox1, weightOfBox2...weightOfBoxN.
 * Problem: Pick a box
 * Condition: How often a box should be picked from the rest (ie, probability) must be proportional to its weight compared to others.
 * Hint: Apply randomization to weights, by ranging randomization from nothing (0) to all weights (sum of all weights).
 */

/**
 * Given an array w of positive integers, where w[i] describe the weigth of index i, write a function pickIndex() which randomly pick an index in proportion with it weigth
 * 
 */

class PickRandomWithWeigth {

    public $weightedArray;

    public $totalSum = 0;

    public $prefixSumArr = [];

    /**
     * @param Integer[] $w
     */
    function __construct($w) {

        $this->weightedArray = $w;

        /**
         * The main problem is here in inside pickIndex() would rebuild the whole prefix sum array every time
         */
        $arrLength      = count($this->weightedArray);
        
        for($i = 0; $i < $arrLength; $i++) {
            $this->totalSum     += ($this->weightedArray[$i] ?? 0); 
            $this->prefixSumArr[$i]   = ($this->weightedArray[$i] ?? 0) + ($this->prefixSumArr[$i -1] ?? 0); 
        }

        echo implode(",", $this->prefixSumArr) . "\n";

    }
  
    /**
     * @return Integer
     */
    function pickIndex() {
        
        
        $randInt = rand(1, $this->totalSum);

        $binarySearch = new BinarySearch();
        $pIndex =  $binarySearch->lowerBound($this->prefixSumArr, $randInt);

        echo "randInt $randInt pIndex $pIndex \n";

        return $pIndex;
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
            $mid = floor($low + ($high - $low) / 2);        # Round down: 0.99 ~ 0.00

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


$solution = new PickRandomWithWeigth([1,3]);

echo $solution->pickIndex() . "\n";     # Output: 1
echo $solution->pickIndex() . "\n";     # Output: 1
echo $solution->pickIndex() . "\n";     # Output: 1
echo $solution->pickIndex() . "\n";     # Output: 0
echo $solution->pickIndex() . "\n";     # Output: 1

