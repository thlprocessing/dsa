<?php 

class Palindrome {

    /**
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
            $x = $x / 10;
            array_push($digits, $next_digit);
        }


        $left = 0;
        $right = count($digits) - 1;

        

    } 
}