<?php

class LongestCommonPrefix {

    /**
     * @param String[] $strs
     * @return String
     */
    function longestCommonPrefix($strs)
    {

        $j = 0;

        while(true) {
            for ($i = 0; $i < count($strs); $i++) {
                echo "strlen(\$strs[\$i]): " . strlen($strs[$i]) . "\n";
                if(!isset($strs[$i][$j]) || strlen($strs[$i]) < ($j + 1) || $strs[$i][$j] !== $strs[0][$j] ) {
                    return substr($strs[$i], 0, $j);
                }
            }
            $j++;
        }
    }
}

$solution = new LongestCommonPrefix();
echo $solution->longestCommonPrefix(["flower","flow","flight"]) . "\n";

echo $solution->longestCommonPrefix(["dog","racecar","car"]) . "\n";

echo $solution->longestCommonPrefix(["flower","flower","flower","flower"]) . "\n";