<?php

/**
 *  DSU:  cycle detection, connected components, or minimum spanning trees
 */ 
class RedundantConnection {


    public $n;


    public $isCycleDetected = false;

    /**
     * 
     * Parent Vertex
     * @var array
     */
    public $parent = [];

    public $ans = [];

    /**
     * @param Integer[][] $edges
     * @return Integer[]
     */
    function findRedundantConnection($edges)
    {
        $this->n      = count($edges);
        # initial value of its value
        # $this->parent = array_fill(0, $n + 1, -1);

        for($i = 0; $i <= $this->n; $i++) {
            $this->parent[$i] = $i;
        }

        for($i = 0; $i < $this->n; $i++) {
            # DSU is for undirected graphs; DFS is for directed graphs ?!
            $this->union($edges[$i][0], $edges[$i][1]);
        }

        var_dump($this->ans);

        return array_pop($this->ans);
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
        # cycle detected
        else {
            # If both vertices have the same representative would form a cycle -> cycle detected
            $this->ans[] = [$i, $j];
        }
    }
}



$solution = new RedundantConnection();

$result1 =  $solution->findRedundantConnection([[1,2],[1,3],[2,3]]);
var_dump($result1);

$result2 =  $solution->findRedundantConnection([[1,2],[2,3],[3,4],[1,4],[1,5]]);
var_dump($result2);

var_dump($solution->parent);
