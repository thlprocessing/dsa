<?php 

/**

 * DSU is for undirected graphs; DFS is for either directed graphs or undirected graphs
 * DSU:  cycle detection, connected components, or minimum spanning trees
 * DFS: explore paths
 * BFS: shortest paths
 * General traversals used to explore paths, find shortest paths (BFS only), and detect cycles.
 * 
 * DFS for undirected graph: visited to traverse

 * 
 * Depth first search is more memory efficient than breadth first search as you can backtrack sooner. It is also easier to implement if you use the call stack but this relies on the longest path not overflowing the stack.
 * 
 * Also if your graph is directed then you have to not just remember if you have visited a node or not, but also how you got there. Otherwise you might think you have found a cycle but in reality all you have is two separate paths A->B but that doesn't mean there is a path B->A.
 * 
 * If you do BFS starting from 0, it will detect as cycle is present but actually there is no cycle.
 * 
 * With a depth first search you can mark nodes as visited as you descend and unmark them as you backtrack. See comments for a performance improvement on this algorithm.
 * 
 * https://stackoverflow.com/questions/2869647/why-dfs-and-not-bfs-for-finding-cycle-in-graphs
 */


/**
 * https://stackoverflow.com/questions/19113189/detecting-cycles-in-a-graph-using-dfs-2-different-approaches-and-whats-the-dif
 *
 * Find a cycle in undirected graphs: visited node
 *  - An undirected graph has a cycle if and only if a depth-first search (DFS) finds an edge that points to an already-visited vertex (a back edge).
 * Find a cycle in directed graphs: in recursion stack
 *  - In addition to visited vertices we need to keep track of vertices currently in recursion stack of function for DFS traversal. If we reach a vertex that is already in the recursion stack, then there is a cycle in the tree.
 * /

class TopologicalSort {


    public $n;

    public $graph_edges;

    public $degree;

    public $visited = [];

    public $requireds = [];

    public function __construct($n, $edges) {

        $this->n = $n;
        $this->degree = array_fill(0, $this->n + 1, 0);
        $this->visited  = array_fill(0, $this->n + 1, false);

        foreach($edges as $edge) {
            
            $u = $edge[0];  # require
            $v = $edge[1];

            
            $this->graph_edges[$u][] = $v;
            $this->degree[$v]++;
        }
        
    }

    public function BFSKahnSort()
    {

        $deque = [];
        
        for($i = 0; $i < $this->n; $i++) {
            if($this->degree[$i] === 0) {
                array_push($deque, $i);        
            }
        }


        while(!empty($deque)) {

            $i = array_shift($deque);

            $this->requireds[] = $i;
            
            if(isset($this->graph_edges[$i])) {
                foreach($this->graph_edges[$i] as $j) {
                    $this->degree[$j]--;
                    
                    if($this->degree[$j] === 0) {
                        array_push($deque, $j);
                    }
                }
            } 
        }

        return $this->requireds;
    }


    public function DFSSort()
    {
        $requireds = [];

        for($i = 0; $i < $this->n; $i++) {
            if(!$this->visited[$i]) {
                $this->dfs($i, $requireds);
            }
        }

        return array_reverse($requireds);
        
    }

    public function dfs($i, &$requireds)
    {
        $this->visited[$i] = true;

        if(isset($this->graph_edges[$i])) {
            foreach($this->graph_edges[$i] as $j) {
                if(!$this->visited[$j]) {
                    $this->dfs($j, $requireds);
                }
            }
        } 

        $requireds[] = $i;
    }

}



#$solution = new TopologicalSort(5, [[0, 1], [0, 2], [3, 2], [1, 4], [2, 4], [4, 5]]);       # 0 3 1 2 4 5

#$result = $solution->BFSKahnSort();     # 0 3 1 2 4 5
#var_dump($result);

#$result1 = $solution->DFSSort();        # 3 0 2 1 4 5
#var_dump($result1);



$solution1 = new TopologicalSort(5, [[1, 3], [1, 2], [3,4], [4,0], [2,0]]);                 # 1 3 2 4 0 

$result2 = $solution1->BFSKahnSort();     # 1 3 2 4 0 
var_dump($result2);

$result3 = $solution1->DFSSort();         # 1 2 3 4 0 
var_dump($result3);
