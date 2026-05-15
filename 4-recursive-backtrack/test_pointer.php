<?php
$board = [["a","a","b","a","a","b"],["a","a","b","b","b","a"],["a","a","a","a","b","a"],["b","a","b","b","a","b"],["a","b","b","a","b","a"],["b","a","a","a","a","b"]];
$word = "aaaaaaaaaaaaa";

$rLength = count($board);
$cLength = count($board[0]);
$directions = [[-1, 0], [1, 0], [0, -1], [0, 1]];

$isFound = false;
for($r=0; $r<$rLength; $r++) {
    for($c=0; $c<$cLength; $c++) {
        if($board[$r][$c] === $word[0]) {
            $deque = [];
            $visited = ["$r+$c" => true];
            $current_combination = $board[$r][$c];
            $deque[] = [$r, $c, $current_combination, $visited];
            $head = 0;
            
            while($head < count($deque)) {
                [$curr_r, $curr_c, $current_combination, $visited] = $deque[$head++];
                if($current_combination === $word) {
                    $isFound = true;
                    break 3;
                }
                
                foreach($directions as [$dx, $dy]) {
                    $next_r = $curr_r + $dx;
                    $next_c = $curr_c + $dy;
                    if(0 <= $next_r && $next_r < $rLength && 0 <= $next_c && $next_c < $cLength) {
                        $current_combination .= $board[$next_r][$next_c];
                        if (!isset($visited["$next_r+$next_c"]) && str_starts_with($word, $current_combination)) {
                            $visited["$next_r+$next_c"] = true;
                            $deque[] = [$next_r, $next_c, $current_combination, $visited];
                            unset($visited["$next_r+$next_c"]);
                        }
                        $current_combination = substr($current_combination, 0, -1);
                    }
                }
            }
        }
    }
}
echo "Found: " . ($isFound ? "true" : "false") . "\n";
