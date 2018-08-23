@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>Match {{ $match->matchId }}</h4></div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        Match created at: {{ $match->created_at }}<br>
                        Maximum Players: {{ $match->players }}<br>
                        Games Per Match: {{ $match->games }}<br>

                            @if(Auth::id() == $match->creator->id && count($match->matchPlayers) > 1)
                                <a class="btn btn-primary" href="">Start Game</a>
                                @else
                                <a class="btn btn-danger" disabled="" title="There are not enough players to start the game or you are not the match creator">Start Game</a>
                            @endif
                            <hr>


                            <table class="table table-striped">
                                <tr><th>Players in match</th></tr>
                                @foreach($match->matchPlayers as $player)
                                    <tr><td>{{ $player->player->name }}</td></tr>
                                @endforeach
                                <tr><td><strong>Total Players</strong>: {{ count($match->matchPlayers) }}</td></tr>

                            </table>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
