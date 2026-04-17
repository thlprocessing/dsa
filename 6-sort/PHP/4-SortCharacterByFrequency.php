<?php

/**
 * https://leetcode.com/problems/sort-characters-by-frequency/
 * 
 */


class SortCharacterByFrequency {

    public $quickShort;

    public function __construct() 
    {
        $this->quickShort = new QuickSort($asc = true);
    }

    /**
     * @param String $s
     * @return String
     */
    function frequencySort($s) {

        $stringToArray = str_split($s);

        $charToASCIIValueArray = $this->chartToASCIIValueArray($stringToArray);
        
        
        //$mapCounting = $this->frequencyMapCounting($charToASCIIValueArray);
        
        echo "before sort: " . implode(",", $charToASCIIValueArray) . "\n";
        $this->quickShort->sortArray($charToASCIIValueArray);

        
        echo "after sort: " . implode(",", $charToASCIIValueArray) . "\n";
        //$unMapCounting = $this->frequencyUnMapCounting($mapCounting);

        return $this->ASCIIValueToString($charToASCIIValueArray);
    }

    public function frequencyMapCounting($array)
    {
        $mapCounting = [];
        $arrLength   = count($array);
        for($i = 0; $i < $arrLength; $i++) {
            $mapCounting[$array[$i]] = !isset($mapCounting[$array[$i]]) ? 1 : ($mapCounting[$array[$i]] + 1);
        }
        echo "map counting:  \n";
        var_dump($mapCounting);
        
        return $mapCounting;
    }

    public function frequencyUnMapCounting($mapCounting)
    {
        $unMapCounting = [];

        // foreach($mapCounting as $index => $key) {
        //     for($counting = 0; $counting < $array[0]; $counting++) {
        //         $unMapCounting[] = $array[1];
        //     }
        // }            
        
        // echo "unMapCounting:  \n";
        // var_dump($unMapCounting);
        return $unMapCounting;
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

    public function ASCIIValueToString($stringArray) {

        $ASCIIValueToCharArray = "" ;

        for($i = 0 ; $i < count($stringArray) ; $i++) {
            //echo "i: $i | value: " . $stringArray[$i]  .  " | chr(stringArray[i]: " . chr($stringArray[$i]) . "\n";
            $ASCIIValueToCharArray .= chr($stringArray[$i]);
        }

        return $ASCIIValueToCharArray;
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
        $n = count($numbs) - 1;
        $this->quickShort($numbs, 0, $n);
    }

    /**
     * @param Integer[] $numbs
     * @param Integer $target
     * @return Integer
     */
    function quickShort(&$numbs, $start, $end)
    {

        if ($start >= $end) {
            return;
        }

        $randomPivotK = rand($start, $end);
        $randomPivotValueK = $numbs[$randomPivotK];

     
        $currentLeft = $start;

        # push all elements < pivot_k to the left -> then sort them  [start, latest_current_left]
        for($i = $start; $i <= $end; $i++) {

            if($this->asc && ($numbs[$i] < $randomPivotValueK)) {

                $this->swap($numbs, $currentLeft, $i);                
                $currentLeft++;

            } else if(!$this->asc && ($numbs[$i] > $randomPivotValueK)) {

                $this->swap($numbs, $currentLeft, $i);                
                $currentLeft++;
            }
        }


        # push all elements > pivot_k to the right -> then sort them [latest_current_right, end]
        $currentRight = $end;
        for($j = $end; $j >= $start; $j--) {
            if($this->asc && ($numbs[$j] > $randomPivotValueK)) {

                $this->swap($numbs, $currentRight, $j);
                $currentRight--;


            } else if(!$this->asc && ($numbs[$j] < $randomPivotValueK)) { 
                
                $this->swap($numbs, $currentRight, $j);
                $currentRight--;

            }
        }

        
        # starting quicksort from start to latest_current_left sorted
        $this->quickShort($numbs, $start, $currentLeft - 1);    # rollback one for lastest while exit        
        # starting quicksort from latest_current_right sorted to the end
        $this->quickShort($numbs, $currentRight + 1, $end);
    }

    public function swap(&$numbs, $i, $j)
    {
        $temp = $numbs[$i];
        $numbs[$i] = $numbs[$j];
        $numbs[$j] = $temp;
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


