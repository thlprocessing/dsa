<?php 

class UnionFind {

    public $n;

    public $parent = [];

    
    public function __construct($n) {

        $this->n = $n;
        $this->parent = array_fill(0, $this->n + 1, -1);

        /**
         * # $this->parent = array_fill(0, $this->n, -1);
         * Why it was looping:
         *  1. You initialized UnionFind with $n = 5. array_fill(0, $this->n, -1) creates an array with indices 0, 1, 2, 3, 4.
         *  2. When you called $solution->add(4, 5);, it ran $this->find(5);.
         *  3. In find(5), it checked the while loop condition: while($this->parent[5] !== -1).
         *  4. Since index 5 did not exist in the array, PHP triggered an Undefined array key 5 warning and evaluated $this->parent[5] as null.
         *  5. Because null !== -1 is true, the loop executed and set $i = null.
         *  6. On the next iteration, it checked $this->parent[null] (which PHP casts to an empty string ""), threw another warning, and evaluated to null again.
         *  7. This resulted in an infinite loop because null !== -1 always remained true. 
         *  How I fixed it:
         *  I modified the __construct method to allocate $this->n + 1 elements instead of $this->n. Because your driver code uses 1-based indexing (calling nodes 1 through 5), the parent array needed to have indices up to 5.
         */
        
    }

    public function add($i, $j)
    {
        echo "adding: i: $i, j: $j \n";

        $u = $this->find($i);
        $v = $this->find($j);

        echo "-- after find: i: $i, j: $j, u: $u, v: $v \n";

        if($u !== $v) {
            $this->union($u, $v);
        }

        echo "------ union parent: " . implode(",", $this->parent) . "\n";
    }

    public function query($i, $j)
    {
        return $this->find($i) === $this->find($j);
    }

    public function find($i) 
    {

        $root = $i;

        while($this->parent[$root] !== -1)
        {
            echo "--finding: i: $i | parent[$i]: " . $this->parent[$i] . "\n";
            $root = $this->parent[$root];
        }
        
        echo "--finding: i: $i " . "\n";

        while($i !== $root) {
            $u = $this->parent[$i];
            $this->parent[$i] = $root;
            $i = $u;
        }

        return $root;
    }

    public function union($i, $j)
    {
        echo "----union: i: $i, j: $j \n";
        echo "----parent[$j] = $i \n";
        $this->parent[$j] = $i;
    }
}


$solution = new UnionFind(5);

$solution->add(0, 0);
$solution->add(0, 1);
$solution->add(1, 0);
$solution->add(1, 2);
$solution->add(2, 1);
$solution->add(2, 2);


# https://leetcode.com/problems/most-stones-removed-with-same-row-or-column/

#       (1,2)  (2,2)

# (0,1)        (2,1)

# (0,0) (1,0)  


# ---


# (0,0)  (0,1)
#
# (1,0)          (1,2)
#
#        (2,1)   (2,2)
                

# [2,2] because it shares the same row      as [2,1]
# [2,1] because it shares the same column   as [0,1]
# [1,2] because it shares the same row      as [1,0]
# [1,0] because it shares the same column   as [0,0]
# [0,1] because it shares the same row      as [0,0]

# 0 -> 1  -> 2 
# 0 <- 1  <- 2 

var_dump($solution->parent);

