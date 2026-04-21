<?php

class CountingSort {

    /**
     * 
     * Duyệt qua dãy lần thứ nhất để đếm số lần xuất hiện của từng phần tử.
     * Cộng dồn các đếm số để khởi tạo vị trí đầu tiên của các phần tử sau khi được sort. 
     * Duyệt qua dãy lần thứ hai, với mỗi phần tử, nhét phần tử đó vào vị trí đếm hiện tại tương ứng và giảm giá trị đếm đi 1.

     * @param mixed $numbs
     * @return void
     */
    public function unstableCountingSort(&$numbs)
    {
        # step 1: Duyệt qua dãy lần thứ nhất để đếm số lần xuất hiện của từng phần tử.
        $countingFreq = [];

        # php array maintain insertion order for dynamic keys encountered
        $maxValue = max($numbs);
        # initialize count array with 0s to force correct order of indexes
        $countingFreq = array_fill(0, $maxValue + 1, 0);

        # counting frequencies
        foreach($numbs as $numb) {
            $countingFreq[$numb]++;
        }
        var_dump($countingFreq);
        # Step 2: Cộng dồn các đếm số để khởi tạo vị trí đầu tiên của các phần tử sau khi được sort. 
        $cumFreqNumbs = [];
        $lenth = count($countingFreq);
                # cumulative sum for numb frequency
        for($i = 0; $i < $lenth; $i++) {
            if ($i == 0) {
                $cumFreqNumbs[$i]  = $countingFreq[$i];
            } else {
                $cumFreqNumbs[$i]  = $countingFreq[$i] + $cumFreqNumbs[$i - 1];
            }
        }
        var_dump($cumFreqNumbs);

        # Step 3: Duyệt qua dãy lần thứ hai, với mỗi phần tử, nhét phần tử đó vào vị trí đếm hiện tại tương ứng và giảm giá trị đếm đi 1.
        $result = [];
        // for($i = 0; $i < $lenth; $i++) {
        //     for($i = 0; $i < )
        // }
        var_dump($result);
        
        
    }

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
        
        // unstable: last in first out
        // $reindex = 0;
        // foreach($countingFreq as $numb => $freq) {
        //     for($i = 0; $i < $freq; $i++) {
        //         $numbs[$reindex++] = $numb;
        //     }
        // }
        echo "numbs: \n";
        var_dump($numbs);
        echo "countingFreq: \n";
        var_dump($countingFreq);
        # Step 2: Cumulative cnt array
        for($i = 1; $i < ($maxValue + 1); $i++) {
            $countingFreq[$i] += $countingFreq[$i - 1];
        }
        echo "cumulative countingFreq: \n";
        var_dump($countingFreq);

        
        
        # Step 3: Put numbers in the correct order with stability
        $arr = array_fill(0, count($numbs), 0);

        for ($i = count($numbs) - 1; $i >= 0; $i--) {
            $val = $numbs[$i];
            echo "i: " . $i . "| val: " . $val . "|  numbs[i]: " . $numbs[$i] . "\n";
            echo "countingFreq[val]: " . $countingFreq[$val] . "\n";
            $arr[$countingFreq[$val]] = $val;
            $countingFreq[$val] -= 1;
        }
        

        return $arr;

    }

}

$data = [1, 2, 3, 0, 6, 0, 1, 1, 3];
$solution = new CountingSort();

//$solution->unstableCountingSort($data);

$result = $solution->countingSort($data);

echo "result: " . implode(",", $result) . "\n";