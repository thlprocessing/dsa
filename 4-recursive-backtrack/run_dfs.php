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
            $stack = [];
            $bitmask = 1 << ($r * $cLength + $c);
            $stack[] = [$r, $c, 1, $bitmask];
            
            while(!empty($stack)) {
                [$curr_r, $curr_c, $len, $mask] = array_pop($stack);
                if($len === strlen($word)) {
                    $isFound = true;
                    break 3;
                }
                
                foreach($directions as [$dx, $dy]) {
                    $nr = $curr_r + $dx;
                    $nc = $curr_c + $dy;
                    if($nr >= 0 && $nr < $rLength && $nc >= 0 && $nc < $cLength) {
                        if($board[$nr][$nc] === $word[$len]) {
                            $bit = 1 << ($nr * $cLength + $nc);
                            if(($mask & $bit) === 0) {
                                $stack[] = [$nr, $nc, $len + 1, $mask | $bit];
                            }
                        }
                    }
                }
            }
        }
    }
}
echo "Found: " . ($isFound ? "true" : "false") . "\n";
