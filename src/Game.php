<?php

namespace WyriHaximus\TicTacToe;

use React\Promise\Deferred;

class Game
{
    protected $players;

    protected $deferred;

    protected $board = [
        'a' => [
            1 => '',
            2 => '',
            3 => '',
        ],
        'b' => [
            1 => '',
            2 => '',
            3 => '',
        ],
        'c' => [
            1 => '',
            2 => '',
            3 => '',
        ],
    ];

    protected $winningCombos = [
        [
            [
                'col' => 'a',
                'row' => 1,
            ],
            [
                'col' => 'b',
                'row' => 1,
            ],
            [
                'col' => 'c',
                'row' => 1,
            ],
        ],
        [
            [
                'col' => 'a',
                'row' => 2,
            ],
            [
                'col' => 'b',
                'row' => 2,
            ],
            [
                'col' => 'c',
                'row' => 2,
            ],
        ],
        [
            [
                'col' => 'a',
                'row' => 3,
            ],
            [
                'col' => 'b',
                'row' => 3,
            ],
            [
                'col' => 'c',
                'row' => 3,
            ],
        ],
        [
            [
                'col' => 'a',
                'row' => 1,
            ],
            [
                'col' => 'b',
                'row' => 2,
            ],
            [
                'col' => 'c',
                'row' => 3,
            ],
        ],
        [
            [
                'col' => 'a',
                'row' => 3,
            ],
            [
                'col' => 'b',
                'row' => 2,
            ],
            [
                'col' => 'c',
                'row' => 1,
            ],
        ],
        [
            [
                'col' => 'a',
                'row' => 1,
            ],
            [
                'col' => 'a',
                'row' => 2,
            ],
            [
                'col' => 'a',
                'row' => 3,
            ],
        ],
        [
            [
                'col' => 'b',
                'row' => 1,
            ],
            [
                'col' => 'b',
                'row' => 2,
            ],
            [
                'col' => 'b',
                'row' => 3,
            ],
        ],
        [
            [
                'col' => 'c',
                'row' => 1,
            ],
            [
                'col' => 'c',
                'row' => 2,
            ],
            [
                'col' => 'c',
                'row' => 3,
            ],
        ],
    ];

    public function __construct(Player $p1, Player $p2)
    {
        $this->players = new Players([
            new PlayerDecorator($p1, 'X'),
            new PlayerDecorator($p2, 'O'),
        ]);
    }

    public function getBoard()
    {
        return $this->board;
    }

    public function getPlayers()
    {
        $this->players->getPlayers();
    }

    public function start(Deferred $deferred)
    {
        $this->deferred = $deferred;
        $this->players->getNextPlayer()->move($this);
    }

    public function move(Player $player, array $cell)
    {
        if ($this->board[$cell['col']][$cell['row']] != '') {
            throw new \InvalidArgumentException();
        }

        $this->board[$cell['col']][$cell['row']] = $this->players->getSign($player);

        if ($this->hasEnded()) {
            $this->deferred->resolve([
                [
                    $player,
                    'won',
                ],
                [
                    $this->players->getNextPlayer(),
                    'lost',
                ],
            ]);
            return;
        }
        if ($this->boardFull()) {
            $this->deferred->resolve([
                [
                    $player,
                    'tie',
                ],
                [
                    $this->players->getNextPlayer(),
                    'tie',
                ],
            ]);
            return;
        }

        $this->start($this->deferred);
    }

    protected function hasEnded()
    {
        foreach ($this->winningCombos as $combo)
        {
            $sign = '';
            $count = 0;
            foreach ($combo as $cell) {
                if ($this->board[$cell['col']][$cell['row']] == '') {
                    continue;
                }

                if ($sign == '' && $this->board[$cell['col']][$cell['row']] != '') {
                    $sign = $this->board[$cell['col']][$cell['row']];
                    $count++;
                    continue;
                }

                if ($sign != $this->board[$cell['col']][$cell['row']]) {
                    continue;
                }

                $count++;
            }

            if ($count == 3) {
                return true;
            }
        }

        return false;
    }

    protected function boardFull()
    {
        foreach ($this->board as $cols) {
            foreach ($cols as $row) {
                if ($row == '') {
                    return false;
                }
            }
        }

        return true;
    }
}
