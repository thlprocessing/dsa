<?php

class BinarySearchMatrix extends SplMinHeap {

    public $k;

    /**
     * TC: N^2*logK
     * TC: 110ms Beats 33.33%
     * @param Integer[][] $matrix
     * @param Integer $k
     * @return Integer
     */
    function kthSmallest($matrix, $k) {

        $this->k = $k;
        # n
        foreach($matrix as $idx => $points) { 
            # n
            foreach($points as $idx_pt => $point) {

                # log k
                $this->insert([$idx, $idx_pt, $point]);
                
                if($this->count() > $k) {
                    
                    $this->extract();
                }
            }

        }


        $result = $this->top();

        return $matrix[$result[0]][$result[1]];
    }


    /**
     *   # [[1,2],[1,3]     
     *   # #######
     *   # 1 2
     *   # 1 3
     *   # unsorted matrix
     *   # 1 1 2 4
     *   # -> sorted matrix when inserting
     * @param Integer[][] $matrix
     * @param Integer $k
     * @return Integer
     */
    function kthSmallestWrong($matrix, $k) {

        $this->k = $k;

        $count = 0;

        foreach($matrix as $idx => $points) { 

            foreach($points as $idx_pt => $point) {

                $count++;
                
                if($count === $k) {
                    return $matrix[$idx][$idx_pt];
                }
            }

        }

    }

    /**
     *   # [[1,2],[1,3]     
     *   # #######
     *   # 1 2
     *   # 1 3
     *   # unsorted matrix
     *   # 1 1 2 4
     *   # -> sorted matrix when inserting
     * @param Integer[][] $matrix
     * @param Integer $k
     * @return Integer
     */
    function kthSmallestWrong2(array $matrix, int $k){

        $n = count($matrix);
        echo "n: $n \n";
        if ($n <= 0) {
            throw new InvalidArgumentException("Matrix size n must be positive.");
        }

        // if ($k < 0 || $k >= $n * $n) {
        //     throw new OutOfBoundsException("Index k is out of range for 0-based indexing.");
        // }

        // Calculate row and column (0-based)
        $modCol = ($k % $n);
        $col    = $modCol > 0 ? $modCol - 1 : $modCol;
        
        $divRow = intdiv($k, $n);
        $row    = $divRow === 1 && $modCol === 0 ? 0 : $divRow ;
        #$row = intdiv($k, $n);
            
        echo "divRow: $divRow row: $row | modCol: $modCol $col: col  \n";

        return $matrix[$row][$col];
    }

    
    public function binarySearchMaxtrix(array $matrix, int $target)
    {
        $r    = count($matrix);
        $c    = count($matrix[0]);

        $left = 0;
        $right = ($r * $c) - 1;

        while($left <= $right) {


            echo "r: $r | c: $c| left: $left| right: $right \n";            

            $ptr_idx    = floor($left + ($right - $left) / 2);
            $ptr_row    = intdiv($ptr_idx, $r);
            $ptr_col    = $ptr_idx % $c;

            echo "ptr_idx: $ptr_idx| ptr_row: $ptr_row | ptr_col: $ptr_col \n";

            $ptr_value  = $matrix[$ptr_row][$ptr_col];
            
            echo "ptr_value: $ptr_value \n";

            if($ptr_value === $target) {
                return true;
            } else {
                if($target < $ptr_value) {
                    $right = $ptr_idx - 1; 
                } else {
                    $left  = $ptr_idx + 1;
                }
            }
        }

        return false;

    }
    
    /**
     * 
     * TC: 1ms Beats 83.33%
     * SC: Memory 23.45 MB Beats 83.33%
     * @param array $matrix
     * @param int $k
     */
    public function kthSmallestBinarySearch(array $matrix, int $k)
    {
        #$r      = count($matrix);
        #$c      = count($matrix[0]);

        #$left   = 0;
        #$right  = ($r * $c) - 1;

        $n       = count($matrix);
        $lower   = $matrix[0][0];
        $higher  = $matrix[$n - 1][$n - 1]; 
        

        while($lower < $higher) {


            # $ptr_idx    = floor($left + ($right - $left) / 2);
            # $ptr_row    = intdiv($ptr_idx, $r);
            # $ptr_col    = $ptr_idx % $c;
            # $ptr_value  = $matrix[$ptr_row][$ptr_col];

            $count      = 0;
            $mid_value  = floor($lower + ($higher - $lower) / 2);
            $row        = $n - 1;
            $col        = 0;

            $smaller    = $matrix[0][0];
            $larger     = $matrix[$n - 1][$n - 1]; 

            echo "before: lower: $lower | higher: $higher | mid_value: $mid_value \n";

            while($row >= 0 && $col < $n) {

                echo "--before: lower: $lower | higher: $higher | row: $row| col: $col| smaller: $smaller| larger: $larger \n";
                echo "--before: matrix[row][col] > mid_value: " . $matrix[$row][$col] . " > " .  " $mid_value \n";

                if($matrix[$row][$col] > $mid_value) {
                    
                    $larger  = min($larger, $matrix[$row][$col]);
                    $row    -= 1;

                } 
                # $matrix[$row][$col] < $mid_value
                else {
                    $smaller  = max($smaller, $matrix[$row][$col]);
                    $count   += $row + 1;
                    $col     += 1;
                }
                
                echo "--after: lower: $lower | higher: $higher | row: $row| col: $col| smaller: $smaller| larger: $larger| count: $count \n\n";
            }
        


            if($count === $k) {
                return $smaller;
            } else {
                if($k < $count) {
                    $higher = $smaller; 
                } else {
                    $lower  = $larger;
                }
            }


            echo "after: lower: $lower | higher: $higher \n\n\n\n";
            
        }

        return $lower;

    }

