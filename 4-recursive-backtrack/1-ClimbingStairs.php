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
        return $this->recv($n);
    }

    public function recv($n)
    {

        if($n <= 2) {
            return $n;
        }

        if($this->dp[$n]) {
            return $this->dp[$n];
        }

        $this->dp[$n] =  $this->recv($n - 1) + $this->recv($n - 2);
        
        return $this->dp[$n];        
    }

}

$solution = new ClimbingStairs();
echo $solution->climbStairs(2)  .  "\n";

echo $solution->climbStairs(3)  .  "\n";