<?php

class SurroundedRegions
{

    public $grid;

    public $visited = [];

    
    public $directions = [[-1, 0], [1, 0], [0, -1], [0, 1]];

    public $rLength;

    public $cLength;


    /**
     * @param String[][] $board
     * @return NULL
     */
    function solve(&$board)
    {


        $this->grid = $board;
        $this->visited = [];

        if(!$this->grid) {
            return 0;
        }


        $this->rLength = count($this->grid);
        $this->cLength = count($this->grid[0]);


        for($r = 0; $r < $this->rLength; $r++) {
            for($c = 0; $c < $this->cLength; $c++) {
                
                if(($r === 0 || 
                    $c === 0 ||
                    $r === ($this->rLength - 1) ||
                    $c === ($this->cLength - 1)
                    ) &&
                    $this->grid[$r][$c] === "O"
                ) {
                    continue;
                }

                if(!isset($this->visited["$r+$c"])) {
                    $is_having_edges = $this->dfs($r, $c);
                    if(!$is_having_edges) {
                        $this->grid[$r][$c] = "X";
                    }
                }
            }
        }

        $board = $this->grid;

        return $board;
    }

    public function dfs($r, $c)
    {
        
        $this->visited["$r+$c"] = true;
        
        $is_having_edges = false;
        $color_nodes = [];

        foreach($this->directions as [$dx, $dy]) {

            $next_r = $r + $dx;
            $next_c = $c + $dy;


            if(0 <= $next_r && $next_r < $this->rLength && 0 <= $next_c && $next_c < $this->cLength && $this->grid[$next_r][$next_c] === "O") {

                if(($next_r  === 0 ||
                    $next_c === 0 ||
                    $next_r === ($this->rLength - 1) ||
                    $next_c === ($this->cLength - 1)) && 
                    $this->grid[$next_r][$next_c] === "O"
                ) {
                    echo "next_r  next_c $next_r $next_c | is_having_edges: $is_having_edges \n";
                    $is_having_edges = true;              
                    break;
                }

                if (!isset($this->visited["$next_r+$next_c"])) {                                        
                    $is_having_edges = $this->dfs($next_r, $next_c);

                    if($is_having_edges) {
                        break;
                    } else {
                        $color_nodes[] = [$next_r, $next_c];
                    }
                    
                    # reset visited on backtrack returning
                    unset($this->visited["$next_r+$next_c"]);
                }
            }
        }


        # reset visited for each cell
        unset($this->visited["$r+$c"]);

        # color visited nodes without having edges
        if(!$is_having_edges) {
            foreach($color_nodes as [$node_r, $node_c]) {
                $this->grid[$node_r][$node_c] = "X";
            }
        }

        return $is_having_edges;
    }
}


$grid = [["X","X","X","X"],["X","O","O","X"],["X","X","O","X"],["X","O","X","X"]];

$grid1 = [["X"]];

$grid2 = [["O","O"],["O","O"]];

$grid3 = [["X","X","X"],["X","O","X"],["X","X","X"]];

$grid4 = [["O","O","O"],["O","O","O"],["O","O","O"]];

$grid5 = [["O","X","X","O","X"],["X","O","O","X","O"],["X","O","X","O","X"],["O","X","O","O","O"],["X","X","O","X","O"]];

$solution = new SurroundedRegions();
#print_r( $solution->solve($grid));   # output: [["X","X","X","X"],["X","X","X","X"],["X","X","X","X"],["X","O","X","X"]]
#print_r($solution->solve($grid1));   # output: [["X"]]

#print_r($solution->solve($grid2));   # output: [["X"]]

#print_r($solution->solve($grid3));    # output: [["X","X","X"],["X","X","X"],["X","X","X"]]

#print_r($solution->solve($grid4));    # output: [["O","O","O"],["O","O","O"],["O","O","O"]]

# board
# ["O","X","X","O","X"]
# ["X","O","O","X","O"]
# ["X","O","X","O","X"]
# ["O","X","O","O","O"]
# ["X","X","O","X","O"]

# expected
# ["O","X","X","O","X"]
# ["X","X","X","X","O"]
# ["X","X","X","O","X"]     
# ["O","X","O","O","O"]     
# ["X","X","O","X","O"]     

# output
# ["O","X","X","O","X"]
# ["X","X","X","X","O"]
# ["X","X","X","X","X"]
# ["O","X","O","O","O"]
# ["X","X","O","X","O"]

print_r($solution->solve($grid5));   # output: [["O","X","X","O","X"],["X","X","X","X","O"],["X","X","X","O","X"],["O","X","O","O","O"],["X","X","O","X","O"]]




# [["O","X","O","O","O","X"],["O","O","X","X","X","O"],["X","X","X","X","X","O"],["O","O","O","O","X","X"],["X","X","O","O","X","O"],["O","O","X","X","X","X"]]