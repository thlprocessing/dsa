<?php

class CountingSort {

    public function countingSort(&$numbs)
    {
        
        $countingFreq = [];

        // php array maintain insertion order for dynamic keys encountered
        $maxValue = max($numbs);
        // initialize count array with 0s to force correct order of indexes
        $countingFreq = array_fill(0, $maxValue + 1, 0);

        // counting frequencies
        foreach($numbs as $numb) {
            $countingFreq[$numb]++;
        }
        
        $reindex = 0;
        foreach($countingFreq as $numb => $freq) {
            for($i = 0; $i < $freq; $i++) {
                $numbs[$reindex++] = $numb;
            }
        }
    }

}

$data = [1, 2, 3, 0, 6, 0, 1, 1, 3];
$solution = new CountingSort();
$solution->countingSort($data);

echo "counting sort: " . implode(",", $data) . "\n";