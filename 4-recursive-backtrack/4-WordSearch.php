<?php

class WordSearch {


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

        $this->visited = [];

        if(!$this->grid) {
            return 0;
        }


        $this->rLength = count($this->grid);
        $this->cLength = count($this->grid[0]);


        for($r = 0; $r < $this->rLength; $r++) {
            for($c = 0; $c < $this->cLength; $c++) {
                echo "visiting: $r+$c: " . $this->grid[$r][$c] . "\n";
                if(!isset($this->visited["$r+$c"]) && $this->grid[$r][$c] === $this->word[0]) {
                    echo "current_combination: " .  $this->current_combination . "\n";
                    $this->current_combination .= $this->grid[$r][$c];
                    echo "current_combination: " .  $this->current_combination . "\n";
                    $this->dfs($r, $c);
                    $this->current_combination = substr($this->current_combination, 0, -1);
                    echo "pop current_combination: " .  $this->current_combination . "\n";
                }
            }
        }

        return $this->isFound;
    }

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

                echo "----current_combination: " .  $this->current_combination . "\n";
                $this->current_combination .= $this->grid[$next_r][$next_c];
                echo "----dfs visiting next_r next_c: $next_r+$next_c | value: " . $this->grid[$next_r][$next_c] . "\n";                
                echo "----add current_combination: " .  $this->current_combination . "\n";

                if(str_contains($this->word, $this->current_combination)) {                    
                    
                    if (!isset($this->visited["$next_r+$next_c"])) {
                        echo "------dfs visiting next_r next_c: $next_r+$next_c | value: " . $this->grid[$next_r][$next_c] . "\n";
                        $this->dfs($next_r, $next_c);
                    }
                }
                
                $this->current_combination = substr($this->current_combination, 0, -1);
                echo "------pop current_combination: " .  $this->current_combination . "\n";
            } 
            
        }
    }
}

$board = [["A","B"],["C","D",],["E","F"]];
$word  = "AB";
$solution = new WordSearch();

echo in_array([1,2], [[1,2], [3,4]]);

//echo $solution->exist($board, $word);       # output: true


# C A A
# A A A
# B C D

$board1 = [["C","A","A"],["A","A","A"],["B","C","D"]];
$word1  = "AAB";

echo $solution->exist($board1, $word1);     # output: true

# A B C E
# S F C S
# A D E E

$board2 = [["A","B","C","E"],["S","F","C","S"],["A","D","E","E"]];
$word2  = "ABCB";

//echo $solution->exist($board2, $word2);         # output: false


