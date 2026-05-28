<?php

/**
 * https://leetcode.com/problems/find-leaves-of-binary-tree
 */
class DFSFindLeaves {

    public $ans = [];



    /**
     * @param TreeNode $root
     * @return Integer[][]
     */
    function findLeaves($root)
    {


        if(!$root) {
            return 0;
        }

        $this->dfs($root);

        return $this->ans;
    }

    function dfs($node)
    {
     

        if(!$node) {
            return -1;
        }
        
        # Perform inOrder traversal on BST produces a sorted list
        
        $leftDegree  = $this->dfs($node->left);
        $rightDegree = $this->dfs($node->right);
        
        $degree      = max($leftDegree, $rightDegree) + 1;

        if(!isset($this->ans[$degree])) {
            $this->ans[$degree] = [];
        }

        $this->ans[$degree][] = $node->val;

        return $degree;
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


$data = [1,2,3,4,5];
$tree = buildBinaryTree($data);

$solution = new DFSFindLeaves();

$ans = $solution->findLeaves($tree);
var_dump($ans);