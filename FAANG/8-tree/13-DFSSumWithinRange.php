<?php

/**
 * https://leetcode.com/problems/range-sum-of-bst/description/
 */
class DFSSumWithinRange {


    public $lowRange;

    public $highRange;

    public $totalSumWithinRange;

    /**
     * Runtime: 1ms
     * Memory: 26.44 MB
     * @param TreeNode $root
     * @param Integer $low
     * @param Integer $high
     * @return Integer
     */
    function rangeSumBST($root, $low, $high) {

        if(!$root) {
            return 0;
        }

        $this->lowRange = $low;
        $this->highRange = $high;

        $this->dfs($root, -INF, INF);

        return $this->totalSumWithinRange;
    }

    function dfs($node, $leftBound, $rightBound)
    {

        if(!$node) {
            return;
        }
        # rightBound of left_subtree < lowRange or highRange < leftBound of right_subtree -> STOP
        if($rightBound < $this->lowRange || $this->highRange < $leftBound) {
            return;
        }

        if($this->lowRange <= $node->val && $node->val <= $this->highRange) {
            $this->totalSumWithinRange += $node->val;
        }            

        # Subtree check
        $this->dfs($node->left, $leftBound, $node->val);
        $this->dfs($node->right, $node->val, $rightBound);

        return $node;

    }

    /**
     * 
     * Runtime: 13 ms
     * Memory: 26.08 MB
     * @param mixed $root
     * @param mixed $low
     * @param mixed $high
     */
    function rangeSumBST2($root, $low, $high) {

        if(!$root) {
            return 0;
        }

        $this->lowRange = $low;
        $this->highRange = $high;

        $this->dfs2($root);

        return $this->totalSumWithinRange;
    }

    function dfs2($node)
    {

        if(!$node) {
            return;
        }

        if($this->lowRange <= $node->val && $node->val <= $this->highRange) {
            $this->totalSumWithinRange += $node->val;
        }            

        # Subtree check
        $this->dfs($node->left);
        $this->dfs($node->right);


        return $node;

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


// Example usage:
$data = [10,5,15,3,7,null,18];
$tree = buildBinaryTree($data);

$solution = new DFSSumWithinRange();
$ans = $solution->rangeSumBST($tree, 7, 15);

echo $ans;