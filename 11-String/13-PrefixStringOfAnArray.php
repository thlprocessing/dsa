<?php

class PrefixStringOfAnArray {
    

    /**
     * @param String $s
     * @param String[] $words
     * @return Boolean
     */
    function isPrefixString($s, $words) {
        

        $sub = "";
        $length = count($words);
        for($i = 0; $i < $length; $i++) {
            $sub .= $words[$i];
            
            if(strlen($sub) >= strlen($s) && str_contains($s, $sub)) {
                return true;
            }
        }

        return false;
    }

}

$solution = new PrefixStringOfAnArray();
echo $solution->isPrefixString("iloveleetcode", ["i","love","leetcode","apples"]);