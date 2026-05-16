<?php

class CloneGraph {


    public $graphNode;

    public $n;

    public $ans = [];

    public $path = [];

    public $visited = [];

    public $rootNode;

    public $cloneRootNode;

    /**
     * @param Node $node
     * @return Node
     */
    function cloneGraph($node) {
        
        $this->rootNode = $node;
        #$this->n     = count($graph);
        
        $this->visited = [];
        $this->ans     = [];
        $this->path    = [];

        if(!$node) {
            return null;
        }

        
        #$this->path[] = 0;
        #$this->ans[]   = $this->cloneRootNode;
        return $this->bfs($this->rootNode);

    }

    /**
     * 
     * Runtime: 9 ms
     * Memory: 21.64 MB
     * @param mixed $rootNode
     * @return Node
     */
    function bfs($rootNode)
    {


        $clonedRootNode   = new Node($rootNode->val);
        $this->visited[$rootNode->val] = $clonedRootNode;

        $deque = [];
        array_push($deque, $rootNode);

        while(!empty($deque)) {

            $nodeI       = array_shift($deque);
            $clonedNodeI = $this->visited[$nodeI->val];

            // $clonedNodeI   = new Node($nodeI->val);
            // $this->visited[$nodeI->val] = $clonedNodeI;
            

            foreach($nodeI->neighbors as $nodeJ) {
                
                
                if(!isset($this->visited[$nodeJ->val])) {
                    $clonedNodeJ = new Node($nodeJ->val);
                    $this->visited[$nodeJ->val]  = $clonedNodeJ;
                    #array_pop($this->path);
                    array_push($deque, $nodeJ);
                    #array_push($this->path, $j);
                    
                } else {
                    $clonedNodeJ =  $this->visited[$nodeJ->val];
                }

                $clonedNodeI->neighbors[] = $clonedNodeJ;
                
                
            }
        }

        return $clonedRootNode;
    }
}


 class Node {

    public $val = null;
    public $neighbors = null;
    function __construct($val = 0) {
        $this->val = $val;
        $this->neighbors = array();
    }

}



/**
 * Builds a graph from an adjacency list array.
 * Assumes 1-based indexing for node values in the input array.
 */
function buildGraph(array $adjList): ?Node {
    if (empty($adjList)) return null;

    $nodes = [];

    // First pass: Create all node objects
    // Using 1-based indexing to match the values in your example array [[2,4], [1,3]...]
    for ($i = 1; $i <= count($adjList); $i++) {
        $nodes[$i] = new Node($i);
    }

    // Second pass: Populate neighbors
    foreach ($adjList as $index => $neighborValues) {
        $currentNodeVal = $index + 1;
        foreach ($neighborValues as $neighborVal) {
            // Add the corresponding Node object to the current node's neighbors list
            $nodes[$currentNodeVal]->neighbors[] = $nodes[$neighborVal];
        }
    }

    // Return the reference to the first node
    return $nodes[1];
}

// Input data
$adjArray = [[2, 4], [1, 3], [2, 4], [1, 3]];

// Build the graph
$rootNode = buildGraph($adjArray);

// Verification: Print the root node value and its neighbors' values
echo "Root Node Val: " . $rootNode->val . "\n";
echo "Neighbors: " . implode(", ", array_map(fn($n) => $n->val, $rootNode->neighbors));

//var_dump($rootNode);


$solution = new CloneGraph();

$clonedRootNode      = $solution->cloneGraph($rootNode);
var_dump($clonedRootNode);