<?php

class LongestUnivaluePath {



    public $maxUnivaluePathOfTreeThroughNodes = 0;

    function longestUnivaluePath($root) {

        if(!$root) {
            return 0;
        }

        $this->findUnivaluePath($root);

        return $this->maxUnivaluePathOfTreeThroughNodes;
    }


    function findUnivaluePath($node)
    {

        if(!$node) {
            return 0;
        }
        

        $leftMaxUnivaluePathOfNodeSubtree      = $this->findUnivaluePath($node->left);
        $rightMaxUnivaluePathOfNodeSubtree     = $this->findUnivaluePath($node->right);

        //echo "node->val: " . $node->val . "| node->left: " . $node->left?->val . " node->right: " . $node->right?->val . "\n";

        $nodeLeftUnivaluePath  = ($node->val === $node->left?->val)  ? (1 + $leftMaxUnivaluePathOfNodeSubtree)  : 0;

        $nodeRightUnivaluePath = ($node->val === $node->right?->val) ? (1 + $rightMaxUnivaluePathOfNodeSubtree) : 0;

        
        // echo "max (leftHeigth and rightHeight) : " . max($leftMaxUnivaluePathOfNodeSubtree, $rightMaxUnivaluePathOfNodeSubtree) . "\n";
        // echo "nodeLeftUnivaluePath: "   . $nodeLeftUnivaluePath     . "\n";
        // echo "nodeRightUnivaluePath: "  . $nodeRightUnivaluePath    . "\n";
        
        $currentUnivaluePathThroughNode = $nodeLeftUnivaluePath + $nodeRightUnivaluePath;
        


        // echo "node: "                                             . $node->val                                    . "\n";
        // echo "leftHeigth: $leftMaxUnivaluePathOfNodeSubtree "     . " of node_left: "     . $node->left?->val     . "\n";
        // echo "rightHeight: $rightMaxUnivaluePathOfNodeSubtree "   . " of node_right: "    . $node->right?->val    . "\n";

        // echo "currentDiameter: $currentUnivaluePathThroughNode \n";
        // echo "maxDiameter: " . $this->maxUnivaluePathOfTreeThroughNodes . "\n";

        $this->maxUnivaluePathOfTreeThroughNodes  = max($currentUnivaluePathThroughNode, $this->maxUnivaluePathOfTreeThroughNodes);

        // echo "max maxDiameter: " . $this->maxUnivaluePathOfTreeThroughNodes . "\n";

        // echo "max (leftHeigth and rightHeight) : " . max($leftMaxUnivaluePathOfNodeSubtree, $rightMaxUnivaluePathOfNodeSubtree) . "\n";
        
        // echo "nodeHeight max(nodeLeftUnivaluePath and nodeRightUnivaluePath): " . max($nodeLeftUnivaluePath, $nodeRightUnivaluePath) . "\n"; 

        return max($nodeLeftUnivaluePath, $nodeRightUnivaluePath);
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





$binaryTree = new BinaryTree();

// Test 1: expected 4
$t1  = $binaryTree->buildBinaryTree([1,null,1,1,1,1,1,1]);
$s1  = new LongestUnivaluePath();
echo 'Test 1 => ' . $s1->longestUnivaluePath($t1) . ' (expected 4)' . PHP_EOL;

// Test 2: expected 0
$t2  = $binaryTree->buildBinaryTree([-9,5,0,-2,-6,null,null,5,null,null,-3,6,-5,null,null,null,0]);
$s2  = new LongestUnivaluePath();
echo 'Test 2 => ' . $s2->longestUnivaluePath($t2) . ' (expected 0)' . PHP_EOL;
