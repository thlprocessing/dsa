public class MinEatingBoundary
{

    public BinarySearch binarySearch;

 
    /**
     * 
     * @param w
     */
    public MinEatingBoundary()
    {
        this.binarySearch = new BinarySearch();
    }
    
    /**
     * 
     * @return
     */
    public int minEatingSpeed(int[] piles, int h) {
        
      
        
        int arrLength  = piles.length; 
        int low        = 1;
        int high       = 0;

        for(int i = 0; i < arrLength; i++) {
            if(piles[i] > high) {
                high = piles[i];
            }
        }

        
        while(low < high) {

            int mid = (int) Math.floor(low + (high - low) / 2);
        
            int totalHour = 0;

            for(int i = 0; i < arrLength; i++) {
                
                totalHour += (int) Math.ceil(((piles[i] + mid - 1) / mid));
            }   

            if(totalHour <= h) {      // max_boundary works(eating_fast) => reduced max_boundary
                high = mid;           
            } else {
                low  = mid + 1;       // min_boundary works(eating_slow) => increase min_boundary
            }
        }
        
        return low;
    }
    

    public static void main(String[] var0) {

        int[] intArr    = {3,6,7,11};
        int[] intArr2   = {30,11,23,4,20};
        int[] intArr3   = {30,11,23,4,20};
        MinEatingBoundary solution = new MinEatingBoundary();
        System.out.println(solution.minEatingSpeed(intArr, 8));
        System.out.println(solution.minEatingSpeed(intArr2, 5));
        System.out.println(solution.minEatingSpeed(intArr3, 6));

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
