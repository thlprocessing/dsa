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
     * RT: 83ms Beats 100.00%
     * Memory: 25.00MB Beats 100.00%
     * @param String[][] $accounts
     * @return String[][]
     */
    function accountsMerge($accounts) {
        
        $this->parent = [];
        $this->components = [];
        $this->emails_names = [];
        $this->ans = [];
        
        $this->n      = count($accounts);

        for($i = 0; $i < $this->n; $i++) {
    
            $emailsLength  = count($accounts[$i]);

            for($j = 1; $j < $emailsLength; $j++) {
                $this->parent[$accounts[$i][$j]] = $accounts[$i][$j];
                $this->emails_names[$accounts[$i][$j]] = $accounts[$i][0];
            }
        }

        

        for($i = 0; $i < $this->n; $i++) {
        
            $emailsLength  = count($accounts[$i]);

            for($j = 1; $j < $emailsLength; $j++) {
                
                for($k = $j + 1; $k < $emailsLength; $k++) {

                    $this->union($accounts[$i][$j], $accounts[$i][$k]);
                }
                
            }
        }

        $this->connectComponents();


        $ans = [];

        foreach($this->components as $representative => $_) {
            sort($_);
            $ans[] = array_merge([$this->emails_names[$representative]], $_);
        }

        return $ans;
    }

    public function connectComponents()
    {

        foreach($this->parent as $component => $_) {
            $representative = $this->find($component);
            $this->components[$representative][] = $component;
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
    
        $root = $i;

        # node is its own parent
        while($this->parent[$root] != $root) {
            $root = $this->parent[$root];
        }

        # path compression
        while($i != $root) {
            $u = $this->parent[$i];
            $this->parent[$i] = $root;
            $i = $u;
        }

        return $root;
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
