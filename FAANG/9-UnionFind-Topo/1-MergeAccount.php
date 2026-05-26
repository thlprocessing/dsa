<?php

/**
 *  DSU:  cycle detection, connected components, or minimum spanning trees
 */
class MergeAccount {


    public $n;

    /**
     * 
     * Parent Vertex
     * @var array
     */
    public $parent = [];

    public $components = [];

    public $emails_names = [];

    public $ans = [];

    /**
     * @param String[][] $accounts
     * @return String[][]
     */
    function accountsMerge($accounts) {

        # fraud
        // $this->parent = [];
        // $this->components = [];
        // $this->emails_names = [];
        // $this->ans = [];
        
        $this->n      = count($accounts);
        # initial value of its value
        # $this->parent = array_fill(0, $n + 1, -1);

        // for($i = 0; $i < $this->n; $i++) {
        //     $this->parent[$i] = $accounts[$i][0];
        //     echo $accounts[$i][0] . "\n";
        // }


        # var_dump($this->parent);

        for($i = 0; $i < $this->n; $i++) {
            # DSU is for undirected graphs; DFS is for directed graphs ?!
        
            $emailsLength  = count($accounts[$i]);

            # echo $emailsLength . "\n";

            for($j = 1; $j < $emailsLength; $j++) {
                #$this->union($accounts[$i][0], $accounts[$i][$j]);
                $this->parent[$accounts[$i][$j]] = $accounts[$i][$j];
                $this->emails_names[$accounts[$i][$j]] = $accounts[$i][0];
            }
        }

        

        for($i = 0; $i < $this->n; $i++) {
            # DSU is for undirected graphs; DFS is for directed graphs ?!
        
            $emailsLength  = count($accounts[$i]);

            # echo $emailsLength . "\n";

            for($j = 1; $j < $emailsLength; $j++) {
                # echo $accounts[$i][$j] . "\n";
                
                for($k = $j + 1; $k < $emailsLength; $k++) {
                    $this->union($accounts[$i][$j], $accounts[$i][$k]);
                }
                
            }
        }

        $this->connectedComponents();


        $ans = [];

        foreach($this->components as $representative => $_) {
            sort($_);
            $ans[] = array_merge([$this->emails_names[$representative]], $_);
        }

        return $ans;
    }

    public function connectedComponents()
    {
        foreach($this->parent as $component => $_) {
            $root = $this->find($component);
            $this->components[$root][] = $component;
        }

        return $this->components;
    }

    public function query($i, $j)
    {
        return $this->find($i) === $this->find($j);
    }

    /**
     * 
     * @param mixed $i
     * @return int
     */
    public function find($i)
    {
        # base case
        if($i === $this->parent[$i]) {
            return $i;
        }
        ## Path Compression
        # next call on same node: recursion and backtrack set
        return $this->parent[$i] = $this->find($this->parent[$i]);
    }


    public function union($i, $j)
    {
        # find root of the vertex i and j
        $u = $this->find($i);
        $v = $this->find($j);

        if($u !== $v) {
            $this->parent[$v] = $u;            
        } 
    }
}



$solution = new MergeAccount();

$result1 = $solution->accountsMerge([["David","David0@m.co","David1@m.co"],["David","David3@m.co","David4@m.co"],["David","David4@m.co","David5@m.co"],["David","David2@m.co","David3@m.co"],["David","David1@m.co","David2@m.co"]]);
var_dump($result1);

#$result2 =  $solution->accountsMerge([["Gabe","Gabe0@m.co","Gabe3@m.co","Gabe1@m.co"],["Kevin","Kevin3@m.co","Kevin5@m.co","Kevin0@m.co"],["Ethan","Ethan5@m.co","Ethan4@m.co","Ethan0@m.co"],["Hanzo","Hanzo3@m.co","Hanzo1@m.co","Hanzo0@m.co"],["Fern","Fern5@m.co","Fern1@m.co","Fern0@m.co"]]);
#var_dump($result2);

#var_dump($solution->parent);
