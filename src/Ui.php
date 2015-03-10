<?php

namespace WyriHaximus\TicTacToe;

class Ui
{
    public static function printStatus(Game $game)
    {
        $board = $game->getBoard();

        $ui = '';
        $ui .= '+-+-+-+-+' . PHP_EOL;
        $ui .= '| |a|b|c|' . PHP_EOL;
        $ui .= '+-+-+-+-+' . PHP_EOL;
        $ui .= '|1|' . str_pad($board['a'][1], 1) . '|' . str_pad($board['b'][1], 1) . '|' . str_pad($board['c'][1], 1) . '|' . PHP_EOL;
        $ui .= '+-+-+-+-+' . PHP_EOL;
        $ui .= '|2|' . str_pad($board['a'][2], 1) . '|' . str_pad($board['b'][2], 1) . '|' . str_pad($board['c'][2], 1) . '|' . PHP_EOL;
        $ui .= '+-+-+-+-+' . PHP_EOL;
        $ui .= '|3|' . str_pad($board['a'][3], 1) . '|' . str_pad($board['b'][3], 1) . '|' . str_pad($board['c'][3], 1) . '|' . PHP_EOL;
        $ui .= '+-+-+-+-+' . PHP_EOL;

        return $ui;
    }
}
