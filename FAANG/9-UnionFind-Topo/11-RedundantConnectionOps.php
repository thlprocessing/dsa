<?php

/**
 *  DSU is for undirected graphs; DFS is for directed graphs
 *  DSU:  cycle detection, connected components, or minimum spanning trees
 */ 
class RedundantConnection {


    public $n;


    /**
     * 
     * Parent Vertex
     * @var array
     */
    public $parent = [];

    public $ans = [];

    /**
     * RT: 1ms Beats 100.00%
     * Memeory: 21.22MB Beats 80.00%

     * @param Integer[][] $edges
     * @return Integer[]
     */
    function findRedundantConnection($edges)
    {
        $this->n      = count($edges);
        
        for($i = 0; $i <= $this->n; $i++) {
            $this->parent[$i] = -1;
        }

        for($i = 0; $i < $this->n; $i++) {
            # DSU is for undirected graphs; DFS is for directed graph
            $this->union($edges[$i][0], $edges[$i][1]);
        }


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

        $root = $i;

        while($this->parent[$root] != -1) {
            $root = $this->parent[$root];
        }

        while($i != $root) {
            $u = $this->parent[$i];
            $this->parent[$i] = $root;
            $i = $u;
        }

        return $root;
    }


    public function union($i, $j)
    {
        # find root of the vertex i and j
        
        $u = $this->find($i);
        $v = $this->find($j);

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

$result1 =  $solution->findRedundantConnection([[1,2],[1,3],[2,3]]);        # [2,3]
var_dump($result1);

$result2 =  $solution->findRedundantConnection([[1,2],[2,3],[3,4],[1,4],[1,5]]);    # [1,4]
var_dump($result2);

var_dump($solution->parent);
