<?php

class Combinations {

    public $n;

    public $k;

    public $ans = [];

    /**
     * @param Integer $n
     * @param Integer $k
     * @return Integer[][]
     */
    function combine($n, $k) {
        

        $this->n = $n;
        $this->k = $k;
        $this->ans = [];

        $current_combination = [];

        $this->choose(1, $current_combination);
        //$this->chooseOld($current_using, $used, $current_combination);
        return $this->ans;
    }

    /**
     * 
     * Runtime: 444 ms
     * Beats: 5.00%
     * @param mixed $current_using
     * @param mixed $current_combination
     * @return void
     */
    function choose($current_using, $current_combination)
    {
        if(count($current_combination) === $this->k)
        {
            
            echo "ans current_using: " . $current_using . " current_com: " . implode(",", $current_combination) . "\n";
            $this->ans[] = $current_combination;
            return;
        }

            
        // // Optimization 1: Start loop from $current_using + 1 to avoid redundant checks.
        // // Optimization 2: Prune the search space if there are not enough remaining elements to complete the combination.
        // $needed = $this->k - count($current_combination);
        // $end = $this->n - $needed + 1;
        $end = $this->n;

        for ($i = $current_using; $i <= $end; $i++) {

            array_push($current_combination, $i);
            echo "i: $i " . " push_com: " . implode(",", $current_combination) . "\n";            
            echo "before choose: " . ($i + 1)  . " current_com: " . implode(",", $current_combination) . "\n";
            $this->choose($i + 1, $current_combination);
            echo "after choose: " . ($i + 1)  . " current_com: " . implode(",", $current_combination) . "\n";
            array_pop($current_combination);                
            echo "i: $i "   . " pop_com: " . implode(",", $current_combination) . "\n";
        }
        
    }

    /**
     * 
     * Runtime: 459 ms
     * Beats: 5.00%
     * @param mixed $current_using
     * @param mixed $used
     * @param mixed $current_combination
     * @return void
     */
    function chooseOld($current_using, $used, $current_combination)
    {
        if(count($current_combination) === $this->k)
        {
            $this->ans[] = $current_combination;
            return;
        }

        foreach(range(1, $this->n) as $i)
        {
            
            if(!in_array($i, $used) && $i > $current_using){

                // echo "i: " . $i  . "\n";
                // echo "current_using" . $current_using . "\n";
                // echo "used: " . implode(",", $used) . "\n";  

                $used[$i] = $i;
                $current_using = $i;
                array_push($current_combination, $i);
                //echo "using: " . implode(",", $used) . "\n";  

                // Current complexity:O(N^K)
                // Suggested complexity:O(K∗C(N,K))
                // suggestion: Prune the search space by starting the loop from current_using + 1 instead of 1 to avoid redundant checks.
                $this->choose($current_using , $used, $current_combination);
                array_pop($current_combination);
                unset($used[$i]);
            }
            
        }
    }
}


$solution = new Combinations();
$ans = $solution->combine(4, 2);

var_dump($ans);