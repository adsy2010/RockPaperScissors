<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 16/08/2018
 * Time: 21:58
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $table = 'match';

    protected $fillable = [
        'matchId',
        'players',
        'games'
    ];
}