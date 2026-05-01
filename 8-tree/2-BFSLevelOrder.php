<?php


/**
 * https://leetcode.com/problems/binary-tree-level-order-traversal/
 *
 * Definition for a binary tree node.
 * class TreeNode {
 *     public $val = null;
 *     public $left = null;
 *     public $right = null;
 *     function __construct($val = 0, $left = null, $right = null) {
 *         $this->val = $val;
 *         $this->left = $left;
 *         $this->right = $right;
 *     }
 * }
 */

class BFSLevelOrder
{
    /**
     * @param TreeNode $root
     * @return Integer[][]
     */
    function levelOrder($root) {

        if(!$root) {
            return [];
        }

        $ans   = [];
        $deque = [];

        $deque[]        = [$root, 0];
        $current_level  = -1;
        $zigZag         = false;

        while(!empty($deque)) {
            [$visitedNode, $visitedNode_level] = array_shift($deque);
            
            if($visitedNode_level > $current_level) {
                $current_level = $visitedNode_level;
                array_push($ans, [$visitedNode->val]);
            } else {
                array_push($ans[count($ans) - 1], $visitedNode->val);
            }
            
            if($visitedNode->left) {
                array_push($deque, [$visitedNode->left, $current_level + 1]);
            }

            if($visitedNode->right) {
                array_push($deque, [$visitedNode->right, $current_level + 1]);
            }

        }
        
        return $ans;

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
$input = [3, 9, 20, null, null, 15, 7];
$tree = buildBinaryTree($input);

//printLevelOrder($tree); // Output: [3,9,20,null,null,15,7]

$solution = new BFSLevelOrder();
$ans = $solution->levelOrder($tree);
var_dump($ans);
