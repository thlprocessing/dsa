<?php

class CountingSort {

    public function countingSort(&$numbs)
    {
        
        $countingFreq = [];

        # php array maintain insertion order for dynamic keys encountered
        $maxValue = max($numbs);
        # initialize count array with 0s to force correct order of indexes
        $countingFreq = array_fill(0, $maxValue + 1, 0);

        # counting frequencies
        foreach($numbs as $numb) {
            $countingFreq[$numb]++;
        }
        
        // unstable
        // $reindex = 0;
        // foreach($countingFreq as $numb => $freq) {
        //     for($i = 0; $i < $freq; $i++) {
        //         $numbs[$reindex++] = $numb;
        //     }
        // }

        # Step 2: Cumulative cnt array
        for($i = 1; $i < ($maxValue + 1); $i++) {
            $countingFreq[$i] += $countingFreq[$i - 1];
        }

        # Step 3: Put numbers in the correct order with stability
        $arr = array_fill(0, count($numbs), 0);

        for ($i = count($numbs) - 1; $i >= 0; $i--) {
            $val = $numbs[$i];
            $countingFreq[$val] -= 1;
            $arr[$countingFreq[$val]] = $val;
        }
        

        return $arr;

    }

}

$data = [1, 2, 3, 0, 6, 0, 1, 1, 3];
$solution = new CountingSort();
$result = $solution->countingSort($data);

echo "counting sort: " . implode(",", $result);