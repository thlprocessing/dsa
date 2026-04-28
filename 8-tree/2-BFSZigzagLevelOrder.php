<?php


/**
 * 
 * https://leetcode.com/problems/binary-tree-zigzag-level-order-traversal
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

class BFSZigzagLevelOrder
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

        while(!empty($deque)) {
            [$visitedNode, $visitedNode_level] = array_shift($deque);
            
            if($visitedNode_level > $current_level) {
                
                array_push($ans, [$visitedNode->val]);
                $current_level = $visitedNode_level;

            } else {
                
                $zigZagByLevel = $current_level % 2 == 0;

                if ($zigZagByLevel) {
                    array_push($ans[count($ans) - 1], $visitedNode->val);
                } else {
                    array_unshift($ans[count($ans) - 1], $visitedNode->val);
                }
                
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


class BinaryTree {

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
        
        while (end($result) === null) {
            array_pop($result);
        }
        echo implode(",", $result) . "\n";
    }
}





$input = [3, 9, 20, null, null, 15, 7];
$binaryTree = new BinaryTree();
$tree = $binaryTree->buildBinaryTree($input);


$solution = new BFSZigzagLevelOrder();
$ans = $solution->levelOrder($tree);
var_dump($ans);
