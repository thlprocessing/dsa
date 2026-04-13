<?php


/**
 * chia nhỏ + sort các dãy con và merge chúng lại.
 * Chia đôi dãy cần sort thành 2 nửa
 * Sort mỗi nửa dùng đệ quy
 * Merge 2 nửa đã sort lại với nhau trước khi thoát đệ quy
 */

class MergeShort
{

    function mergeShort($numbs)
    {
    
        
        $this->mergeShortRecv($numbs);

    }   

     function selectionShort($numbs) {

        $current_index = 0;

        for ($i = 0; $i < count($numbs); $i++) {

            $min_index = $current_index;

            for ($j = $min_index + 1; $j < count($numbs); $j++) {

                if ($numbs[$j] < $numbs[$min_index]) {
                    $min_index = $j;
                }
            }

            // swap
            $current_value = $numbs[$current_index];
            $numbs[$current_index] = $numbs[$min_index];
            $numbs[$min_index] = $current_value;

            $current_index++;
        }

        return $numbs;
    }

    function mergeShortRecv($numbs)
    {

        $low = 0;
        $high = count($numbs) - 1;
        

        echo "count(numbs) " . count($numbs) . " \n";
        echo "numbs: " . implode(",", $numbs) . "\n";
        echo "low $low high $high \n";

        if(count($numbs) == 1) {
            return $numbs;
        }

        if(count($numbs) == 0) {
            exit;

        }

        $mid = ceil($low + ($high - $low) / 2);

        echo "mid $mid \n";
        $lowSliceArray = array_slice($numbs, $low, $mid);
        $highSliceArray = array_slice($numbs, $mid, $high);

        echo "lowSliceArray: " . implode(",", $lowSliceArray) . "\n";
        echo "highSliceArray: " . implode(",", $highSliceArray) . "\n";


        $lowArr   = $this->mergeShortRecv($lowSliceArray);
        $highArr = $this->mergeShortRecv($highSliceArray);
        
        echo "lowArr: " . implode(",", $lowArr) . "\n";
        echo "highArr: " . implode(",", $highArr) . "\n";

        $mergedArray = array_merge($lowArr, $highArr);
        echo "mergedArray: " . implode(",", $mergedArray) . "\n";
        
        // time exceeded limit
        // $mergedArraySorted = $this->selectionShort($mergedArray);
        // echo "mergedArray sorted: " . implode(",", $mergedArraySorted) . "\n";
        
        
        // return $mergedArraySorted;
        $mergedArraySorted = asort($mergedArray);
        //echo "mergedArray sorted: " . implode(",", $mergedArraySorted) . "\n";
        
        
        return $mergedArray;
    }


}

$solution = new MergeShort();

/**
 * Input: nums = [-1,0,3,5,9,12], target = 9
 * Output: 4
 * Explanation: 9 exists in nums and its index is 4
 */

echo "Merge Sort \n";
$numbs = [11, 2, 6, 7, 26, 3, 19, 65];
echo implode(",", $numbs) . "\n";
$shortedArray = $solution->mergeShort($numbs);

$numbs1 = [5,2,3,1];
echo implode(",", $numbs) . "\n";
$shortedArray = $solution->mergeShort($numbs1);

//echo implode(",", $shortedArray) . "\n";