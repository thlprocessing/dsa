<?php 

class ValidPalindrome {

    /**
     * TC: O(n)
     * SC: O(1)
     * TC: 3ms Beats 76.98%
     * SC: 21.17 MB Beats 18.87%
     * @param String $s
     * @return Boolean
     */
    function isPalindrome($s)
    {
        
        

        if(strlen($s) < 0) {
            return false;
        }

        $s = preg_replace('/[^a-zA-Z0-9]/', '', $s);
        $s = strtolower($s);

        echo "s: $s \n";

        $left = 0;
        $right = strlen($s) - 1;

        while($left < $right) {
            if($s[$left] !== $s[$right]) {
                return false;
            }

            $left  += 1;
            $right -= 1;
        }

        return true;

    } 
}

$solution = new ValidPalindrome();
echo (bool) $solution->isPalindrome("A man, a plan, a canal: Panama") . "\n";
echo (bool) $solution->isPalindrome("race a car") . "\n";