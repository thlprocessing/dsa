<?php

class LongestPalindromeSubString {

    public $dp = [];

    function isPalindrome($s, $left, $right)
    {
        
        while($left < $right) {
            if($s[$left] !== $s[$right]) {
                return false;
            }

            $left  += 1;
            $right -= 1;
        }

        return true;

    }

    /**
     * TC: O(N^3)
     * SC: O(1)
     * 
     * TC: 1312 ms Beats 28.83%
     * SC: 20.16 MB Beats 93.69%
     * @param String $s
     * @return String
     */
    function longestPalindromeBruteForce($s) {
        
        $strLength = strlen($s) - 1;

        for($right = $strLength; $right > 0; $right--) {
            for($left = 0; $left <= $strLength - $right; $left++) {
                if($this->isPalindrome($s, $left, $left + $right)) {
                    return substr($s, $left, $right + 1);
                }
            }
        }

        return strlen($s) > 0 ? $s[0] : "";
    }

    /**
     * 
     * TC: 2325 ms Beats 16.22%
     * SC: 43.65 MB Beats 5.41%
     * @param mixed $s
     */
    function longestPalindromeDP($s) {
        
        $this->dp = [];

        $strLength = strlen($s) - 1;
        echo "strLength: $strLength \n ";

        for($right = $strLength; $right > 0; $right--) {
            for($left = 0; $left <= $strLength - $right; $left++) {

                echo "right: $right | left: $left \n";
                # the array writes and lookups only add overhead:
                # - Nested Hash Map Operations: PHP arrays are ordered hash maps. Checking isset() and writing to a nested array ($this->dp[$left][...]) requires hashing the keys and allocating memory dynamically on every step.
                # - Memory Allocation: Building a large 2D array of size up to $N \times N$ consumes significant memory, which PHP has to allocate, manage, and garbage collect when the function exits.


                # In programming, overhead refers to any extra resources (time, memory, CPU cycles) that a program consumes to perform a task, which do not contribute directly to solving the core problem.
                # - Here is a real-world analogy: Mailing a Letter
                #   - The Core Task: Reading the actual message written on the paper.
                #   - The Overhead: Folding the paper, putting it in an envelope, writing the address, buying a stamp, walking to the mailbox, and the post office sorting/delivering it.
                #   - All of the envelope, stamp, and sorting work is overhead—you need them to manage the delivery, but they don't change or contribute to the message inside.
                # - For finding the longest palindrome, the core task is comparing characters (e.g., checking if s[i] == s[j]).
                # - The overhead in your DP version is the code managing the cache:  
                #   - 1. CPU Overhead (Hashing): PHP arrays are not simple blocks of memory; they are Hash Tables. When you write $this->dp[$left][$right], the computer has to run a mathematical algorithm (hash function) to find where to store this value in memory. Doing this thousands of times takes extra CPU time.
                #   - 2. Memory Overhead (Allocation): Every time you add a new entry to the array, the computer has to ask the operating system for more RAM to store it.
                #   - 3. Garbage Collection Overhead: When the function finishes, PHP has to spend time cleaning up all that allocated memory to free it up for the rest of your computer.
                #
                if(!isset($this->dp[$left][$left + $right])) {
                    $this->dp[$left][$left + $right] = $this->isPalindrome($s, $left, $left + $right);
                }
                
                if($this->dp[$left][$left + $right]) {
                    return substr($s, $left, $right + 1);
                }
            }
        }

        return strlen($s) > 0 ? $s[0] : "";
    }

     /**
      * TC: 215 ms Beats 37.84%
      * SC: 20.29 MB Beats 87.39%
      * Summary of longestPalindrome
      * @param mixed $s
      * @return string
      */
     function longestPalindrome($s) {
        
        $strLength = strlen($s);

        $expanding_left     = 0;
        $expanding_right    = 0;


        $expanding = function($l, $r) use(&$expanding_left, &$expanding_right, $s, $strLength) {
            
            while($l >= 0 && $r < $strLength) {

                if($s[$l] !== $s[$r]) {
                    return false;
                }
                
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

        return substr($s, $expanding_left, $expanding_right - $expanding_left + 1);
     }


}

$solution = new LongestPalindromeSubString();
#echo $solution->longestPalindromeBruteForce("babad") . "\n";    # "bab" or "aba"
#echo $solution->longestPalindromeBruteForce("cbbd") . "\n";     # "bb"

#echo $solution->longestPalindromeDP("babad") . "\n";    # "bab" or "aba"
#echo $solution->longestPalindromeDP("cbbd") . "\n";     # "bb"


#echo $solution->longestPalindrome("babad") . "\n";    # "bab" or "aba"

echo $solution->longestPalindrome("cbbd") . "\n";    # "bb"
