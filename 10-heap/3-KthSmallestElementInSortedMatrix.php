<?php

class KthSmallestElementInSortedMatrix extends SplMaxHeap {

    public $k;

    /**
     * TC: N^2*logK
     * @param Integer[][] $matrix
     * @param Integer $k
     * @return Integer
     */
    function kthSmallestOld($matrix, $k) {

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


    protected function compare($point1, $point2): int
    {
        
        # SplMaxHeap
        return $point1[2] <=> $point2[2];
    }


    function kthSmallest(array $matrix, int $k){

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

}


$solution = new KthSmallestElementInSortedMatrix();




//  # 1 5 9 10 11 12 13 13 15
// $result1 =  $solution->kthSmallest([[1,5,9],[10,11,13],[12,13,15]], 8);       # 13
// var_dump($result1);

// # 1 1 2 3
// # 1 2
// # 1 3
// $result =  $solution->kthSmallest([[1,2],[1,3]], 3);       # 2
// var_dump($result);
// // [0, 0, 1]
// // [0, 1, 2]
// // [1, 0, 1]
// // [1, 1, 3]



// $result2 =  $solution->kthSmallest([[-5]], 1);       # -5
// var_dump($result2);

# 1 5 9 10 11 12 13 13 15
#    ########
# 0: 1   5  9
# 1: 10 11 13   
# 2: 12 13 15
echo $solution->binarySearchMaxtrix([[1,5,9],[10,11,13],[12,13,15]], 1) . "\n";