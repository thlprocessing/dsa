<?php

class MostStonesRemovedWithSameRowOrColumn {

    public $n;

    public $parent = [];


    public function removeStones($stones) {

        $this->n = count($stones);
        $this->parent = array_fill(0, $this->n, -1);

        for($i = 0; $i < $this->n; $i++) {
            for($j = $i + 1; $j < $this->n; $j++) {

                echo "stones[i:$i][0]: " . $stones[$i][0] . "\n";    
                echo "stones[j:$j][0]: " . $stones[$j][0] . "\n";

                echo "stones[i:$i][1]: " . $stones[$i][1] . "\n";    
                echo "stones[j:$j][1]: " . $stones[$j][1] . "\n";

                if ($stones[$i][0] == $stones[$j][0] || $stones[$i][1] == $stones[$j][1]) {

                    echo "(i:j) ($i:$j) \n";

                    $u = $this->find($i);
                    $v = $this->find($j);

                    echo "(u:v) ($u:$v) \n";
                    
                    if ($u != $v) {
                        $this->union($u,$v);
                    }
                }
            }
        }
        
        // foreach($stones as $stone) {
        //     $this->add($stone[0], $stone[1]);
        // }

        $result = 0;
        for($i = 0; $i < $this->n; $i++) {
            if ($this->parent[$i] !== - 1) {
                $result++;
            }
        }

        return $result;
    }

    public function add($i, $j)
    {
        #echo "adding: i: $i, j: $j \n";

        $u = $this->find($i);
        $v = $this->find($j);

        #echo "-- after find: i: $i, j: $j, u: $u, v: $v \n";

        if($u !== $v) {
            $this->union($u, $v);
        }

        #echo "------ union parent: " . implode(",", $this->parent) . "\n";
    }

    public function query($i, $j)
    {
        return $this->find($i) === $this->find($j);
    }

    public function find($i) 
    {

        $root = $i;

        while($this->parent[$root] !== -1)
        {
            #echo "--finding: i: $i | parent[$i]: " . $this->parent[$i] . "\n";
            $root = $this->parent[$root];
        }
        
        #echo "--finding: i: $i " . "\n";

        while($i !== $root) {
            $u = $this->parent[$i];
            $this->parent[$i] = $root;
            $i = $u;
        }

        return $root;
    }

    public function union($i, $j)
    {
        #echo "----union: i: $i, j: $j \n";
        #echo "----parent[$j] = $i \n";
        $this->parent[$j] = $i;
    }
}



# https://leetcode.com/problems/most-stones-removed-with-same-row-or-column/

#       (1,2)  (2,2)

# (0,1)        (2,1)

# (0,0) (1,0)  


# ---


# (0,0)  (0,1)
#
# (1,0)          (1,2)
#
#        (2,1)   (2,2)
                

# [2,2] because it shares the same row      as [2,1]
# [2,1] because it shares the same column   as [0,1]
# [1,2] because it shares the same row      as [1,0]
# [1,0] because it shares the same column   as [0,0]
# [0,1] because it shares the same row      as [0,0]

# 0 -> 1  -> 2 
# 0 <- 1  <- 2 

$solution = new MostStonesRemovedWithSameRowOrColumn();

echo "result: " . $solution->removeStones([[0,0],[0,1],[1,0],[1,2],[2,1],[2,2]]) . "\n";


var_dump($solution->parent);
