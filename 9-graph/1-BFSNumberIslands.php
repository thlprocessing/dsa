<?php

class BFSNumberIslands
{

    public $grid;

    public $visited = [];

    
    public $directions = [[-1, 0], [1, 0], [0, -1], [0, 1]];

    public $rLength;

    public $cLength;


    /**
     * @param String[][] $grid
     * @return Integer
     */
    function numIslands($grid)
    {
        $this->grid = $grid;
        $this->visited = [];

        if(!$this->grid) {
            return 0;
        }

        $count = 0;

        $this->rLength = count($this->grid);
        $this->cLength = count($this->grid[0]);


        for($r = 0; $r < $this->rLength; $r++) {
            for($c = 0; $c < $this->cLength; $c++) {
                if(!isset($this->visited["$r+$c"]) && $this->grid[$r][$c] === "1") {
                    # current_node: ad neighbor nodes and add to visited
                    $this->bfs($r, $c);
                    $count++;
                }
            }
        }

        return $count;
    }

    /**
     * 
     * Runtime: 147 ms
     * Memory: 39.91 MB
     * @param mixed $r
     * @param mixed $c
     * @return void
     */
    public function bfs($r, $c)
    {
        $this->visited["$r+$c"] = true;
        $deque = [];
        array_push($deque, [$r, $c]);

        while(!empty($deque)) {

            [$r, $c] = array_shift($deque);

            foreach($this->directions as [$dx, $dy]) {

                $next_r = $r + $dx;
                $next_c = $c + $dy;

                if(0 <= $next_r && $next_r < $this->rLength && 0 <= $next_c && $next_c < $this->cLength && $this->grid[$next_r][$next_c] === "1") {
                    # add ad into visited nodes
                    if (!isset($this->visited["$next_r+$next_c"])) {
                        $this->visited["$next_r+$next_c"] = true;
                        # add ad into queue for next ad
                        array_push($deque, [$next_r, $next_c]);
                    }
                }
            }
        }

        
    }
}

$grid = [
  ["1","1","1","1","0"],
  ["1","1","0","1","0"],
  ["1","1","0","0","0"],
  ["0","0","0","0","0"]
];

$grid1 = [
  ["1","1","0","0","0"],
  ["1","1","0","0","0"],
  ["0","0","1","0","0"],
  ["0","0","0","1","1"]
];

$solution = new BFSNumberIslands();
echo $solution->numIslands($grid) . "\n";   # output: 1
echo $solution->numIslands($grid1) . "\n";  # output: 3