@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create Match</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ Form::open() }}
                        Players: {{ Form::number('players', 2,
                        [
                            'min' => 2,
                            'max' => 2,
                            'class' => 'form-control'
                        ]) }}
                        Games: {{ Form::number('games', 3,
                                                [
                            'min' => 3,
                            'max' => 3,
                            'class' => 'form-control'
                        ]) }}<br>
                        {{ Form::submit('Create a match', ['class' => 'btn, btn-primary form-control']) }}
                    {{ Form::close() }}

                        {{ Html::image('img/rock.png',null, ['class' => 'btn']) }}
                        {{ Html::image('img/paper.png',null, ['class' => 'btn']) }}
                        {{ Html::image('img/scissors.png',null, ['class' => 'btn']) }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
