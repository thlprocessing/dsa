<?php

/**
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

class DFSTreeDiameter {

    public $maxDiameter = 0;

    /**
     * @param TreeNode $root
     * @return Integer
     */
    function diameterOfBinaryTree($root) {

        if(!$root) {
            return 0;
        }
        
        $this->findDiameter($root);

        return $this->maxDiameter;
    }

    function findDiameter($node)
    {

        if(!$node) {
            return 0;
        }

        $leftHeigth         = $this->findDiameter($node->left);
        $rightHeight        = $this->findDiameter($node->right);

        $currentDiameter    = $leftHeigth + $rightHeight;

        $this->maxDiameter  = max($currentDiameter, $this->maxDiameter);

        return 1 + max($leftHeigth, $rightHeight);
    }
}