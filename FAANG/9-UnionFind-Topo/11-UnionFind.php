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
        while($this->parent[$i] !== -1)
        {
            echo "--finding: i: $i | parent[$i]: " . $this->parent[$i] . "\n";
            $i = $this->parent[$i];
        }
        
        echo "--finding: i: $i " . "\n";

        return $i;
    }

    public function union($i, $j)
    {
        echo "----union: i: $i, j: $j \n";
        echo "----parent[$j] = $i \n";
        $this->parent[$j] = $i;
    }


    public function quickFind($parent, $i) {

        while($parent[$i] !== -1)
        {
            echo "--finding: i: $i | parent[$i]: " . $parent[$i] . "\n";
            $i = $parent[$i];
        }
        
        echo "--finding: i: $i " . "\n";

        return $i;
    }
}


$solution = new UnionFind(5);

#$solution->add(1, 2);
#$solution->add(2, 3);
#$solution->add(1, 4);
#$solution->add(2, 5);

#var_dump($solution->parent);


#           0
#       1       2
#     3   4    5  6


# parent array:    
#   # array value: -1  0  0  1  1  2     
#   # array index:  0  1  2  3  4  5
$solution->quickFind([-1,0,0,1,1,2,2], 4);