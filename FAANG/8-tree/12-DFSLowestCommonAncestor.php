<?php

/**
 * https://leetcode.com/problems/lowest-common-ancestor-of-a-binary-tree/description/
 */
class DFSLowestCommonAncestor {

    public $isFound  = null;

    public $p;

    public $q;

    public $ancestor = null;

    /**
     * @param TreeNode $root
     * @param TreeNode $p
     * @param TreeNode $q
     * @return TreeNode
     */
    function lowestCommonAncestor($root, $p, $q) {

        if(!$root) {
            return 0;
        }

        $this->isFound = null;
        $this->p       = $p;
        $this->q       = $q;

        $this->dfs($root);

        return $this->isFound;

    }

    /**
     * 
     * Farthest Common Ancestor
     * @param mixed $node
     * @param mixed $p
     * @param mixed $q
     * @return int
     */
    function hasDescendant($node, $p, $q)
    {


        if(!$node) {
            return 0;
        }

        $this->ancestor = $node;

        
        $this->findDescendant($node, $p, $q);


    }

    function findDescendant($node, $p, $q) {

        if(!$node) {
            return 0;
        }

        if($this->isFound) {
            return $this->isFound;
        }

        if(($node->left?->val === $p->val || $node->right?->val === $p->val || $this->ancestor?->val === $p->val) &&  
            ($node->left?->val === $q->val || $node->right?->val === $q->val || $this->ancestor?->val === $q->val)
        ) {
            
            return $this->isFound = $this->ancestor;
        }        

        $this->findDescendant($node->left, $p, $q);
        $this->findDescendant($node->right, $p, $q);
    }

    function dfs($node)
    {

        if(!$node) {
            return [null, null];
        }

        if($this->isFound) {
            return;
        }
        
        $is_ancestor_of_p = $this->p->val === $node->val;
        $is_ancestor_of_q = $this->q->val === $node->val;

        # Subtree check
        [$left_p, $left_q]      = $this->dfs($node->left);
        [$right_p, $right_q]    = $this->dfs($node->right);


        if($left_p || $right_p) {
            $is_ancestor_of_p = true;
        }

        if($left_q || $right_q) {
            $is_ancestor_of_q = true;
        }

        
        if($is_ancestor_of_p && $is_ancestor_of_q && $this->isFound === null) {
            $this->isFound = $node;
        }


        return [$is_ancestor_of_p, $is_ancestor_of_q];

    }

}



/**
 * Binary Tree Node class
 */
class TreeNode {
    public $val;
    public $left;
    public $right;

    public function __construct($val) {
        $this->val = $val;
        $this->left = null;
        $this->right = null;
    }
}

/**
 * Build a binary tree from a level-order array
 *
 * @param array $arr Level-order array (null for missing nodes)
 * @return TreeNode|null Root of the binary tree
 */
function buildBinaryTree(array $arr) {
    if (empty($arr) || $arr[0] === null) {
        return null; // Empty tree
    }

    // Create root node
    $root = new TreeNode($arr[0]);
    $queue = [$root];
    $i = 1;

    // BFS construction
    while (!empty($queue) && $i < count($arr)) {
        $current = array_shift($queue);

        // Left child
        if ($i < count($arr) && $arr[$i] !== null) {
            $current->left = new TreeNode($arr[$i]);
            $queue[] = $current->left;
        }
        $i++;

        // Right child
        if ($i < count($arr) && $arr[$i] !== null) {
            $current->right = new TreeNode($arr[$i]);
            $queue[] = $current->right;
        }
        $i++;
    }

    return $root;
}

/**
 * Helper: Print tree in level-order for verification
 */
function printLevelOrder($root) {
    if (!$root) {
        echo "[]\n";
        return;
    }
    $queue = [$root];
    $result = [];
    while (!empty($queue)) {
        $node = array_shift($queue);
        if ($node) {
            $result[] = $node->val;
            $queue[] = $node->left;
            $queue[] = $node->right;
        } else {
            $result[] = null;
        }
    }
    // Trim trailing nulls for clean output
    while (end($result) === null) {
        array_pop($result);
    }
    echo implode(",", $result) . "\n";
}



// Example usage:
$data = [3,5,1,6,2,0,8,null,null,7,4];
$tree = buildBinaryTree($data);

$p = new TreeNode(5);
$q = new TreeNode(1);

$solution = new DFSLowestCommonAncestor();
// $ans = $solution->lowestCommonAncestor($tree, $p, $q);
// var_dump($ans);     # output: 3

$p = new TreeNode(5);
$q = new TreeNode(4);

$ans2 = $solution->lowestCommonAncestor($tree, $p, $q);
var_dump($ans2);       # output: 5

// $data2 = [1,2,3,null,4];
// $tree2 = buildBinaryTree($data2);

// $p = new TreeNode(4);
// $q = new TreeNode(3);


// $ans3 = $solution->lowestCommonAncestor($tree2, $p, $q);
// var_dump($ans3);

//         1
//     2       3
// null    4


/**
 
node: 3
node left: 5
node right: 1
p: 5
q: 4
is_ancestor_of_p: 
is_ancestor_of_q: 

# sub(3)-left(5)
node: 5
node left: 6
node right: 2
p: 5
q: 4
is_ancestor_of_p: 1
is_ancestor_of_q: 

# sub(3)-left(5)-left(6)
node: 6
node left: 
node right: 
p: 5
q: 4
is_ancestor_of_p: 
is_ancestor_of_q: 
left_p: 
left_q: 
right_p: 
right_q: 
is_ancestor_of_p: 
is_ancestor_of_q:

# sub(3)-left(5)-right(2)
node: 2
node left: 7
node right: 4

p: 5
q: 4
is_ancestor_of_p: 
is_ancestor_of_q: 

# sub(3)-left(5)-right(2)-left(7)
node: 7
node left: 
node right: 
p: 5
q: 4
is_ancestor_of_p: 
is_ancestor_of_q: 
left_p: 
left_q: 
right_p: 
right_q: 
is_ancestor_of_p: 
is_ancestor_of_q: 

# sub(3)-left(5)-right(2)-right(4)
node: 4
node left: 
node right: 
p: 5
q: 4
is_ancestor_of_p: 
is_ancestor_of_q: 1
left_p: 
left_q: 
right_p: 
right_q: 
is_ancestor_of_p: 
is_ancestor_of_q: 1

# back_track # sub(3)-left(5)-right(2)
left_p: 
left_q: 
right_p: 
right_q: 1
is_ancestor_of_p: 
is_ancestor_of_q: 1

# back_track sub(3)-left(5)
left_p: 
left_q: 
right_p: 
right_q: 1
is_ancestor_of_p: 1
is_ancestor_of_q: 1
left_p: 1
left_q: 1
right_p: 
right_q: 
is_ancestor_of_p: 1
is_ancestor_of_q: 1
 */