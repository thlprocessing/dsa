<?php
class TreeNode {
    public $val;
    public function __construct($val) { $this->val = $val; }
}
$target = new TreeNode(5);
$targetVal = is_object($target) ? $target->val : $target;
var_dump($targetVal);
