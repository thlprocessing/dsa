<?php


/**
 * https://leetcode.com/problems/path-sum/
 */

class PathSum {


    public $targetSum;

    public $isFound = false;


    function hasPathSum($root, $targetSum) {
        
        $this->targetSum = $targetSum;
        $pathSum = 0;

        if(!$root) {
            return 0;
        }

        $this->findPathSum($root, $pathSum);

        return $this->isFound;
    }

    function findPathSum($node, $pathSum)
    {

        if(!$node) {
            return 0;
        }
        
        # return as quick as possible once pathSum is found to targetSum
        if($this->isFound) {
            return;
        }
        
        # Top-down check before going to subtree

        $pathSum += $node->val;

        # leaf node
        if($node->left === null && $node->right === null && $pathSum === $this->targetSum) {
            $this->isFound = true;
        }

        # Subtree check
        $this->findPathSum($node->left, $pathSum);
        $this->findPathSum($node->right, $pathSum);

     
        return false;
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
$input = [5,4,8,11,null,13,4,7,2,null,null,null,1];
$tree = buildBinaryTree($input);

//printLevelOrder($tree); // Output: [3,9,20,null,null,15,7]

$solution = new PathSum();
$ans = $solution->hasPathSum($tree, 22);
var_dump($ans);
