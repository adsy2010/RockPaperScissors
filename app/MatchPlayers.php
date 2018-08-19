<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 16/08/2018
 * Time: 22:09
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class MatchPlayers extends Model
{
    protected $table = 'matchplayers';

    protected $fillable = [
        'matchId',
        'playerId'
    ];

    public function Match()
    {
        return $this->hasOne('App\Match', 'id', 'matchId');
    }
}