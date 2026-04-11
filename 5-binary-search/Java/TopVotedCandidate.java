class TopVotedCandidate {

    int[] persons;

    int[] times;

    int [] leadingCandidates;

    public TopVotedCandidate(int[] persons, int[] times) {
        this.persons = persons;
        this.times   = times;
        
        int arrLength = persons.length;
        this.leadingCandidates  = new int[arrLength];
        int [] voteCounter = new int[arrLength];
        int currentLeader = 0;

        for(int i = 0; i < arrLength; i++) {
            int person = persons[i];
            voteCounter[person]++;

            if(voteCounter[currentLeader] <= voteCounter[person]) {
                currentLeader = person;
            }

            this.leadingCandidates[i] = currentLeader;
        }
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

    public int q(int t) {
        int rightMost = this.upperBound(this.times, t);
        return this.leadingCandidates[rightMost-1];
    }

    public static void main(String[] var0) {

          int[] persons = {0, 1, 1, 0, 0, 1, 0};
          int[] times = {0, 5, 10, 15, 20, 25, 30};

          TopVotedCandidate topVotedCandidate = new TopVotedCandidate(persons, times);
          System.out.println(topVotedCandidate.q(3)); // return 0, At time 3, the votes are [0], and 0 is leading.
          System.out.println(topVotedCandidate.q(12)); // return 1, At time 12, the votes are [0,1,1], and 1 is leading.
          System.out.println(topVotedCandidate.q(25)); // return 1, At time 25, the votes are [0,1,1,0,0,1], and 1 is leading (as ties go to the most recent vote.)
          System.out.println(topVotedCandidate.q(15)); // return 0
          System.out.println(topVotedCandidate.q(24)); // return 0
          System.out.println(topVotedCandidate.q(8)); // return 1
       }
}

