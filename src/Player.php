<?php

namespace WyriHaximus\TicTacToe;

class Player
{
    protected $cols = [
        'a',
        'b',
        'c',
    ];

    protected $rows = [
        1,
        2,
        3,
    ];

    public function __construct()
    {
        //
    }

    public function move(Game $game)
    {
        while (true) {
            try {
                return $game->move($this, [
                    'col' => $this->cols[mt_rand(0 ,2)],
                    'row' => $this->rows[mt_rand(0 ,2)],
                ]);
            } catch (\InvalidArgumentException $e) {
                // Oops lets move on
            }
        }
    }
}
