<?php

/**
 * 
 * Shortest path
 */
class BFSWordSearch
{

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
        $this->isFound = false;

        if(!$this->grid) {
            return 0;
        }

        $this->rLength = count($this->grid);
        $this->cLength = count($this->grid[0]);

        # Early exit: word longer than total cells — impossible without revisiting
        if(strlen($this->word) > $this->rLength * $this->cLength) {
            return false;
        }


        for($r = 0; $r < $this->rLength; $r++) {
            for($c = 0; $c < $this->cLength; $c++) {

                #$this->visited = [];
                #$this->current_combination = "";

                $visited             = [];
                $current_combination = "";

                #echo "52 r: $r c: $c | value: " . $this->grid[$r][$c] . "\n";
                if((!isset($visited["$r+$c"]) || !$visited["$r+$c"]) && $this->grid[$r][$c] === $this->word[0]) {

                    #$this->current_combination .= $this->grid[$r][$c];
                    # current_node: ad neighbor nodes and add to visited
                    $this->bfs($r, $c, $current_combination, $visited);
                    #$this->current_combination = substr($this->current_combination, 0, -1);
                }
            }
        }

        return $this->isFound;
    }

    /**
     * 
     * Runtime: 147 ms
     * Memory: 39.91 MB
     * @param mixed $r
     * @param mixed $c
     * @return void
     */
    public function bfs($r, $c, $current_combination, $visited)
    {

       #echo "77 r: $r c: $c | value: " . $this->grid[$r][$c] . "\n";
       # echo "78 ----current_combination: " .  $current_combination . "\n";

        $visited["$r+$c"] = true;
        $current_combination .= $this->grid[$r][$c];

        if($this->isFound) {
        #    echo "isFound Return r: $r c: $c | value: " . $this->grid[$r][$c] . "\n";
            return;
        }
        

        $deque = [];
        array_push($deque, [$r, $c, $current_combination, $visited]);

        while(!empty($deque)) {

            [$r, $c, $current_combination, $visited] = array_shift($deque);

            if($this->isFound) {
                #echo "isFound Return r: $r c: $c | value: " . $this->grid[$r][$c] . "\n";
                break;
            }
            #echo "current_combination: $current_combination | word: " . $this->word . "\n";
            if($current_combination === $this->word) {

                echo "isFound r: $r c: $c | value: " . $this->grid[$r][$c] . "\n";
                $this->isFound = true;
                break;
            }
            
            #echo "103 r: $r c: $c | value: " . $this->grid[$r][$c] . "\n";
            #echo "104 ----current_combination: " .  $current_combination . "\n";

            foreach($this->directions as [$dx, $dy]) {

                $next_r = $r + $dx;
                $next_c = $c + $dy;

                if(0 <= $next_r && $next_r < $this->rLength && 0 <= $next_c && $next_c < $this->cLength) {


                    
                    $current_combination .= $this->grid[$next_r][$next_c];
                    #echo "----dfs visiting next_r next_c(r: $r, c: $c): $next_r+$next_c | value: " . $this->grid[$next_r][$next_c] . "\n";                
                    #echo "----add current_combination: " .  $current_combination . "\n";
                    if($next_r === 1 && $next_c === 2 && $r === 2 && $c === 2) {
                        #var_dump($visited);
                     #   echo !isset($visited["$next_r+$next_c"]) . "\n";
                     #   echo str_starts_with($this->word, $current_combination) . "\n";
                    }
                    
                    # navigate next possible
                    if ((!isset($visited["$next_r+$next_c"]) || !$visited["$next_r+$next_c"]) && str_starts_with($this->word, $current_combination)) {

                        $visited["$next_r+$next_c"] = true;

                        # add ad into queue for next ad
                        array_push($deque, [$next_r, $next_c, $current_combination, $visited]);

                        # backtrack local visited — only reset what we just set
                        $visited["$next_r+$next_c"] = false;
                    }

                    # backtrack on return
                    $current_combination = substr($current_combination, 0, -1);
                    #echo "----backtrack current_combination: " .  $current_combination . "\n";
                    
                    
                    
                }          
            }
        }

        $visited["$r+$c"] = false;
        $current_combination = substr($current_combination, 0, -1);   
    }
}

$board = [["A","B"],["C","D",],["E","F"]];
$word  = "AB";
$solution = new BFSWordSearch();

#echo in_array([1,2], [[1,2], [3,4]]);

#echo $solution->exist($board, $word) . "\n";       # output: true


# C A A
# A A A
# B C D

$board1 = [["C","A","A"],["A","A","A"],["B","C","D"]];
$word1  = "AAB";

#echo (bool) $solution->exist($board1, $word1) . "\n";     # output: true

# A B C E
# S F C S
# A D E E

$board2 = [["A","B","C","E"],["S","F","C","S"],["A","D","E","E"]];
$word2  = "ABCB";

#echo (bool) $solution->exist($board2, $word2) . "\n";         # output: true

# A B C E
# S F E S
# A D E E
$board3 = [["A","B","C","E"],["S","F","E","S"],["A","D","E","E"]];
$word3  = "ABCESEEEFS";


#echo (bool) $solution->exist($board3, $word3) . "\n";         # output: true



$board4 = [["A","A","A","A","A","A"],["A","A","A","A","A","A"],["A","A","A","A","A","A"],["A","A","A","A","A","A"],["A","A","A","A","A","A"],["A","A","A","A","A","A"]];
$word4  = "AAAAAAAAAAAAAAa";

#echo (bool) $solution->exist($board4, $word4) . "\n";         # output: true


$board5 = [["A","B","C","E"],["S","F","C","S"],["A","D","E","E"]];
$word5  = "ABCCED";

# A B C E
# S F C S
# A D E E

#echo "board5: " . (bool) $solution->exist($board5, $word5) . "\n";         # output: true


$board6 = [["C","A","A"],["A","A","A"],["B","C","D"]];
$word6  = "AAB";

# C A A
# A A A
# B C D

#echo "board6: " . (bool) $solution->exist($board6, $word6) . "\n";         # output: true



$board7 = [["A","B","C","E"],["S","F","E","S"],["A","D","E","E"]];
$word7  = "ABCB";

# A B C E
# S F E S
# A D E E

#echo "board7: " . (bool) $solution->exist($board7, $word7) . "\n";         # output: true

$board8 = [["a","a","a","a"],["a","a","a","a"],["a","a","a","a"]];
$word8  = "aaaaaaaaaaaaa"; 

#echo "board8: " . (bool) $solution->exist($board8, $word8) . "\n";          # output: false


$board9 = [["a","a","b","a","a","b"],["a","a","b","b","b","a"],["a","a","a","a","b","a"],["b","a","b","b","a","b"],["a","b","b","a","b","a"],["b","a","a","a","a","b"]];
$word9  = "aaaaaaaaaaaaa";

echo "board9: " . (bool) $solution->exist($board9, $word9) . "\n";          # output: false