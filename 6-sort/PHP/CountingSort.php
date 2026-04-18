<?php

class CountingSort {

    function countingSort(&$nums) {
        if (empty($nums)) {
            return $nums;
        }

        $maxValue = max($nums);

        echo "maxValue $maxValue \n";

        // Initialize count array with 0s
        $cnt = array_fill(0, $maxValue + 1, 0);

        echo "before count: " . implode(",", $cnt) . "\n";

        // Count frequencies
        foreach ($nums as $num) {
            $cnt[$num]++;
        }

        echo "after count: " . implode(",", $cnt) . "\n";

        // Reconstruct the array
        $j = 0;
        foreach ($cnt as $val => $freq) {
            echo "val $val freq $freq \n";
            for ($i = 0; $i < $freq; $i++) {
                $nums[$j] = $val;
                $j++;
            }
        }

        return $nums;
    }
    
}