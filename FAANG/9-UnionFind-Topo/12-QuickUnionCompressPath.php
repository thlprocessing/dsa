<?php

class QuickUnionCompressPath {


    public $n;

    /**
     * 
     * Parent Vertex
     * @var array
     */
    public $parent = [];

    
    /**
     * 
     * @param mixed $n
     */
    public function __construct($n)
    {
        $this->n      = $n;
        # initial value of its value
        # $this->parent = array_fill(0, $n + 1, -1);
        for($i = 0; $i < $n; $i++) {
            $this->parent[$i] = $i;
        }
    }

    public function query($i, $j)
    {
        return $this->find($i) === $this->find($j);
    }

    /**
     * 
     * @param mixed $i
     * @return int
     */
    public function find($i)
    {
        # base case
        echo "i: $i - parent[$i]: " . $this->parent[$i] . "\n";
        if($i === $this->parent[$i]) {
            echo "backtrack: i: $i \n";
            return $i;
        }
        ## Path Compression
        # next call on same node: recursion and backtrack set
        echo "--i: $i - parent[$i]: " . $this->parent[$i] . "\n";
        echo "--recursion and backtrack set: parent[$i] =  find(this->parent[$i] \n";
        return $this->parent[$i] = $this->find($this->parent[$i]);
    }


    public function union($i, $j)
    {
        # find root of the vertex i and j
        echo "union: i: $i, j: $j \n";
        $u = $this->find($i);
        $v = $this->find($j);

        echo "union: i: $i, j: $j, u: $u, v: $v \n \n";

        if($u !== $v) {
            
            $this->parent[$v] = $u;

        }
    }
}



$solution = new QuickUnionCompressPath(10);

# union 1-2-5-6-7 3-8-9 4
$solution->union(1, 2);
$solution->union(2, 5);
$solution->union(5, 6);
$solution->union(6, 7);
$solution->union(3, 8);
$solution->union(8, 9);



echo "root vertex: " . implode(",", $solution->parent) . "\n";
echo "     vertex: " . implode(",", array_keys($solution->parent)) . "\n";

#root vertex: 0,1,1,3,4,1,1,1,3,3
#     vertex: 0,1,2,3,4,5,6,7,8,9

echo (bool) $solution->query(1, 5) . " query \n";     # true
echo (bool) $solution->query(5, 7) . " query \n";     # true
echo (bool) $solution->query(4, 9) . " query \n";     # false 

# 1-2-5-6-7 3-8-9-4
$solution->union(9, 4);

echo (bool) $solution->query(4, 9) . " query \n";     # true 


echo "root vertex: " . implode(",", $solution->parent) . "\n";
echo "     vertex: " . implode(",", array_keys($solution->parent)) . "\n";

# root vertex: 0,1,1,3,3,1,1,1,3,3
#      vertex: 0,1,2,3,4,5,6,7,8,9