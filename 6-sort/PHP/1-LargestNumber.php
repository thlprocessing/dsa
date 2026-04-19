<?php

/**
 * https://leetcode.com/problems/largest-number/description/
 */

class LargestNumber {

    /**
     * @param Integer[] $nums
     * @return String
     */
    function largestNumber($nums) {
        // Convert all numbers to strings for concatenation
        $strNums = array_map('strval', $nums);
        
        // Sort using a custom comparator
        usort($strNums, function($a, $b) {
            // Compare combinations: "a"+"b" vs "b"+"a"
            $order1 = $a . $b;
            $order2 = $b . $a;
            
            // We want descending order: if $order1 > $order2, $a comes before $b
            if ($order1 == $order2) {
                return 0;
            }
            return ($order1 > $order2) ? -1 : 1;
        });
        
        // Edge case: if the array consists of only zeros, the first element will be "0"
        if ($strNums[0] === "0") {
            return "0";
        }
        
        // Concatenate all strings to form the largest number
        return implode("", $strNums);
    }
}