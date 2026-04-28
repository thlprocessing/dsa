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

    public $maxDiameterOfTreeThroughNodes = 0;

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


        echo "node: "                       . $node->val . "\n";
        echo "leftHeigth: $leftHeigth "     . " of node_left: "     . $node->left?->val . "\n";
        echo "rightHeight: $rightHeight "   . " of node_right: "    . $node->right?->val . "\n";

        echo "currentDiameter: $currentDiameter \n";
        echo "maxDiameter: " . $this->maxDiameter . "\n";

        $this->maxDiameter  = max($currentDiameter, $this->maxDiameter);

        echo "max maxDiameter: " . $this->maxDiameter . "\n";

        echo "max leftHeigth and rightHeight : " . max($leftHeigth, $rightHeight) . "\n";

        return 1 + max($leftHeigth, $rightHeight);
    }


    function diameterOfBinaryTree2($root) {

        if(!$root) {
            return 0;
        }

        $this->findDiameter2($root);

        return $this->maxDiameter;
    }

    function findDiameter2($node)
    {

        if(!$node) {
            return 0;
        }
        

        $leftMaxHeigthOfNodeSubtree      = $this->findDiameter2($node->left);
        $rightMaxHeightOfNodeSubtree     = $this->findDiameter2($node->right);
        $currentDiameterThroughNode  = $leftMaxHeigthOfNodeSubtree + $rightMaxHeightOfNodeSubtree;


        echo "node: "                                   . $node->val                                    . "\n";
        echo "leftHeigth: $leftMaxHeigthOfNodeSubtree "     . " of node_left: "     . $node->left?->val     . "\n";
        echo "rightHeight: $rightMaxHeightOfNodeSubtree "   . " of node_right: "    . $node->right?->val    . "\n";

        echo "currentDiameter: $currentDiameterThroughNode \n";
        echo "maxDiameter: " . $this->maxDiameterOfTreeThroughNodes . "\n";

        $this->maxDiameterOfTreeThroughNodes  = max($currentDiameterThroughNode, $this->maxDiameterOfTreeThroughNodes);

        echo "max maxDiameter: " . $this->maxDiameterOfTreeThroughNodes . "\n";

        echo "max leftHeigth and rightHeight : " . max($leftMaxHeigthOfNodeSubtree, $rightMaxHeightOfNodeSubtree) . "\n";

        echo "nodeHeight: " . 1 + max($leftMaxHeigthOfNodeSubtree, $rightMaxHeightOfNodeSubtree); 

        return $nodeHeight = 1 + max($leftMaxHeigthOfNodeSubtree, $rightMaxHeightOfNodeSubtree); 
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





$input          = [1,2,3,4,5,6,7, 8, 9];
$binaryTree     = new BinaryTree();
$tree           = $binaryTree->buildBinaryTree($input);

var_dump($tree);
$solution = new DFSTreeDiameter();
$ans = $solution->diameterOfBinaryTree($tree);
var_dump($ans);

