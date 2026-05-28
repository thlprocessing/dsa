<?php

/**
 * https://leetcode.com/problems/construct-binary-search-tree-from-preorder-traversal/
 */
class BuildBSTFromPreorderTraversal {


    /**
     * @param Integer[] $preorder
     * @return TreeNode
     */
    function bstFromPreorder($preorder)
    {

        $length = count($preorder);
        $treeRoot  = null;


        for($i = 0; $i < count($preorder); $i++) {

            if($i === 0) {
                $treeRoot = new TreeNode($preorder[$i]);
            } else {
                $this->dfs($treeRoot, $preorder[$i]);
            }
            
        }

        return $treeRoot;

    }

    function dfs($node, $val)
    {
     
        # reach empty node => insert our new node on return
        if($node === null) {
            return $node = new TreeNode($val);
        }
        
        # BST
        # val < current_node: go left
        # val > current_node: go right
        if($val < $node->val) {
            $node->left  = $this->dfs($node->left, $val);
        } else {
            $node->right = $this->dfs($node->right, $val);
        }

        return $node;

    }

}



class Solution {


    public $index = 0;

    /**
     * @param Integer[] $preorder
     * @return TreeNode
     */
    function bstFromPreorder($preorder)
    {
        $this->index = 0;
        return $this->build($preorder, PHP_INT_MAX);
    }

    function build($preorder, $bound)
    {
        // If we processed all elements or the current element exceeds our allowed upper bound, return null
        if ($this->index === count($preorder) || $preorder[$this->index] > $bound) {
            return null;
        }

        // The current value becomes the root of the current subtree
        $root = new TreeNode($preorder[$this->index++]);
        
        // Left child's values must be strictly less than the current node's value
        $root->left = $this->build($preorder, $root->val);
        
        // Right child's values must be strictly less than the current bound
        $root->right = $this->build($preorder, $bound);

        return $root;
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

$solution = new BuildBSTFromPreorderTraversal();

$ans = $solution->bstFromPreorder([8,5,1,7,10,12]);
var_dump($ans);
