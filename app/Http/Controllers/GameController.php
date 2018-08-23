<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 19/08/2018
 * Time: 21:12
 */

namespace App\Http\Controllers;


use App\Game;
use App\MatchPlayers;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function StartGame($matchId)
    {

        Game::where([['matchId' => $matchId]]);
    }

    private function getMatchGameCount($matchId)
    {
        return Match::find($matchId)->pluck('games');
    }

    public function hasPlayerMoved($matchId, $gameId)
    {
        $game = Game::where([
                ['gameId', '=', $gameId],
                ['matchId', '=', $matchId],
                ['playerId', '=', Auth::id()]
            ])->get()->count();

        if($game < 1) return false;
        return true;
    }

    public function canPlayerMove($matchId)
    {
        $player = MatchPlayers::where([
            ['matchId', '=' ,$matchId],
            ['playerId', '=', Auth::id()]
        ])->get()->count();
    }

    /**
     * Makes move
     * @param $gameId
     * @param $matchId
     * @param $move
     */
    public function makeMove($gameId, $matchId, $move)
    {
        $game = Game::where('gameId', $gameId)->get();
        $game->matchId = $matchId;
        $game->playerId = Auth::id();
        $game->gameId = $gameId;
        $game->move = $move;
        $game->save();
    }

    public function determineGameResult($matchId, $gameId)
    {
        $games = Game::where(
                ['gameId', '=', $gameId],
                ['matchId', '=', $matchId]
            )->get();
    }

    /**
     * Determine which move wins
     *
     * @param $moveA string Move A (Rock, Paper or Scissors)
     * @param $moveB string Move B (Rock, Paper or Scissors)
     * @return int 0 for equal, 1 for moveA, 2 for moveB, -1 for fail
     */
    private function whoWins($moveA, $moveB)
    {
        if($moveA == $moveB) return 0;
        if($moveA == 'Paper' 	&& $moveB == 'Scissors') 	return 2;
        if($moveA == 'Paper' 	&& $moveB == 'Rock') 		return 1;
        if($moveA == 'Rock' 	&& $moveB == 'Scissors') 	return 1;
        if($moveA == 'Rock' 	&& $moveB == 'Paper') 		return 2;
        if($moveA == 'Scissors' && $moveB == 'Rock') 		return 2;
        if($moveA == 'Scissors' && $moveB == 'Paper') 		return 1;
        return -1;
    }

    public function determineMatchResult($matchId)
    {
        $scores = array();

        $matchGames = Game::where('matchId', $matchId)->get();
    }
}