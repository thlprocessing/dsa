<?php

class QuickSort {

    public function sortArray(&$numbs)
    {
        $n = count($numbs);
        $this->quickShort($numbs, 0, $n - 1);
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

        $randomIndex = $end;
        $randomValue = $numbs[$randomIndex];

        echo "Quick sort: (s,e,r) $start $end - randomIndex $randomIndex $randomValue \n";

        $currentLeft = $start;

        for($i = $start; $i <= $end; $i++) {
            if($numbs[$i] < $randomValue) {
                $this->swap($numbs, $currentLeft, $i);
                echo  "currentLeft: $currentLeft - i $i  | pivot $randomValue \n";
                echo implode(",", $numbs) . "\n";
                $currentLeft++;
            }
        }



        $currentRight = $end;
        for($j = $end; $j >= $start; $j--) {
            if($numbs[$j] > $randomValue) {
                $this->swap($numbs, $currentRight, $j);
                echo  "currentRight $currentRight - j $j | pivot $randomValue \n";
                echo implode(",", $numbs) . "\n";
                $currentRight--;
            }
        }
        echo "start $start, currentLeft $currentLeft \n";
        $this->quickShort($numbs, $start, $currentLeft - 1);
        echo "currentRight $currentRight, end $end \n";
        $this->quickShort($numbs, $currentRight + 1, $end);

    }

    public function swap(&$numbs, $i, $j)
    {
        $temp = $numbs[$i];
        $numbs[$i] = $numbs[$j];
        $numbs[$j] = $temp;
    }


    function sortArray2(&$arr, $low, $high) {

        // Get the partition index
        $this->quickSort2($arr, $low, $high);

    }

    function quickSort2(&$arr, $low, $high) {

        if ($low < $high) {

            $pivot = $arr[$high];
            $i = $low - 1;

            echo "Quick sort: (s,e,r) $low $high - $high pivot $pivot \n";

            for ($j = $low; $j < $high; $j++) {
                if ($arr[$j] <= $pivot) {

                    echo  "low $low - j $j i $i | pivot $pivot \n";
                    $i++;
                    echo  "low $low - j $j i++ $i | pivot $pivot \n";
                    // Swap arr[i] and arr[j]
                    $temp = $arr[$i];
                    $arr[$i] = $arr[$j];
                    $arr[$j] = $temp;

                    echo implode(",", $arr) . "\n";
                }
            }

            /**
             * Why the Final Swap?
             * - After the loop, the pivot (arr[high]) is still at the end of the subarray.
             * - The index i points to the last element less than or equal to the pivot.
             */
            // Swap arr[i + 1] and arr[high] (the pivot)
            $temp = $arr[$i + 1];
            $arr[$i + 1] = $arr[$high];
            $arr[$high] = $temp;

            echo implode(",", $arr) . "\n";

            $pivot_idx = $i + 1;


            // Recursively sort elements before and after partition
            $this->quickSort2($arr, $low, $pivot_idx - 1);
            $this->quickSort2($arr, $pivot_idx + 1, $high);
        }

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
$numbs = [10, 7, 8, 9, 1, 5];
echo implode(",", $numbs) . "\n";
$solution->sortArray($numbs);
echo implode(",", $numbs) . "\n";

// Example usage:
$data = [10, 7, 8, 9, 1, 5];
$n = count($data);
echo implode(",", $data) . "\n";
$solution->sortArray2($data, 0, $n - 1);

echo "Sorted array: \n";
echo implode(",", $data) . "\n";