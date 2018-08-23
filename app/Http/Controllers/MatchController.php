<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 16/08/2018
 * Time: 21:52
 */

namespace App\Http\Controllers;


use App\Match;
use App\MatchPlayers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MatchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function createMatch(Request $request)
    {
        //run checks
        if(!$request->isMethod('post'))
            return view('match.create');

        //create match
        $matchId = hash('md2', uniqid(rand(1, 10000), true));
        $players = 2;
        $games = 3;


        $match = new Match();
        $match->matchId = $matchId;
        $match->players = $players;
        $match->games = $games;
        $match->creatorId = Auth::id();
        $match->save();

        //join created match as first player
        $this->joinMatch($request, $match->id);

        return redirect()->to('matches.list')->with('status', 'Created Match '.$matchId);
    }

    public function joinMatch(Request $request, $matchId = null)
    {

        if($matchId == null)
        {
            if (!empty($request['mid']))
            {

                $matchId = $request['mid'];
                $match = Match::where('matchId', '=', $matchId)->firstOrFail();
            }
            else
                return redirect('matches.list')
                    ->with('status', 'No valid match id provided to join')
                    ->send();
        }
        else
        {
            $match = Match::where('matchId', '=', $matchId)->firstOrFail();
        }

        $player = $this->isPlayerInMatch($match->id);
        $max = $this->isMatchMaxPlayers($match->players, $match->id);

        if($player) return redirect()->to(Route('matches.list'))->with('status', "Failed to join, you are already in this match '.$matchId.'.")->send();
        if($max) return redirect()->to(Route('matches.list'))->with('status', 'Failed, there are already enough players in this match.')->send();

        if(!$max && !$player) {
            $matchPlayer = new MatchPlayers();
            $matchPlayer->matchId = $match->id;
            $matchPlayer->playerId = Auth::id();
            $matchPlayer->save();
        }

        return redirect()->route('matches.list')->with('status', 'Success');
    }

    /**
     * Test to see if the current player is in the requested match
     *
     * @param $matchId
     * @return bool
     */
    private function isPlayerInMatch($matchId)
    {
        $matchPlayers = MatchPlayers::where("matchId", $matchId)->get();
        foreach ($matchPlayers as $player)
            if($player->playerId == Auth::id()) return true;

        return false;
    }

    /**
     * Test to see if the match has maximum players
     *
     * @param $max
     * @param $matchId
     * @return bool
     */
    private function isMatchMaxPlayers($max, $matchId)
    {
        $matchPlayers = MatchPlayers::where("matchId", $matchId)->get()->count();
        if($matchPlayers < $max) return false;
        return true;
    }

    public function viewMatch($matchId)
    {
        $match = Match::where('matchId', $matchId)->firstOrFail();
        return view('match.view', ['match' => $match]);
    }

    public function listMatches()
    {
        $matches = MatchPlayers::where('playerId', '=', Auth::id())
            ->paginate(25);
        return view('match.list', ['matches' => $matches]);
    }
}