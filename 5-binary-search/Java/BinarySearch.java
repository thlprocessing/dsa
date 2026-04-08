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

   public static void main(String[] var0) {
      BinarySearch solution = new BinarySearch();
      int[] intArr = {-1, 0, 3, 5, 9, 12};

      int result1 = solution.search(intArr, 9);
      System.out.println(result1);

      int result2 = solution.search(intArr, 2);
      System.out.println(result2);
   }
}
