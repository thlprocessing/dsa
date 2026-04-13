/**
 * 
 */
public class LongestIncreasingSubsequence
{

    public BinarySearch binarySearch;

 
    /**
     * 
     * @param w
     */
    public LongestIncreasingSubsequence()
    {
        this.binarySearch = new BinarySearch();
    }
    
    /**
     * 
     * @return
     */
    public int[] longestObstacleCourseAtEachPosition(int[] obstacles) {
        
      
        
        int arrLength = obstacles.length;
        
        // Using ArrayList to mimic the dynamic nature of the PHP arrays
        int[] longestIncreasingSubsequence = new int[arrLength];
        int[] ans = new int[arrLength];

        for (int i = 0; i < arrLength; i++) {
            
            
            // Find the upper bound
            // Note: If using a custom binary search class like in your PHP snippet:
            // int rightBound = binarySearch.upperBound(longestIncreasingSubsequence, current);
            
            int rightBound = this.binarySearch.upperBound(longestIncreasingSubsequence, obstacles[i]);

            if (rightBound == arrLength) {
                
                longestIncreasingSubsequence[longestIncreasingSubsequence.length - 1] = obstacles[i];

            } else {
                longestIncreasingSubsequence[rightBound] = obstacles[i];
            }

            ans[ans.length - 1] = rightBound + 1;
        }

        return ans;
    }
    

    public static void main(String[] var0) {

        int[] intArr    = {1,2,3,2};
        int[] intArr2   = {2,2,1};
        int[] intArr3   = {3,1,5,6,4,2};
        LongestIncreasingSubsequence solution = new LongestIncreasingSubsequence();
        System.out.println(solution.longestObstacleCourseAtEachPosition(intArr));
        System.out.println(solution.longestObstacleCourseAtEachPosition(intArr2));
        System.out.println(solution.longestObstacleCourseAtEachPosition(intArr3));

    }
}


class BinarySearch {


   public int search(int[] arrInt, int target) {
      int low = 0;
      int high = arrInt.length - 1;

      while(low <= high) {

         int mid = low + (high - low) / 2;

         if (arrInt[mid] == target) {
            return mid;
         }

         if (target < arrInt[mid]) {
            high = mid - 1;
         } else {
            low = mid + 1;
         }
      }

      return -1;
   }

   public int lowerBound(int[] numbs, int target) {

      // initialize 2 pointers: low, high
      int low = 0;
      int high = numbs.length - 1;
      int leftMost = numbs.length;

      // Iterate and Compare
      while (low <= high) {

            // Recalculate $mid for each new boundary
            int mid = low + (high - low) / 2;        

            // Divide
            if (target <= numbs[mid]) {
               leftMost = mid;
               high = mid -1;            // search the left half => discard Half Right (high = mid - 1)
            } else {
               low = mid + 1;            // search the right half => discard Half Left (low = mid + 1)
            }
      }

      return leftMost;
   }

   public int upperBound(int[] numbs, int target) {

      // initialize 2 pointers: low, high
      int low = 0;
      int high = numbs.length - 1;
      int rightMost = numbs.length;

      // Iterate and Compare
      while (low <= high) {

            // Recalculate $mid for each new boundary
            int mid = low + (high - low) / 2;        

            // Divide
            if (target < numbs[mid]) {
               rightMost = mid;
               high = mid -1;            // search the left half => discard Half Right (high = mid - 1)
            } else {
               low = mid + 1;            // search the right half => discard Half Left (low = mid + 1)
            }
      }

      return rightMost;
   }
}
