<?php

class MaxAreaOfIsland {

    public $grid;

    public $visited = [];

    
    public $directions = [[-1, 0], [1, 0], [0, -1], [0, 1]];

    public $rLength;

    public $cLength;

    public $maxAreaCount;


    /**
     * @param String[][] $grid
     * @return Integer
     */
    function maxAreaOfIsland($grid)
    {
        $this->grid         = $grid;
        $this->visited      = [];
        $this->maxAreaCount = 0;

        if(!$this->grid) {
            return 0;
        }

        $count = 0;
        

        $this->rLength = count($this->grid);
        $this->cLength = count($this->grid[0]);


        for($r = 0; $r < $this->rLength; $r++) {
            for($c = 0; $c < $this->cLength; $c++) {
                echo "visiting: $r+$c: " . $this->grid[$r][$c] . "\n";
                $areaCount = 0;
                if(!isset($this->visited["$r+$c"]) && $this->grid[$r][$c] === 1) {
                    $areaCount++;
                    $areaCount = $this->dfs($r, $c, $areaCount);
                    $count++;
                }
            }
        }

        return $this->maxAreaCount;
    }

    public function dfs($r, $c, $areaCount)
    {
        $this->visited["$r+$c"] = true;
        echo "--dfs visiting: $r+$c \n";
        

        foreach($this->directions as [$dx, $dy]) {

            $next_r = $r + $dx;
            $next_c = $c + $dy;
            echo "----dfs visiting next_r next_c: $next_r+$next_c \n";
            if(0 <= $next_r && $next_r < $this->rLength && 0 <= $next_c && $next_c < $this->cLength && $this->grid[$next_r][$next_c] === 1) {
                if (!isset($this->visited["$next_r+$next_c"])) {
                    echo "------dfs visiting next_r next_c: $next_r+$next_c \n";
                    $areaCount++;
                    $areaCount = $this->dfs($next_r, $next_c, $areaCount);
                    
                }
            }
        }

        echo "area count: $areaCount \n";
        echo "max area count: " . $this->maxAreaCount . "\n";

        $this->maxAreaCount = max($this->maxAreaCount, $areaCount);

        return $areaCount;
    }
}

$grid = [[0,0,1,0,0,0,0,1,0,0,0,0,0],[0,0,0,0,0,0,0,1,1,1,0,0,0],[0,1,1,0,1,0,0,0,0,0,0,0,0],[0,1,0,0,1,1,0,0,1,0,1,0,0],[0,1,0,0,1,1,0,0,1,1,1,0,0],[0,0,0,0,0,0,0,0,0,0,1,0,0],[0,0,0,0,0,0,0,1,1,1,0,0,0],[0,0,0,0,0,0,0,1,1,0,0,0,0]];

$grid1 = [[0,0,0,0,0,0,0,0]];

$grid2 = [[1,1,0,0,0],[1,1,0,0,0],[0,0,0,1,1],[0,0,0,1,1]];

# 1 1 0 0 0
# 1 1 0 0 0
# 0 0 0 1 1
# 0 0 0 1 1

$solution = new MaxAreaOfIsland();
#echo $solution->maxAreaOfIsland($grid) . "\n";   # output: 6
#echo $solution->maxAreaOfIsland($grid1) . "\n";  # output: 0

echo $solution->maxAreaOfIsland($grid2) . "\n";  # output: 4