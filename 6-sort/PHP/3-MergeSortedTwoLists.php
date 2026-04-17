<?php

/**
 * Definition for a singly-linked list.
 * class ListNode {
 *     public $val = 0;
 *     public $next = null;
 *     function __construct($val = 0, $next = null) {
 *         $this->val = $val;
 *         $this->next = $next;
 *     }
 * }
 */


/**
 * Cannot declare class ListNode, because the name is already in use in list_node.php
 */
class ListNode {

    public $val = 0;
    public $next = null;

    function __construct($val = 0, $next = null) {
        $this->val = $val;
        $this->next = $next;
    }

}

/**
 * 
 */
class MergeShortedTwoLists {

    /**
     * 
     */
    public $mergeSortList;

    /**
     * 
     */
    public function __construct()
    {
        $this->mergeSortList = new MergeSortList();
    }

    /**
     * @param ListNode $list1
     * @param ListNode $list2
     * @return ListNode
     */
    function mergeTwoLists($list1, $list2) {

        // clone list1 [0, m] and list2 [0,n]

        $this->appendList($list1, $list2);
        
        return $this->mergeSortList->mergeSortList($list1);

    }

    public function appendList(&$list1, $list2)
    {

        if($list1) {

            $currentNode = $list1;
    
            while($currentNode) {

                // append list 2
                if($currentNode->next === null && $list2)
                {
                    $currentNode->next = $list2;
                    return;
                }

                $currentNode = $currentNode->next;
            }
        } else {
            $list1 = $list2;
        }
        
    }
    
    public function displayList(ListNode $list) {

        $currentNode = $list;
    
        while($currentNode) {

            echo " " . $currentNode->val . " ";

            $currentNode = $currentNode->next;
        }
    }

    public function toArrayList($list) {

        $array = [];
        $currentNode = $list;
    
        while($currentNode) {

            $array[] = $currentNode->val;
            $currentNode = $currentNode->next;
        }

        return $array;
    }


}

class MergeSortList
{

    function mergeSortList($list)
    {
        return $this->mergeSortListRecv($list);
    }   



    function mergeSortListRecv($list)
    {

        
        $listLength = $this->getListLength($list);
        

        if($listLength == 1) {
            return $list;
        }

        if($listLength == 0) {
            return;
        }

        $low        = 0;
        $high       = $this->getListLength($list) - 1;
        $mid        = ceil($high / 2);

        //echo " listLength: $listLength | low: $low | high: $high | mid $mid \n"; 

        
        
        $leftList       = null;
        $rightList      = null;
        $currentNode    = $list;
        $currentNodeLeft = null;
        $currentNodeRight = null;
        for($i = 0; $i <= $high; $i++) {

            $newNode         = new ListNode();
            $newNode->val    = $currentNode->val;


            // slice left
            if($i < $mid) {
                
                $newNode         = new ListNode();
                $newNode->val    = $currentNode->val;

                if($leftList === null) {
                    $leftList               = $newNode;
                    $currentNodeLeft        = $leftList;
                } else {
                    $currentNodeLeft->next  = $newNode;
                    $currentNodeLeft        = $currentNodeLeft->next;
                }

                //echo "currentNodeLeft value: " . $currentNodeLeft->val . "\n";  
            } 
            // slice right
            else {       
                
                if($rightList === null) {
                    $rightList = $newNode;
                    $currentNodeRight = $rightList;
                } else {
                    $currentNodeRight->next = $newNode;
                    $currentNodeRight       = $currentNodeRight->next;
                }

                //echo "currentNodeRight value: " . $currentNodeRight->val . "\n";
            }            
            
            $currentNode = $currentNode->next;
        }

        //var_dump($leftList);
        //var_dump($rightList);


        $lowArr  = $this->mergeSortListRecv($leftList);
        $highArr = $this->mergeSortListRecv($rightList);
        
        // echo "leftList  \n";
        // var_dump($leftList);
        // echo "rightList \n";
        // var_dump($rightList);

        $mergedArraySorted = $this->mergeSortTwoList($lowArr, $highArr);
        
        return $mergedArraySorted;
    }


