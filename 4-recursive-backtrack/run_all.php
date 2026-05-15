<?php
require_once "4-BFSWordSearch.php";

$solution = new BFSWordSearch();
$cases = [
    [ [["A","B"],["C","D",],["E","F"]], "AB", true ],
    [ [["C","A","A"],["A","A","A"],["B","C","D"]], "AAB", true ],
    [ [["A","B","C","E"],["S","F","C","S"],["A","D","E","E"]], "ABCB", false ],
    [ [["A","B","C","E"],["S","F","E","S"],["A","D","E","E"]], "ABCESEEEFS", true ],
    [ [["A","A","A","A","A","A"],["A","A","A","A","A","A"],["A","A","A","A","A","A"],["A","A","A","A","A","A"],["A","A","A","A","A","A"],["A","A","A","A","A","A"]], "AAAAAAAAAAAAAAa", false ],
    [ [["A","B","C","E"],["S","F","C","S"],["A","D","E","E"]], "ABCCED", true ],
    [ [["a","a","a","a"],["a","a","a","a"],["a","a","a","a"]], "aaaaaaaaaaaaa", false ],
    [ [["a","a","b","a","a","b"],["a","a","b","b","b","a"],["a","a","a","a","b","a"],["b","a","b","b","a","b"],["a","b","b","a","b","a"],["b","a","a","a","a","b"]], "aaaaaaaaaaaaa", false ]
];

foreach($cases as $i => [$board, $word, $expected]) {
    $res = $solution->exist($board, $word);
    echo "Case " . ($i+1) . " - Expected: " . ($expected ? 'true' : 'false') . ", Got: " . ($res ? 'true' : 'false') . "\n";
}
