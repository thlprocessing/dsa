import java.util.Random;

/**
 * 
 */
public class PickRandomWithWeigth
{

   /**
    * 
    */
    public int[] weightedArray;

    /**
     * 
     * @param w
     */
    public PickRandomWithWeigth(int[] w)
    {
        this.weightedArray = w;
    }
    
    /**
     * 
     * @return
     */
    public int pickIndex() {
        int arrLength               = this.weightedArray.length;
        int[] prefixSumArr          = new int[arrLength];;
        int totalSum                = 0;
        for(int i = 0; i < arrLength; i++) {
            totalSum         += (this.weightedArray[i]); 
            
            if (i == 0) {
                prefixSumArr[i] = this.weightedArray[i];
            } else {
                prefixSumArr[i] = prefixSumArr[i - 1] + this.weightedArray[i];
            }
        }

        
        
        Random rand = new Random();
        int randInt = rand.nextInt(totalSum) + 1;

        BinarySearch binarySearch = new BinarySearch();
        int pIndex =  binarySearch.lowerBound(prefixSumArr, randInt);

        System.out.println("randInt " + randInt +  " pIndex " + pIndex);

        return pIndex;    
    }
    

    public static void main(String[] var0) {

      int[] intArr = {1,3};
      PickRandomWithWeigth solution = new PickRandomWithWeigth(intArr);
      System.out.println(solution.pickIndex());
      System.out.println(solution.pickIndex());
      System.out.println(solution.pickIndex());
      System.out.println(solution.pickIndex());
      

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
