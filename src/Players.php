<?php

namespace WyriHaximus\TicTacToe;

class Players
{
    /**
     * @var Player[]
     */
    protected $players = [];

    /**
     * @param Player[] $players
     */
    public function __construct(array $players)
    {
        $this->players = $players;
        reset($this->players);
    }

    public function getPlayers()
    {
        return $this->players;
    }

    public function getSign(Player $player)
    {
        foreach ($this->players as $p) {
            if ($p->getPlayer() === $player) {
                return $p->getSign();
            }
        }
    }

    /**
     * @return Player
     */
    public function getNextPlayer()
    {
        $currentPlayer = current($this->players);
        if ($currentPlayer === false || next($this->players) === false) {
            reset($this->players);
        }
        if ($currentPlayer === false) {
            $currentPlayer = current($this->players);
        }
        return $currentPlayer->getPlayer();
    }
}
