<?php




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
        echo implode(",", $result);
    }

    ####

    public function preOrderTraversal($root)
    {
        if(!$root) {
            return;
        }

        $this->dfsPreOrder($root);
    }

    public function dfsPreOrder($node)
    {
        if(!$node) {
            return;
        }

        echo $node->val;

        $this->dfsPreOrder($node->left);
        $this->dfsPreOrder($node->right);
    }


    public function preOrderTraversalReversed($root)
    {
        if(!$root) {
            return;
        }

        $this->dfsPreOrderReversed($root);
    }

    public function dfsPreOrderReversed($node)
    {
        if(!$node) {
            return;
        }

        echo $node->val;

        $this->dfsPreOrderReversed($node->right);
        $this->dfsPreOrderReversed($node->left);
    }


    ####

    public function inOrderTraversal($root)
    {
        if(!$root) {
            return;
        }

        $this->dfsInOrder($root);
    }

    public function dfsInOrder($node)
    {
        if(!$node) {
            return;
        }

        $this->dfsInOrder($node->left);
        echo $node->val;
        $this->dfsInOrder($node->right);
    }



    public function inOrderTraversalReversed($root)
    {
        if(!$root) {
            return;
        }

        $this->dfsInOrderReversed($root);
    }

    public function dfsInOrderReversed($node)
    {
        if(!$node) {
            return;
        }

        $this->dfsInOrderReversed($node->right);
        echo $node->val;
        $this->dfsInOrderReversed($node->left);
    }

    #### 


    public function postOrderTraversal($root)
    {
        if(!$root) {
            return;
        }

        $this->dfsPostOrder($root);
    }

    public function dfsPostOrder($node)
    {
        if(!$node) {
            return;
        }

        $this->dfsPostOrder($node->left);
        $this->dfsPostOrder($node->right);
        echo $node->val;
    }

    public function postOrderTraversalReversed($root)
    {
        if(!$root) {
            return;
        }

        $this->dfsPostOrderReversed($root);
    }

    public function dfsPostOrderReversed($node)
    {
        if(!$node) {
            return;
        }

        $this->dfsPostOrderReversed($node->right);
        $this->dfsPostOrderReversed($node->left);
        echo $node->val;
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



$data           = ["F", "B", "G", "A", "D", null, "I", null, null, "C", "E", "H", null, null];
#$data           = ["F", "B", "G", "A", "D", "I", "C", "E", "H"];
$binaryTree     = new BinaryTree();
$tree           = $binaryTree->buildBinaryTree($data);


$binaryTree->printLevelOrder($tree);
echo "\n";

echo "\n";

echo "preOrderTraversal:            ";
$binaryTree->preOrderTraversal($tree);              # FBADCEGIH
echo "\n";

echo "preOrderTraversalReversed:    ";
$binaryTree->preOrderTraversalReversed($tree);      # FGIHBDECA
echo "\n";


echo "inOrderTraversal:             ";
$binaryTree->inOrderTraversal($tree);               # ABCDEFGHI
echo "\n";


echo "inOrderTraversalReversed:     ";
$binaryTree->inOrderTraversalReversed($tree);       # IHGFEDCBA
echo "\n";



echo "postOrderTraversal:             ";
$binaryTree->postOrderTraversal($tree);               # ACEDBHIGF
echo "\n";


echo "postOrderTraversalReversed:     ";
$binaryTree->postOrderTraversalReversed($tree);       # HIGECDABF
echo "\n";


