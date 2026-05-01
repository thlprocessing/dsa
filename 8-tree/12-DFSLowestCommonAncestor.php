<?php

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

        $this->dfs($root, $p, $q);

        return $this->isFound;

    }

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

        if(($node->left?->val === $p || $node->right?->val === $p || $this->ancestor->val === $p) &&  
            ($node->left?->val === $q || $node->right?->val === $q || $this->ancestor->val === $q)
        ) {
            
            return $this->isFound = $this->ancestor;
        }        

        $this->findDescendant($node->left, $p, $q);
        $this->findDescendant($node->right, $p, $q);
    }

    function dfs($node, $p, $q)
    {

        if(!$node) {
            return 0;
        }
        
        # return as quick as possible once pathSum is found to targetSum
        if($this->isFound) {
            return $this->isFound;
        }
        
        $this->hasDescendant($node, $p, $q);

        # Subtree check
        $this->dfs($node->left, $p, $q);
        $this->dfs($node->right, $p, $q);

     
        return $this->isFound;
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
$input = [3,5,1,6,2,0,8,null,null,7,4];
$tree = buildBinaryTree($input);


$solution = new DFSLowestCommonAncestor();
$ans = $solution->lowestCommonAncestor($tree, 5, 1);
var_dump($ans);

$ans2 = $solution->lowestCommonAncestor($tree, 5, 4);
var_dump($ans2);