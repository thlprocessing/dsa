<?php

/**
 * https://leetcode.com/problems/sort-characters-by-frequency/
 * 
 */


class SortCharacterByFrequency {

    public $quickSort;

    public function __construct() 
    {
        $this->quickSort = new QuickSort($asc = false);
    }

    /**
     * @param String $s
     * @return String
     */
    function frequencySort($s) {

        // Use your QuickSort which is initialized with $asc = false (descending)
        
        // 1. Get frequency count (returns ASCII value => frequency)
        $stringToArray = str_split($s);
        $charToASCIIValueArray = $this->chartToASCIIValueArray($stringToArray);
        
        $mapCounting = $this->frequencyMapCounting($charToASCIIValueArray);
        
        // 2. Sort the array in descending order while maintaining index association
        $this->quickSort->sortArray($mapCounting);
        
        // 3. Reconstruct the string
        return $this->ASCIIValueToString($mapCounting);
        
    }


    public function frequencyMapCounting($array)
    {
        $mapCounting = [];
        $arrLength   = count($array);
        for($i = 0; $i < $arrLength; $i++) {
            $mapCounting[$array[$i]] = !isset($mapCounting[$array[$i]]) ? 1 : ($mapCounting[$array[$i]] + 1);
        }
        
        return $mapCounting;
    }

    /**
     * 
     * @param [type] $s 
     * @return array
     */
    public function chartToASCIIValueArray($stringArray) {

        $charToASCIIValueArray = [] ;

        for($i = 0 ; $i < count($stringArray) ; $i++) {
            //echo "i: $i | value: " . $stringArray[$i] . " ord(stringArray[i]: " . ord($stringArray[$i]) . "\n";
            $charToASCIIValueArray[] = ord($stringArray[$i]);
        }

        return $charToASCIIValueArray;
    }

    public function ASCIIValueToCharArray($stringArray) {

        $ASCIIValueToCharArray = [] ;

        for($i = 0 ; $i < count($stringArray) ; $i++) {
            //echo "i: $i | value: " . $stringArray[$i]  .  " | chr(stringArray[i]: " . chr($stringArray[$i]) . "\n";
            $ASCIIValueToCharArray[] = chr($stringArray[$i]);
        }

        return $ASCIIValueToCharArray;
    }

    public function ASCIIValueToString($asciiArray) {

        $ASCIIValueToString = "" ;
        foreach($asciiArray as $asciiKey => $counting) {
            for($i = 0 ; $i < $counting ; $i++) {
                $ASCIIValueToString .= chr($asciiKey);
            }
        }
        
        return $ASCIIValueToString;
    }
}


class QuickSort {

    public $asc = true;

    public function __construct($asc = true) {
        $this->asc = $asc;
    }

    public function setAsc($asc)
    {
        $this->asc = $asc;
    }

    public function sortArray(&$numbs)
    {
        if (empty($numbs)) {
            return;
        }

        // To maintain index association, sort an array of keys
        $keys = array_keys($numbs);
        $n = count($keys) - 1;
        
        // Pass both keys and the original associative array to compare values
        $this->quickSort($keys, $numbs, 0, $n);

        // Rebuild the array using the newly sorted keys to maintain index association
        $sortedArray = [];
        foreach ($keys as $key) {
            $sortedArray[$key] = $numbs[$key];
        }
        
        $numbs = $sortedArray;
    }

    /**
     * @param array $keys
     * @param array $numbs
     * @param Integer $start
     * @param Integer $end
     */
    function quickSort(&$keys, &$numbs, $start, $end)
    {

        if ($start >= $end) {
            return;
        }

        $randomPivotK = rand($start, $end);
        // Get the pivot value from the original array using the pivot key
        $randomPivotValueK = $numbs[$keys[$randomPivotK]];
     
        $currentLeft = $start;

        # push all elements < pivot_k to the left -> then sort them  [start, latest_current_left]
        for($i = $start; $i <= $end; $i++) {
            
            // Compare the value of the current key
            $currentValue = $numbs[$keys[$i]];

            if($this->asc && ($currentValue < $randomPivotValueK)) {

                $this->swap($keys, $currentLeft, $i);                
                $currentLeft++;

            } else if(!$this->asc && ($currentValue > $randomPivotValueK)) {

                $this->swap($keys, $currentLeft, $i);                
                $currentLeft++;
            }
        }


        # push all elements > pivot_k to the right -> then sort them [latest_current_right, end]
        $currentRight = $end;
        for($j = $end; $j >= $start; $j--) {
            
            $currentValue = $numbs[$keys[$j]];

            if($this->asc && ($currentValue > $randomPivotValueK)) {

                $this->swap($keys, $currentRight, $j);
                $currentRight--;


            } else if(!$this->asc && ($currentValue < $randomPivotValueK)) { 
                
                $this->swap($keys, $currentRight, $j);
                $currentRight--;

            }
        }

        
        # starting quicksort from start to latest_current_left sorted
        $this->quickSort($keys, $numbs, $start, $currentLeft - 1);    # rollback one for lastest while exit        
        # starting quicksort from latest_current_right sorted to the end
        $this->quickSort($keys, $numbs, $currentRight + 1, $end);
    }

    public function swap(&$keys, $i, $j)
    {
        $temp = $keys[$i];
        $keys[$i] = $keys[$j];
        $keys[$j] = $temp;
    }
}


$solution = new QuickSort($asc = true);

/**
 * Input: nums = [-1,0,3,5,9,12], target = 9
 * Output: 4
 * Explanation: 9 exists in nums and its index is 4
 */

echo "Quick Sort \n";
//$numbs = [5,2,3,1];
$numbs = [30, 80, 10, 90, 70, 50, 40];
echo "before sort: " . implode(",", $numbs) . "\n";
$solution->sortArray($numbs);
echo "after sort: " . implode(",", $numbs) . "\n";

$sortCharacterByFrequency = new SortCharacterByFrequency();
echo $sortCharacterByFrequency->frequencySort("tree") . "\n";

echo $sortCharacterByFrequency->frequencySort("cccaaa") . "\n";

echo $sortCharacterByFrequency->frequencySort("Aabb") . "\n";
