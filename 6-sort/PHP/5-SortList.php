<?php


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
