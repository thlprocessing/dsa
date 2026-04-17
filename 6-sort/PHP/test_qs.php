<?php
class QuickSort {
    public $asc = true;
    public function __construct($asc = true) {
        $this->asc = $asc;
    }
    public function setAsc($asc) {
        $this->asc = $asc;
    }
    public function sortArray(&$numbs) {
        $n = count($numbs) - 1;
        $this->quickShort($numbs, 0, $n);
    }
    function quickShort(&$numbs, $start, $end) {
        if ($start >= $end) return;
        $randomPivotK = rand($start, $end);
        $randomPivotValueK = $numbs[$randomPivotK];
        $currentLeft = $start;
        for($i = $start; $i <= $end; $i++) {
            if($this->asc && ($numbs[$i] < $randomPivotValueK)) {
                $this->swap($numbs, $currentLeft, $i);                
                $currentLeft++;
            } else if(!$this->asc && ($numbs[$i] > $randomPivotValueK)) {
                $this->swap($numbs, $currentLeft, $i);                
                $currentLeft++;
            }
        }
        $currentRight = $end;
        for($j = $end; $j >= $start; $j--) {
            if($this->asc && ($numbs[$j] > $randomPivotValueK)) {
                $this->swap($numbs, $currentRight, $j);
                $currentRight--;
            } else if(!$this->asc && ($numbs[$j] < $randomPivotValueK)) { 
                $this->swap($numbs, $currentRight, $j);
                $currentRight--;
            }
        }
        $this->quickShort($numbs, $start, $currentLeft - 1);        
        $this->quickShort($numbs, $currentRight + 1, $end);
    }
    public function swap(&$numbs, $i, $j) {
        $temp = $numbs[$i];
        $numbs[$i] = $numbs[$j];
        $numbs[$j] = $temp;
    }
}
$qs = new QuickSort(false);
$arr = ["00001A", "00001a", "00002b"];
$qs->sortArray($arr);
print_r($arr);
