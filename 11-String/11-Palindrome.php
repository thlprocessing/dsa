<?php 

# substring: "wke"
# subsequence: "pwke" and is not a substring
# A substring is a contiguous sequence of characters within the string.
class Palindrome {

    /**
     * 
     * TC: O(Log_10 of X)
     * SC: O(Log_10 of X)
     * chuyen so thanh string bang cach chia 10 lien tuc
     * Sau khi chuyen thanh string roi, check palindrome
     */

    public function isPalindrome($x)
    {
        if($x < 0) {
            return false;
        }

        $digits = [];

        while($x > 0) {
            $next_digit = $x % 10;
            $x = (int) ($x / 10);
            array_push($digits, $next_digit);
        }

        $left = 0;
        $right = count($digits) - 1;

        while($left < $right) {
            if($digits[$left] !== $digits[$right]) {
                return false;
            }

            $left  += 1;
            $right -= 1;
        }

        return true;

    } 
}

$solution = new Palindrome();
echo (bool) $solution->isPalindrome(121) . "\n";
echo (bool) $solution->isPalindrome(-121) . "\n";