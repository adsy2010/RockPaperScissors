<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 19/08/2018
 * Time: 21:21
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'matchId',
        'gameId',
        'playerId',
        'move'
        ];

    protected $table = 'game';
}