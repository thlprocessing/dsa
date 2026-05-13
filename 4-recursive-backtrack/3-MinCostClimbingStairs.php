<?php

class MinCosClimbingStairs {

    public $dp;


    /**
     * @param Integer[] $cost
     * @return Integer
     */
    function minCostClimbingStairs($cost) {
        $n  = count($cost) + 1;

        $this->dp = array_fill(0, $n + 1, 0);
        return $this->upward($cost, $n);
    }

    /**
     * 
     * With dp: TC O(n)
     * SC: O(n) 
     */
    public function upward($cost, $n)
    {
        
        for($i = $n - 1; $i >= 0; $i--)
        {
            $this->dp[$i] = $cost[$i] ?? 0 + min($this->dp[$i + 1] ?? 0 , $this->dp[$i + 2] ?? 0);
        }

        return min($this->dp[0], $this->dp[1]);
    }
}

$solution = new MinCosClimbingStairs();
echo $solution->minCostClimbingStairs([1,100,1,1,1,100,1,1,100,1]) . "\n";

echo $solution->minCostClimbingStairs([10,15,20]) . "\n";