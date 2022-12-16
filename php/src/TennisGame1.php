<?php

namespace TennisGame;

use TennisGame\Domain\Name;
use TennisGame\Domain\Player;
use TennisGame\Domain\Point;

class TennisGame1 implements TennisGame
{
    protected Player $player1;
    protected Player $player2;

    private const SCORES = [
        0 => 'Love',
        1 => 'Fifteen',
        2 => 'Thirty',
        3 => 'Forty'
    ];

    public function __construct(string $player1Name, string $player2Name)
    {
        $this->player1 = Player::withName($player1Name);
        $this->player2 = Player::withName($player2Name);
    }

    public function wonPoint($playerName)
    {
        if ($this->player1->name()->equals(new Name($playerName))) {
            $this->player1->wonPoint();
        }
        if ($this->player2->name()->equals(new Name($playerName))) {
            $this->player2->wonPoint();
        }
    }

    private function getScoreWhenEquals(Point $point): string
    {
        return match ($point->value()) {
            0 => "Love-All",
            1 => "Fifteen-All",
            2 => "Thirty-All",
            default => "Deuce",
        };
    }

    private function getScoreWhenAdvantage(Player $player1, Player $player2): string
    {
        $scoreDelta = $player1->point()->value() - $player2->point()->value();

        return match ($scoreDelta) {
            1 => "Advantage player1",
            -1 => "Advantage player2",
            2, 3, 4 => "Win for player1",
            default => "Win for player2",
        };
    }

    private function getRegularScore(Player $player1, Player $player2): string
    {
        return $this->getScoreByPoint($player1->point()) . '-' . $this->getScoreByPoint($player2->point());
    }

    private function getScoreByPoint(Point $point): string
    {
        return self::SCORES[$point->value()];
    }

    public function getScore()
    {
        if ($this->player1->point()->equals($this->player2->point())) {
            return $this->getScoreWhenEquals($this->player1->point());
        }

        if ($this->player1->point()->value() >= 4 || $this->player2->point()->value() >= 4) {
            return $this->getScoreWhenAdvantage($this->player1, $this->player2);
        }

        return $this->getRegularScore($this->player1, $this->player2);
    }
}
