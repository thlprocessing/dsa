<?php 

class CourseScheduleII {


    public $n;

    public $graph_edges;

    public $degree;

    public $visited = [];

    public $requireds = [];

    public function BFSKahnSort()
    {

        $deque = [];
        
        for($i = 0; $i < $this->n; $i++) {
            if($this->degree[$i] === 0) {
                array_push($deque, $i);        
            }
        }


        while(!empty($deque)) {

            $i = array_shift($deque);

            $this->requireds[] = $i;
            
            if(isset($this->graph_edges[$i])) {
                foreach($this->graph_edges[$i] as $j) {
                    $this->degree[$j]--;
                    
                    if($this->degree[$j] === 0) {
                        array_push($deque, $j);
                    }
                }
            } 
        }

        return $this->requireds;
    }


    public function DFSSort()
    {
        $requireds = [];

        for($i = 0; $i < $this->n; $i++) {
            if(!$this->visited[$i]) {
                $this->dfs($i, $requireds);
            }
        }

        return array_reverse($requireds);
        
    }

    public function dfs($i, &$requireds)
    {
        $this->visited[$i] = true;

        if(isset($this->graph_edges[$i])) {
            foreach($this->graph_edges[$i] as $j) {
                if(!$this->visited[$j]) {
                    $this->dfs($j, $requireds);
                }
            }
        } 

        $requireds[] = $i;
    }


    /**
     * @param Integer $numCourses
     * @param Integer[][] $prerequisites
     * @return Integer[]
     */
    function findOrder($numCourses, $prerequisites) {

        $this->n = $numCourses;
        $this->degree = array_fill(0, $this->n + 1, 0);
        $this->visited  = array_fill(0, $this->n + 1, false);

        foreach($prerequisites as $edge) {
            
            $u = $edge[1];  # require
            $v = $edge[0];

            
            $this->graph_edges[$u][] = $v;
            $this->degree[$v]++;
        }
        
        $result = $this->BFSKahnSort();

        # cycle detection
        if(count($result) === $this->n) {
            return $result;
        } else {
            return [];
        }
    }

}



#$solution = new TopologicalSort(5, [[0, 1], [0, 2], [3, 2], [1, 4], [2, 4], [4, 5]]);       # 0 3 1 2 4 5

#$result = $solution->BFSKahnSort();     # 0 3 1 2 4 5
#var_dump($result);

#$result1 = $solution->DFSSort();        # 3 0 2 1 4 5
#var_dump($result1);



$solution1 = new TopologicalSort(5, [[1, 3], [1, 2], [3,4], [4,0], [2,0]]);                 # 1 3 2 4 0 

$result2 = $solution1->BFSKahnSort();     # 1 3 2 4 0 
var_dump($result2);

$result3 = $solution1->DFSSort();         # 1 2 3 4 0 
var_dump($result3);
