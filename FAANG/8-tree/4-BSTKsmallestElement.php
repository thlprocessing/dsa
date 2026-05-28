<?php


/**
 * https://leetcode.com/problems/kth-smallest-element-in-a-bst/
 */
class BSTKsmallestElement{


    public $isValidBST = true;


    public $k;

    public $count;

    public $ans;

    /**
     * @param TreeNode $root
     * @param Integer $k
     * @return Integer
     */
    function kthSmallest($root, $k)
    {
    

        if(!$root) {
            return 0;
        }
        $this->count = 0;
        $this->k     = $k;

        $this->dfs($root);

        return $this->ans;
    }

    function dfs($node)
    {
     

        if(!$node) {
            return;
        }
        
        if($this->ans) {
            return;
        }
        
        # Perform inOrder traversal on BST produces a sorted list
        
        $this->dfs($node->left);

        $this->count++;
        
        if ($this->count === $this->k) {
            $this->ans = $node->val;
            return; // Found the k-th smallest element on sorted list when performing inOrder Traversal
        }
        
        $this->dfs($node->right);

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



$data = [3,1,4,null,2];
$tree = buildBinaryTree($data);

$solution = new BSTKsmallestElement();
//var_dump($tree);
// $ans = $solution->kthSmallest($tree, 1);
// echo $ans . "\n";       # output: 1


// $data2 = [5,3,6,2,4,null,null,1];
// $tree2 = buildBinaryTree($data2);
// //var_dump($tree2);
// $ans2 = $solution->kthSmallest($tree2, 3);
// echo $ans2 . "\n"; # output: 3


$data3 = [4,2,5,null,3];
$tree3 = buildBinaryTree($data3);
//var_dump($tree2);
$ans3 = $solution->kthSmallest($tree3, 1);
echo $ans3 . "\n"; # output: 3

# output: 2

//         4
//     2       5
// null    3