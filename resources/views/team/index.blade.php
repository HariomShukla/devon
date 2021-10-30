@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Team List
                        @can('manage-team')
                        <a href="{{ route('team.create') }}"> <button type="button" class="btn btn-success float-right">Create New Team</button></a>
                        @endcan
                    </div>

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
                                        <a href="{{route('team.show', $team->id)}}"> <button type="button" class="btn btn-secondary float-left">View</button></a>
                                        @can('manage-team')

                                            <a href="{{route('team.edit', $team->id)}}"> <button type="button" class="btn btn-primary float-left">Edit</button></a>
                                        @endcan
                                        @can('manage-team')
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

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
