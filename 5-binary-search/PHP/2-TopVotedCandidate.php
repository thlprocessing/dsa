<?php

/**
 * https://leetcode.com/problems/online-election/
 */
class TopVotedCandidate
{
    public $persons;

    public $times;

    /**
     * @param Integer[] $persons
     * @param Integer[] $times
     */
    function __construct($persons, $times) {
        $this->persons = $persons;
        $this->times = $times;
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
        return $this->persons[(int)($rightMostNumber -1)];
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

