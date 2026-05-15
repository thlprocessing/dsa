<?php

/**
 * 
 * Find Path
 */
class DFSWordSearch {


    public $grid;

    public $visited = [];

    
    public $directions = [[-1, 0], [1, 0], [0, -1], [0, 1]];

    public $rLength;

    public $cLength;

    public $word;

    public $current_combination;

    public $isFound = false;

    /**
     * @param String[][] $board
     * @param String $word
     * @return Boolean
     */
    function exist($board, $word) 
    {
        $this->grid = $board;
        $this->word = $word;
        $this->current_combination = "";

        

        if(!$this->grid) {
            return 0;
        }


        $this->rLength = count($this->grid);
        $this->cLength = count($this->grid[0]);


        for($r = 0; $r < $this->rLength; $r++) {
            for($c = 0; $c < $this->cLength; $c++) {

                $this->visited = [];

                //echo "visiting: $r+$c: " . $this->grid[$r][$c] . "\n";
                if((!isset($this->visited["$r+$c"]) || !$this->visited["$r+$c"]) && $this->grid[$r][$c] === $this->word[0]) {
                    //echo "current_combination: " .  $this->current_combination . "\n";
                    $this->current_combination .= $this->grid[$r][$c];
                    //echo "current_combination: " .  $this->current_combination . "\n";
                    $this->dfs($r, $c);
                    $this->current_combination = substr($this->current_combination, 0, -1);
                    //echo "pop current_combination: " .  $this->current_combination . "\n";
                }
            }
        }

        return $this->isFound;
    }


    /**
     * 
     * Time Limit Exceeded 85 / 88 testcases passed
     * @param mixed $r
     * @param mixed $c
     * @return void
     */
    function dfs($r, $c)
    {

        if($this->isFound) {
            return;
        }

        if($this->current_combination === $this->word) {
            $this->isFound = true;
            return;
        }

        $this->visited["$r+$c"] = true;

        foreach($this->directions as [$dx, $dy]) {

            $next_r = $r + $dx;
            $next_c = $c + $dy;
            #echo "----dfs visiting next_r next_c: $next_r+$next_c \n";
            if(0 <= $next_r && $next_r < $this->rLength && 0 <= $next_c && $next_c < $this->cLength) {

                //echo "----current_combination: " .  $this->current_combination . "\n";
                $this->current_combination .= $this->grid[$next_r][$next_c];
                //echo "----dfs visiting next_r next_c: $next_r+$next_c | value: " . $this->grid[$next_r][$next_c] . "\n";                
                //echo "----add current_combination: " .  $this->current_combination . "\n";
                    
                if ((!isset($this->visited["$next_r+$next_c"]) || !$this->visited["$next_r+$next_c"]) && str_contains($this->word, $this->current_combination)) {
                    // echo "------dfs visiting next_r next_c: $next_r+$next_c | value: " . $this->grid[$next_r][$next_c] . "\n";
                    $this->dfs($next_r, $next_c);
                    # reset visited on backtrack returning
                    # unset($this->visited["$next_r+$next_c"]);       # Time Limit Exceeded on unset
                    $this->visited["$next_r+$next_c"] = false;
                }
                
                $this->current_combination = substr($this->current_combination, 0, -1);
                // echo "------pop current_combination: " .  $this->current_combination . "\n";
            } 
            
        }
        # reset visited for each cell
        # unset($this->visited["$r+$c"]); # Time Limit Exceeded on unset
        $this->visited["$r+$c"] = false;
    }
}

$board = [["A","B"],["C","D",],["E","F"]];
$word  = "AB";
$solution = new DFSWordSearch();

echo in_array([1,2], [[1,2], [3,4]]);

//echo $solution->exist($board, $word);       # output: true


# C A A
# A A A
# B C D

$board1 = [["C","A","A"],["A","A","A"],["B","C","D"]];
$word1  = "AAB";

//echo $solution->exist($board1, $word1);     # output: true

# A B C E
# S F C S
# A D E E

$board2 = [["A","B","C","E"],["S","F","C","S"],["A","D","E","E"]];
$word2  = "ABCB";

echo $solution->exist($board2, $word2);         # output: true

# A B C E
# S F E S
# A D E E
$board3 = [["A","B","C","E"],["S","F","E","S"],["A","D","E","E"]];
$word3  = "ABCESEEEFS";


//echo $solution->exist($board3, $word3);         # output: true



$board4 = [["A","A","A","A","A","A"],["A","A","A","A","A","A"],["A","A","A","A","A","A"],["A","A","A","A","A","A"],["A","A","A","A","A","A"],["A","A","A","A","A","A"]];
$word4  = "AAAAAAAAAAAAAAa";

#echo $solution->exist($board4, $word4);         # output: true
