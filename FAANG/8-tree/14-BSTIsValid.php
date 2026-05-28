<?php

/**
 * https://leetcode.com/problems/validate-binary-search-tree/description/
 */
class ValidBinarySearchTree {
    

    public $isValidBST = true;

    /**
     * @param TreeNode $root
     * @return bool
     */
    function isValidBST($root) {

        if(!$root) {
            return false;
        }

        $this->dfs($root, -INF, INF);

        return $this->isValidBST;
    }

    function dfs($node, $left, $right)
    {

        if(!$node) {
            return;
        }

        if(!$this->isValidBST) {
            return;
        }

        if($this->isValidBST === true && !($left < $node->val && $node->val <  $right)) {
            $this->isValidBST = false;
        }            

        # Subtree check
        $this->dfs($node->left, $left, $node->val);
        $this->dfs($node->right, $node->val, $right);

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


$data = [2,1,3];
$tree = buildBinaryTree($data);

$solution = new ValidBinarySearchTree();
$ans = $solution->isValidBST($tree);
echo $ans . "\n";


$data2 = [5,1,4,null,null,3,6];
$tree2 = buildBinaryTree($data2);


$ans2 = $solution->isValidBST($tree2);
echo $ans2 . "\n";


