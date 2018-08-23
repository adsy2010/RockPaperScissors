@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Matches you are part of</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        Not part of a game?
                        <hr>

                        <a class="btn btn-success" href="{{ Route('matches.create') }}">Create Game</a>
                        <a class="btn btn-info" href="{{ Route('matches.invites') }}">Check Invites</a>
                        <hr>
                        <table class="table table-striped">
                            <tr>
                                <th>Match ID</th>
                                <th>Max Players</th>
                                <th>Games</th>
                                <th></th>
                            </tr>

                            @forelse($matches as $match)
                                <tr>
                                    <td><a href="{{Route('matches.view', ['mid' => $match->match->matchId]) }} ">{{ $match->match->matchId }}</a></td>
                                    <td>{{ $match->match->players }}</td>
                                    <td>{{ $match->match->games }}</td>
                                    <td><a class="btn btn-primary" href="{{ Route('matches.join', ['mid' => $match->match->matchId]) }}">Join Match</a></td>
                                </tr>
                                @empty
                                Nothing
                            @endforelse
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
