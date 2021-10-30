@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><b>Edit Player : {{ $player->firstName }}</b></div>

                    <div class="card-body">
                        <form action="{{ route('player.update', $player->id) }}" method="post" enctype='multipart/form-data'>
                            @csrf
                            {{ method_field('PUT') }}

                            <div class="form-group row">
                                <label for="firstName" class="col-md-4 col-form-label text-md-right">First Name</label>
                                <div class="col-md-6">
                                    <input id="firstName" type="text" class="form-control @error('firstName') is-invalid @enderror" name="firstName" value="{{ $player->firstName }}">
                                    @error('firstName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="lastName" class="col-md-4 col-form-label text-md-right">Last Name</label>
                                <div class="col-md-6">
                                    <input id="lastName" type="text" class="form-control @error('lastName') is-invalid @enderror" name="lastName" value="{{ $player->lastName }}">
                                    @error('lastName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="playerImageURI" class="col-md-4 col-form-label text-md-right">Player Image</label>
                                <div class="col-md-6">
                                    <input id="playerImageURI" type="file" class="form-control @error('playerImageURI') is-invalid @enderror" name="playerImageURI" value="{{ $player->playerImageURI }}">
                                    @error('playerImageURI')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="team_id" class="col-md-4 col-form-label text-md-right">Team</label>
                                <div class="col-md-6">
                                    <select class="form-control @error('team_id') is-invalid @enderror" name="team_id">
                                        <option value="">Select</option>
                                        @foreach($teams as $team)
                                            <option value="{{ $team->id }}" @if($player->team_id == $team->id) selected @endif>{{ $team->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('team_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="preview" class="col-md-4 col-form-label text-md-right">Player Old Image Preview</label>
                                <div class="col-md-6">
                                    <img src="/images/players/{{ $player->playerImageURI }}" width="100px">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary float-right">Save</button>
                            <a href="{{route('player.index')}}"> <button type="button" class="btn btn-secondary float-left">Back</button></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
