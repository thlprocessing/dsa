<?php

class KClosestPointToOrigin extends SplMaxHeap{

    public $k;

    /**
     * @param Integer[][] $points
     * @param Integer $k
     * @return Integer[][]
     */
    function kClosest($points, $k) {

        $this->k = $k;

        foreach($points as $idx => $point) { 
            
            $this->insert([$idx, $point]);

            # heap size of k and extract smallest element out of the heap    
            if($this->count() > $k) {
                $this->extract();
            }

        }

        $ans = [];

        foreach($this as $value) {
            $ans[] = $value[1];
        }   

        return $ans;
    }

    protected function compare($point1, $point2): int
    {
        
        $distance1 = sqrt(pow($point1[1][0],2) + pow($point1[1][1],2));
        $distance2 = sqrt(pow($point2[1][0],2) + pow($point2[1][1],2));
        
        # SplMaxHeap
        return $distance1 <=> $distance2;
    }
}


$solution = new KClosestPointToOrigin();
$result =  $solution->kClosest([[3,3],[5,-1],[-2,4]], 2);       # [[3,3],[-2,4]]

var_dump($result);


$result1 =  $solution->kClosest([[1,3],[-2,2]], 1);             # [[-2,2]]
var_dump($result1);