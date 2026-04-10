<?php

class QuichkSort {

    public function sortArray($numbs) 
    {
        $n = count($numbs);
        echo $n;
        $this->quickShort($numbs, 0, $n - 1);
    }

    /**
     * @param Integer[] $numbs
     * @param Integer $target
     * @return Integer
     */
    function quickShort($numbs, $start, $end)
    {

        echo "$start $end \n";
        $randomIndex = floor(($end - $start) / 2);
        $randomValue = $numbs[$randomIndex];

        $currentLeft = $start;
        for($i = $start; $i <= $end; $i++) {
            if($numbs[$i] <= $randomValue) {
                $this->swap($numbs, $currentLeft, $i);
            }
        }

        $currentRight = $end;
        for($j = $end; $j >= $start; $j--) {
            if($numbs[$j] > $randomValue) {
                $this->swap($numbs, $currentRight, $j);
            }
        }

        $this->quickShort($numbs, $start, $currentLeft - 1);
        $this->quickShort($numbs, $currentRight + 1, $end);
    }

    public function swap($numbs, $i, $j)
    {
        $temp = $numbs[$i];
        $numbs[$i] = $numbs[$j];
        $numbs[$j] = $temp;
    }
}



$solution = new QuichkSort();

/**
 * Input: nums = [-1,0,3,5,9,12], target = 9
 * Output: 4
 * Explanation: 9 exists in nums and its index is 4
 */

echo "Quick Sort \n";
$numbs = [5,2,3,1];
$solution->sortArray($numbs);

print_r($numbs);