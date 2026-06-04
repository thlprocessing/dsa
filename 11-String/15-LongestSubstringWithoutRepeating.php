<?php

class LongestSubstringWithoutRepeating {

    /**
     * @param String $s
     * @return Integer
     */
    function lengthOfLongestSubstring($s) {
        $counter = [];
        $l = 0;
        $ans = 0;
        $n = strlen($s);
        
        for ($r = 0; $r < $n; $r++) {
            $char = $s[$r];
            
            // Khởi tạo mảng đếm nếu ký tự chưa tồn tại
            if (!isset($counter[$char])) {
                $counter[$char] = 0;
            }
            $counter[$char]++;
            
            // Nếu ký tự xuất hiện > 1 lần, thu nhỏ cửa sổ từ bên trái
            while ($counter[$char] > 1) {
                $leftChar = $s[$l];
                $counter[$leftChar]--;
                $l++;
            }
            
            $ans = max($ans, $r - $l + 1);
        }
        
        return $ans;
    }
}

$solution = new LongestSubstringWithoutRepeating();

echo $solution->lengthOfLongestSubstring("abcabcbb") . "\n" ; # 3

echo $solution->lengthOfLongestSubstring("bbbbb")   . "\n" ; # 1

# substring: "wke"
# subsequence: "pwke" and is not a substring
# A substring is a contiguous sequence of characters within the string.

echo $solution->lengthOfLongestSubstring("pwwkew")   . "\n" ; # 3