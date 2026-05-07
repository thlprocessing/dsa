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

        $current_using = null;
        $used = [];
        $current_combination = [];


        $this->choose($current_using, $used, $current_combination);
        return $this->ans;
    }

    function chooseOld($used, $current_combination)
    {
        if(count($current_combination) === $this->k)
        {
            $this->ans[] = $current_combination;
            return;
        }

        foreach(range(1, $this->n) as $i)
        {
            
            $current_used = (int) implode(",", $used);
            if(!in_array($i, $used) && $i > $current_used) {

                echo "i: " . $i  . "\n";
                echo "current_used" . $current_used . "\n";
                echo "used: " . implode(",", $used) . "\n";  

                $used[$i] = $i;
                array_push($current_combination, $i);
                echo "using: " . implode(",", $used) . "\n";  
                $this->choose($used, $current_combination);
                array_pop($current_combination);
                unset($used[$i]);
            }
            
        }
    }


    function choose($current_using, $used, $current_combination)
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