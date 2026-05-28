<?php

/**
 * Work in Progress
 * https://leetcode.com/problems/all-nodes-distance-k-in-binary-tree/
 */
class AllNodesDistanceK {

    public $ans = [];

    public $target;

    public $k;

    public $kComplement;

    /**
     * @param TreeNode $root
     * @param TreeNode $target
     * @param Integer $k
     * @return Integer[]
     */
    function distanceK($root, $target, $k)
    {


        if(!$root) {
            return 0;
        }
        $this->ans    = [];
        $this->target = $target;
        $this->k      = $k;
        $this->kComplement = null;

        $this->dfs($root, 0, 0);

        return $this->ans;
    }

    function dfs($node, $downwardHeigth, $upwardHeigth)
    {

        if(!$node) {
            return 0;
        }



        if($downwardHeigth === $this->k) {
            $this->ans[] = $node->val;
        }

        if($node->val === $this->target) {
            $downwardHeigth = 1;
        }

        if($node->val !== $this->target && $downwardHeigth) {
            $downwardHeigth++;
        }
        
        # Perform inOrder traversal on BST produces a sorted list
        
        $leftUpwardHeigth  = $this->dfs($node->left, $downwardHeigth, $upwardHeigth);
        $rightUpwardHeigth = $this->dfs($node->right, $downwardHeigth, $upwardHeigth);
        $currentDiameterThroughNode   = $leftUpwardHeigth + $rightUpwardHeigth;
        
        
        if($currentDiameterThroughNode === $this->k) {
            $this->ans[] = $node->val;
        }

        if($currentDiameterThroughNode) {

            $this->kComplement =  $this->k - $currentDiameterThroughNode;

            # from left upward -> find right
            if($leftUpwardHeigth) {
                $this->hasDescendant($node->right, 1);
            }
            
            # from right upward -> find left
            if($rightUpwardHeigth) {
                $this->hasDescendant($node->left, 1);
            }
        }

        if($node->val === $this->target) {
            $upwardHeigth = 1 + max($leftUpwardHeigth, $rightUpwardHeigth);
        } else {
            if ($upwardHeigth) {
                $upwardHeigth = 1 + max($leftUpwardHeigth, $rightUpwardHeigth);
            }
        }

        

        return $upwardHeigth;
    }

    function hasDescendant($node, $downwardHeigth)
    {

        if(!$node) {
            return 0;
        }

        $this->findDescendant($node, $downwardHeigth);

    }

    function findDescendant($node, $downwardHeigth) {

        if(!$node) {
            return 0;
        }

        if($downwardHeigth === $this->kComplement) {
            $this->ans[] = $node->val;
        }

        $downwardHeigth++;

        $this->findDescendant($node->left, $downwardHeigth);
        $this->findDescendant($node->right, $downwardHeigth);

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


$data = [3,5,1,6,2,0,8,null,null,7,4];
$tree = buildBinaryTree($data);

$solution = new AllNodesDistanceK();

 $ans = $solution->distanceK($tree, 5, 2);
 var_dump($ans);


$data1 = [0,2,1,null,null,3];
$tree1 = buildBinaryTree($data1);

$ans2 = $solution->distanceK($tree1, 3, 3);
var_dump($ans2);


//         0
//     2         1
// null null  3