@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><b>Create Player</b></div>

                    <div class="card-body">
                        <form action="{{ route('player.store') }}" method="post" enctype='multipart/form-data'>
                            @csrf
                            {{ method_field('POST') }}

                            <div class="form-group row">
                                <label for="firstName" class="col-md-4 col-form-label text-md-right">First Name</label>
                                <div class="col-md-6">
                                    <input id="firstName" type="text" class="form-control @error('firstName') is-invalid @enderror" name="firstName" value="" required autofocus>
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
                                    <input id="lastName" type="text" class="form-control @error('lastName') is-invalid @enderror" name="lastName" value="" required autofocus>
                                    @error('lastName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="logoURI" class="col-md-4 col-form-label text-md-right">Player Image</label>
                                <div class="col-md-6">
                                    <input id="playerImageURI" type="file" class="form-control @error('playerImageURI') is-invalid @enderror" name="playerImageURI" value="" required>
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
                                    <select class="form-control @error('team_id') is-invalid @enderror" name="team_id" required>
                                        <option value="">Select</option>
                                        @foreach($teams as $team)
                                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('team_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <a href="{{route('team.index')}}"> <button type="button" class="btn btn-secondary float-left">Back</button></a>
                            <button type="submit" class="btn btn-primary float-right">Save</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
