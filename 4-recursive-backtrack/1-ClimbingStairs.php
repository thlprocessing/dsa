<?php

class ClimbingStairs {

    public $dp;

    /**
     * @param Integer $n
     * @return Integer
     */
    function climbStairs($n)
    {
        $this->dp = array_fill(0, $n + 1, 0);
        return $this->upward($n);
    }

    /**
     * 
     * Without dp: TC O(2^n)
     * With dp: TC O(n)
     * SC: O(n) b/c height of recv calls
     * @param mixed $n
     */
    public function downward($n)
    {

        if($n <= 2) {
            return $n;
        }

        if($this->dp[$n]) {
            return $this->dp[$n];
        }

        $this->dp[$n] =  $this->downward($n - 1) + $this->downward($n - 2);
        
        return $this->dp[$n];        
    }

    /**
     * 
     * With dp: TC O(n)
     * SC: O(n) 
     */
    public function upward($n)
    {
        # base case
        $this->dp[1] = 1;
        $this->dp[2] = 2;
        for($i = 3; $i < $n + 1; $i++)
        {
            $this->dp[$i] = $this->dp[$i - 1] + $this->dp[$i - 2];
        }

        return $this->dp[$n];
    }


    public function upwardOps($n)
    {
        # base case 
        $one_step = 1;
        $two_steps = 2;
        $this->dp[2] = 2;
        for($i = 3; $i < $n + 1; $i++)
        {
            $this->dp[$i] = $this->dp[$i - 1] + $this->dp[$i - 2];
        }

        return $this->dp[$n];
    }

}

$solution = new ClimbingStairs();
echo $solution->climbStairs(2)  .  "\n";        # output: 2

echo $solution->climbStairs(3)  .  "\n";        # output: 3