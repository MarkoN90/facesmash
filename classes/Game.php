<?php

/**
 * Class Game
 */
class Game {

    public $winner;
    public $loser;

    private static $k = 25;

    public function __construct($winner, $loser) {

        $this->winner = $winner;
        $this->loser  = $loser;
    }

    /**
     * Calculates the new ratings for contenders using the ELO rating system.
     *
     * Example:
     *
     * contender A has a rating of 2600
     * contender B has a rating of 2300
     *
     * Their expected scores are therefore:
     *
     * contender A: 1/1+10^(2300–2600)/400 = 0.849
     * contender B: 1/1+10^(2600–2300)/400 = 0.151
     *
     * If the K = 16 and contender A wins, then the new ratings would be:
     *
     * contender A = 2600 + 16 (1 – 0.849) = 2602
     * contender B = 2300 + 16 (0 – 0.151) = 2298
     *
     * If the K = 16 and contender B wins, then the new ratings would be:
     *
     * contender A = 2600 + 16 (0 – 0.849) = 2586
     * contender B = 2300 + 16 (1 – 0.151) = 2314
     *
     * @return void
     */
    public function score()
    {

        $pow = ($this->loser->rating - $this->winner->rating) / 400;

        $winnerWinProbability =  1 / (1 + pow(10, $pow));
        $loserWinPProbability  = 1 - $winnerWinProbability;

        $this->winner->rating = $this->winner->rating + self::$k * (1 - $winnerWinProbability);
        $this->loser->rating = $this->loser->rating + self::$k * (0 - $loserWinPProbability);

        $this->winner->save();
        $this->loser->save();

    }
}