    /**
     * 
     * RT: 28 ms Beats 66.67%
     * SC: 23.06 MB Beats 83.33%
     * @param array $matrix
     * @param int $k
     */
    public function kthSmallestHeap(array $matrix, int $k)
    {
        $n = count($matrix);
        
        foreach(range(0, min($k, $n) - 1) as $r) {
            
            echo "foreach: " . min($k, $n) . " n: $n | k: $k, r: $r "  . " \n";

            $this->insert([$matrix[$r][0], $r, 0]);
        }



        while($k > 0 ){
            
            [$val, $r, $c] = $this->extract();

            echo "while: val: $val | r: $r | c: $c ------ n: $n | k: $k "  . " \n";

            if($c < ($n - 1)) {
                echo "inserting: " . $c + 1 . " \n";
                $this->insert([$matrix[$r][$c + 1], $r, $c + 1]);
            }

            $k--;
        }

        return $val;
    }


    
    public function kthSmallestQueue(array $matrix, int $k)
    {
        $n = count($matrix);
        $deque = [];
        
        foreach(range(0, min($k, $n) - 1) as $r) {
            
            echo "foreach: " . min($k, $n) . " n: $n | k: $k, r: $r "  . " \n";

            #$this->insert([$matrix[$r][0], $r, 0]);
            $deque[] = [$matrix[$r][0], $r, 0];
        }

        #var_dump($deque);

        while($k > 0 ){


            [$val, $r, $c] = array_shift($deque);

            echo "while: val: $val | r: $r | c: $c ------ n: $n | k: $k "  . " \n";

            if($c < ($n - 1)) {
                echo "inserting: " . $c + 1 . " \n";
                #$this->insert([$matrix[$r][$c + 1], $r, $c + 1]);
                array_unshift($deque, [$matrix[$r][$c + 1], $r, $c + 1]);
            }

            $k--;
        }

        return $val;
    }


    public function kthSmallest(array $matrix, int $k)
    {
        $r    = count($matrix);
        $c    = count($matrix[0]);

        $left = 0;
        $right = ($r * $c) - 1;

        while($left <= $right) {


            echo "r: $r | c: $c| left: $left| right: $right \n";            

            $ptr_idx    = floor($left + ($right - $left) / 2);
            $ptr_row    = intdiv($ptr_idx, $r);
            $ptr_col    = $ptr_idx % $c;

            echo "ptr_idx: $ptr_idx| ptr_row: $ptr_row | ptr_col: $ptr_col \n";

            $ptr_value  = $matrix[$ptr_row][$ptr_col];
            
            echo "ptr_value: $ptr_value | k: $k \n";

            if($ptr_idx === $k) {
                return $ptr_value;
            } else {
                if($k < $ptr_idx) {
                    $right = $ptr_idx - 1; 
                } else {
                    $left  = $ptr_idx + 1;
                }
            }
        }

        return false;

    }

}


$solution = new BinarySearchMatrix();

# [[1,2],[1,3]]
# 1 1 2 4
# #######
# 1 2
# 1 3

# 1 5 9 10 11 12 13 13 15
#    ########
# 0: 1   5  9
# 1: 10 11 13   
# 2: 12 13 15
#echo $solution->binarySearchMaxtrix([[1,5,9],[10,11,13],[12,13,15]], 0) . "\n";


#$result =  $solution->kthSmallestBinarySearch([[1,5,9],[10,11,13],[12,13,15]], 8);
#var_dump($result);


#$result =  $solution->kthSmallestHeap([[1,5,9],[10,11,13],[12,13,15]], 8);
#var_dump($result);


$result =  $solution->kthSmallest([[1,5,9],[10,11,13],[12,13,15]], 8);
var_dump($result);