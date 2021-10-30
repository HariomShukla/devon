@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><b>View Team : {{ $teams[0]->name }}</b></div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Logo URI</th>
                                <th scope="col">Preview</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($teams))
                                @foreach($teams as $team)

                                    <tr>
                                        <th scope="row">{{$team->id}}</th>
                                        <td>{{$team->name}}</td>
                                        <td>{{$team->logoURI}}</td>
                                        <td><img src="/images/teams/{{ $team->logoURI }}" width="100px"></td>
                                        <td>
                                            @can('manage-team')
                                            <a href="{{route('team.edit', $team->id)}}"> <button type="button" class="btn btn-primary float-left">Edit</button></a>
                                            <form action="{{ route('team.destroy', $team->id) }}" method="post" class="float-left">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach

                            @else
                                <tr>
                                    <td colspan="5">No Record Available</td>
                                </tr>
                            @endif
                            </tbody>

                        </table>
                        <a href="{{route('team.index')}}"> <button type="button" class="btn btn-primary float-left">Back</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
