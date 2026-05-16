<?php

class IsGraphBipartite {

    const WHITE = -1;
    
    const RED   = 0;

    const BLACK = 1;

    public $graph;

    public $n;

    public $ans = [];

    public $path = [];

    public $visited = [];

    public $visitedColors = [];


    /**
     * @param Integer[][] $graph
     * @return Boolean
     */
    function isBipartite($graph) {
          
        $this->graph = $graph;
        $this->n     = count($graph);
        
        $this->visited = [];
        $this->ans     = true;
        $this->path    = [];
        $this->visitedColors = array_fill(0, $this->n, self::WHITE);

        if(!$graph) {
            return false;
        }

        # start from first node
        for($i = 0; $i < $this->n; $i++) {
            # dfs unvisited node
            if($this->visitedColors[$i] === self::WHITE) {
                $this->visitedColors[$i] = self::RED;
                $this->dfs($i);
            }
        }


        return $this->ans;
    }

    function dfs($i) {

        foreach($this->graph[$i] as $j) {
            # if visited color
            if($this->visitedColors[$i] === $this->visitedColors[$j]) {
                return $this->ans = false;
            } else if ($this->visitedColors[$j] === self::WHITE) {
                # otherwise: set other color for $i's adjacent nodes
                $this->visitedColors[$j] = 1 - $this->visitedColors[$i];
                # 
                $this->dfs($j);
            }
        }
    }

}




$solution = new IsGraphBipartite();


$grid = [[1,2,3],[0,2],[0,1,3],[0,2]];
echo $solution->isBipartite($grid) . "\n";   # output: false

$grid1 = [[1,3],[0,2],[1,3],[0,2]];
echo $solution->isBipartite($grid1) . "\n";   # output: true
