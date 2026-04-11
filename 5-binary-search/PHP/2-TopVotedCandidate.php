<?php

/**
 * https://leetcode.com/problems/online-election/
 */
class TopVotedCandidate
{
    public $persons;

    public $times;

    /**
     * @var
     */
    public $leadingCandidates = [];

    /**
     * @param Integer[] $persons
     * @param Integer[] $times
     */
    function __construct($persons, $times) {
        $this->persons = $persons;
        $this->times = $times;

        /**
         * PHP Fatal error: Allowed memory size of 104857600 bytes exhausted (tried to allocate 67108872 bytes)
         * The memory error happens because q($t) rebuilds and appends to $this->leadingCandidates every time calling q.
         * In the test, q() is called 6 times, so the array keeps growing again and again instead of being built once.
         * On LeetCode, q() can be called many times, so memory blows up.
         *
         */
        $voteCounter = [];
        $currentLeader = 0;

        foreach ($this->persons as $person) {

            $voteCounter[$person] = isset($voteCounter[$person]) ? ($voteCounter[$person] + 1) : 1;

            if($voteCounter[$currentLeader] <= $voteCounter[$person]) {
                $currentLeader = $person;
            }

            $this->leadingCandidates[] = $currentLeader;
        }
    }

    public function upperBound($numbs, $target) {

        # initialize 2 pointers: low, high
        $low = 0;
        $high = count($numbs) - 1;
        $rightMost = count($numbs);

        # Iterate and Compare
        while ($low <= $high) {

            # Recalculate $mid for each new boundary
            $mid = floor($low + ($high - $low) / 2);        # Round down: 0.99 ~ 0.00

            # Divide
            if (isset($numbs[$mid]) && $target < $numbs[$mid]) {
                $rightMost = $mid;
                $high = $mid -1;            # search the left half => discard Half Right (high = mid - 1)
            } else {
                $low = $mid + 1;            # search the right half => discard Half Left (low = mid + 1)
            }
        }

        return $rightMost;
    }

    /**
     * @param Integer $t
     * @return Integer
     */
    function q($t) {

        $rightMostNumber = $this->upperBound($this->times, $t);
        return $this->leadingCandidates[(int)($rightMostNumber -1)];
    }
}

$topVotedCandidate = new TopVotedCandidate([0, 1, 1, 0, 0, 1, 0], [0, 5, 10, 15, 20, 25, 30]);


echo "UpperBound: Right-Boundary \n";
echo $topVotedCandidate->q(3) . "\n";       # Output: 0
echo $topVotedCandidate->q(12) . "\n";      # Output: 1
echo $topVotedCandidate->q(25) . "\n";      # Output: 1
echo $topVotedCandidate->q(15) . "\n";      # Output: 0
echo $topVotedCandidate->q(24) . "\n";      # Output: 0
echo $topVotedCandidate->q(8) . "\n";       # Output: 1

