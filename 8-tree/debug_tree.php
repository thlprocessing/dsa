<?php

class TreeNode {
    public $val, $left, $right;
    public function __construct($val) { $this->val=$val; $this->left=$this->right=null; }
}

function buildTree(array $arr) {
    if (empty($arr) || $arr[0]===null) return null;
    $root = new TreeNode($arr[0]);
    $q = [$root]; $i=1;
    while (!empty($q) && $i<count($arr)) {
        $cur = array_shift($q);
        if ($i<count($arr) && $arr[$i]!==null) { $cur->left=new TreeNode($arr[$i]); $q[]=$cur->left; } $i++;
        if ($i<count($arr) && $arr[$i]!==null) { $cur->right=new TreeNode($arr[$i]); $q[]=$cur->right; } $i++;
    }
    return $root;
}

function dfs($node, $indent='') {
    if (!$node) return;
    echo $indent . $node->val . "\n";
    dfs($node->left,  $indent.'  L:');
    dfs($node->right, $indent.'  R:');
}

$t = buildTree([-9,5,0,-2,-6,null,null,5,null,null,-3,6,-5,null,null,null,0]);
dfs($t);
