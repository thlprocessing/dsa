// Source code is decompiled from a .class file using FernFlower decompiler (from Intellij IDEA).
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

   public static void main(String[] var0) {
      BinarySearch solution = new BinarySearch();
      int[] intArr = {-1, 0, 3, 5, 9, 12};

      int result1 = solution.search(intArr, 9);
      System.out.println(result1);

      int result2 = solution.search(intArr, 2);
      System.out.println(result2);


      System.out.println("LowerBound: Left-Boundary");

      int[] intArr2 = {1, 2, 4, 4, 7};

      int result3 = solution.lowerBound(intArr2, 4);     // Output: 2
      System.out.println(result3);

      int result4 = solution.lowerBound(intArr2, 3);     // Output: 2
      System.out.println(result4);

      int result5 = solution.lowerBound(intArr2, 0);     // Output: 0
      System.out.println(result5);

      int result6 = solution.lowerBound(intArr2, 8);     // Output: 5
      System.out.println(result6);
      

      System.out.println("UpperBound: Right-Boundary");



      int result7 = solution.upperBound(intArr2, 4);     // Output: 4
      System.out.println(result7);

      int result8 = solution.upperBound(intArr2, 3);     // Output: 2
      System.out.println(result8);

      int result9 = solution.upperBound(intArr2, 0);     // Output: 0
      System.out.println(result9);

      int result10 = solution.upperBound(intArr2, 8);     // Output: 5
      System.out.println(result10);

   }
}
