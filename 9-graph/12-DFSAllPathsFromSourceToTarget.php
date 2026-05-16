<?php 

class DFSAllPathsFromSourceToTarget {


    public $graph;

    public $n;

    public $ans = [];

    public $path = [];

    public $visited = [];

    /**
     * @param Integer[][] $graph
     * @return Integer[][]
     */
    function allPathsSourceTarget($graph) {
        
        $this->graph = $graph;
        $this->n     = count($graph);
        
        $this->visited = [];
        $this->ans     = [];
        $this->path    = [];

        if(!$graph) {
            return [[]];
        }

        
        $this->path[] = 0;
        $this->dfs(0);

        return $this->ans;
    }

    function dfs($i) {

        if($i === ($this->n - 1)) {
            $this->ans[] = $this->path;
            return;
        }

        $this->visited[$i] = true;

        foreach($this->graph[$i] as $j) {
            if(!isset($this->visited[$j]) || !$this->visited[$j]) {                
                array_push($this->path, $j);
                $this->dfs($j);
                array_pop($this->path);
            }
        }
        
        $this->visited[$i] = false;
    }
}


$solution = new AllPathsFromSourceToTarget();

$graph    = [[1,2],[3],[3],[]];
//$ans      = $solution->allPathsSourceTarget($graph);

//var_dump($ans);


$graph1    = [[4,3,1],[3,2,4],[3],[4],[]];
$ans1      = $solution->allPathsSourceTarget($graph1);

var_dump($ans1);