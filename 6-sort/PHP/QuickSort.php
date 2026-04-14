<?php

class QuickSort {

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

        echo "start >= end : $start >= $end arrayLength " . (count($numbs)) . "\n";

        if ($start >= $end) {
            return;
        }

        $randomPivotK = rand($start, $end);
        $randomPivotValueK = $numbs[$randomPivotK];

        echo "Quick sort: start:  $start | end: $end | randomPivotK $randomPivotK randomPivotValueK $randomPivotValueK \n";

        $currentLeft = $start;

        # push all elements < pivot_k to the left -> then sort them  [start, latest_current_left]
        for($i = $start; $i <= $end; $i++) {
            if($numbs[$i] < $randomPivotValueK) {

                $numbI = $numbs[$i];
                echo  "currentLeft: $currentLeft | numbI: $numbI  | randomPivotValueK: $randomPivotValueK \n";

                $this->swap($numbs, $currentLeft, $i);
                
                echo "currentLeft: " . implode(",", $numbs) . "\n";
                $currentLeft++;
            }
        }


        # push all elements > pivot_k to the right -> then sort them [latest_current_right, end]
        $currentRight = $end;
        for($j = $end; $j >= $start; $j--) {
            if($numbs[$j] > $randomPivotValueK) {

                $numbJ = $numbs[$j];
                echo  "currentRight: $currentRight | numbJ: $numbJ  | randomPivotValueK: $randomPivotValueK \n";

                $this->swap($numbs, $currentRight, $j);
            
                echo "currentRight: " . implode(",", $numbs) . "\n";

                $currentRight--;
            }
        }

        echo "start $start randomPivotK $randomPivotK | currentLeft - 1: " . ($currentLeft - 1) . " \n";
        # starting quicksort from start to latest_current_left sorted
        $this->quickShort($numbs, $start, $currentLeft - 1);    # rollback one for lastest while exit
        echo "end $end randomPivotK $randomPivotK| currentRight + 1 " . $currentRight + 1 . "\n"; # forwardback one for lastest while exit
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



$solution = new QuickSort();

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