@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><b>Create Team</b></div>

                    <div class="card-body">
                        <form action="{{ route('team.store') }}" method="post" enctype='multipart/form-data'>
                            @csrf
                            {{ method_field('POST') }}

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="" required autofocus>
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
                                    <input id="logoURI" type="file" class="form-control @error('logoURI') is-invalid @enderror" name="logoURI" value="" required>
                                    @error('name')
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