    public function mergeSortTwoList($leftList, $rightList)
    {
        $mergeSortedList    = null;
        $currentNode        = null;
        $i = 0;
        while($leftList && $rightList) {

            if($leftList->val < $rightList->val) {
                
                if($mergeSortedList === null) {
                    $mergeSortedList        = $leftList;
                    $currentNode            = $mergeSortedList;
                    $leftList               = $leftList->next;
                } else {
                    $currentNode->next      = $leftList;
                    $currentNode            = $currentNode->next;
                    $leftList              = $leftList->next;
                }
            } else {
                
                if($mergeSortedList === null) {
                    $mergeSortedList        = $rightList;
                    $currentNode            = $mergeSortedList;
                    $rightList               = $rightList->next;
                } else {
                    $currentNode->next      = $rightList;
                    $currentNode            = $currentNode->next;
                    $rightList              = $rightList->next;
                }
            }
        }

        while($leftList !== null) {
            $currentNode->next     = $leftList;
            $currentNode           = $currentNode->next;
            $leftList              = $leftList->next;
        }

        while($rightList !== null) {
            $currentNode->next      = $rightList;
            $currentNode            = $currentNode->next;
            $rightList              = $rightList->next;
        }

        return $mergeSortedList;

    }

    public function mergeSortTwoListOld($leftList, $rightList) {
        // Create a dummy node to act as the start of the merged list
        $mergeSortedList = new ListNode(0);
        $currentNode = $mergeSortedList;

        // Traverse both lists and attach the smaller value
        while ($leftList !== null && $rightList !== null) {

            //echo "leftList->val: " . $leftList->val . " rightList->val: " . $rightList->val . "\n";

            if ($leftList->val < $rightList->val) {
                $currentNode->next = $leftList;
                $leftList = $leftList->next;
            } else {
                $currentNode->next = $rightList;
                $rightList = $rightList->next;
            }
            $currentNode = $currentNode->next;
        }

        //echo "mergeSortedList 289 \n";
        //var_dump($mergeSortedList);

        // Append remaining nodes from either list
        if ($leftList !== null) {
            $currentNode->next = $leftList;
        } elseif ($rightList !== null) {
            $currentNode->next = $rightList;
        }

        //echo "currentNode \n";
        //var_dump($currentNode);
        //echo "mergeSortedList 297 \n";
        //var_dump($mergeSortedList);

        // Return the head of the merged list, skipping the dummy node
        return $mergeSortedList->next;
    }

    public function getListLength($list) {

        $length = 0;
        $currentNode = $list;
        while($currentNode) {
            $length++;
            $currentNode = $currentNode->next;
        }
        return $length;
    }
}



$node1 = new ListNode();
$node1->val = 1;

$node2 = new ListNode();
$node2->val = 2;

$node3 = new ListNode();
$node3->val = 4;


$node1->next = $node2;
$node2->next = $node3;


$mode1 = new ListNode();
$mode1->val = 1;

$mode2 = new ListNode();
$mode2->val = 3;

$mode3 = new ListNode();
$mode3->val = 4;

$mode1->next = $mode2;
$mode2->next = $mode3;


echo "Merge Sort Two Lists \n";

$solution = new MergeShortedTwoLists();

$merged = $solution->mergeTwoLists($node1, $mode1);

var_dump($merged);




$mode4 = new ListNode();
$mode4->val = 3;


$merged2 = $solution->mergeTwoLists(null, $mode4);

var_dump($merged2);




$node4 = new ListNode();
$node4->val = 5;

$mode5 = new ListNode();
$mode5->val = 1;

$mode6 = new ListNode();
$mode6->val = 2;

$mode7 = new ListNode();
$mode7->val = 4;

$mode5->next = $mode6;
$mode6->next = $mode7;


$merged3 = $solution->mergeTwoLists($node4, $mode5);

var_dump($merged3);



