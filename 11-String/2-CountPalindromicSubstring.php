<?php

class CountPalindromicSubstring {
    
    /**
     * TC: O(N^2)
     * SC: O(1)
     * 
     * TC: 1312 ms Beats 28.83%
     * SC: 20.16 MB Beats 93.69%
     * @param String $s
     * @return String
     */
    function countSubstrings($s) {
       
        
        $strLength = strlen($s);

        $expanding_left     = 0;
        $expanding_right    = 0;
        $count              = 0;

        $expanding = function($l, $r) use(&$expanding_left, &$expanding_right, $s, $strLength, &$count) {
            
            while($l >= 0 && $r < $strLength) {
            
                if($s[$l] !== $s[$r]) {
                    return false;
                }

                $count++;
                
                # new palindrome length: $r - $l
                # old palindrome length: $expanding_right - $expanding_left
                if($r - $l > $expanding_right - $expanding_left) {
                    $expanding_right = $r;
                    $expanding_left  = $l;
                    
                }

                $l -= 1;
                $r += 1;
            }

        };

        for($i = 0; $i < $strLength; $i++) {
            $expanding($i, $i);
            $expanding($i, $i + 1);  
        }
           

        return $count;
    }
}



$solution = new CountPalindromicSubstring();
echo $solution->countSubstrings("aaa") . "\n";    # 6

echo $solution->countSubstrings("abc") . "\n";    # 3