@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><b>Edit Team : {{ $team->name }}</b></div>

                    <div class="card-body">
                        <form action="{{ route('team.update', $team->id) }}" method="post" enctype='multipart/form-data'>
                            @csrf
                            {{ method_field('PUT') }}

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $team->name }}">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="logoURI" class="col-md-4 col-form-label text-md-right">Logo</label>
                                <div class="col-md-6">
                                    <input id="logoURI" type="file" class="form-control @error('logoURI') is-invalid @enderror" name="logoURI" value="{{ $team->logoURI }}">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="logoURI" class="col-md-4 col-form-label text-md-right">Preview Old Logo</label>
                                <div class="col-md-6">
                                    <img src="/images/teams/{{ $team->logoURI }}" width="200px" alt="Preview N/A">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary float-right">Save</button>
                            <a href="{{route('team.index')}}"> <button type="button" class="btn btn-secondary float-left">Back</button></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
