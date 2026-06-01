<?php

class BinarySearchMatrix extends SplMaxHeap {

    public $k;
    
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
    
    public function kthSmallest(array $matrix, int $k)
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

}


$solution = new BinarySearchMatrix();


# 1 5 9 10 11 12 13 13 15
#    ########
# 0: 1   5  9
# 1: 10 11 13   
# 2: 12 13 15
#echo $solution->binarySearchMaxtrix([[1,5,9],[10,11,13],[12,13,15]], 0) . "\n";


$result =  $solution->kthSmallest([[1,5,9],[10,11,13],[12,13,15]], 8);
var_dump($result);