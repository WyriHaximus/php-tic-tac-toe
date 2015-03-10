<?php

namespace WyriHaximus\TicTacToe;

class PlayerDecorator
{
    protected $player;
    protected $sign;

    public function __construct(Player $player, $sign)
    {
        $this->player = $player;
        $this->sign = $sign;
    }

    public function getPlayer()
    {
        return $this->player;
    }

    public function getSign()
    {
        return $this->sign;
    }
}
