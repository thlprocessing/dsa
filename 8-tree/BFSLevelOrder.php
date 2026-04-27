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

        while(empty($deque)) {
            [$visitedNode, $visitedNode_level] = array_shift($deque, 0);
            
            if($visitedNode_level > $current_level) {
                $current_level = $visitedNode_level;
                array_push($ans, [$visitedNode->val]);
            } else {
                array_push($ans[count($ans) - 1], $visitedNode->val);
            }
            
            if($visitedNode->left) {
                array_push($ans, [$visitedNode->left, $current_level + 1]);
            }

            if($visitedNode->right) {
                array_push($ans, [$visitedNode->right, $current_level + 1]);
            }

        }

        return $ans;
    }
}