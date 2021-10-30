@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Player's List
                        @can('manage-player')
                        <a href="{{ route('player.create') }}"> <button type="button" class="btn btn-success float-right">Create New Player</button></a>
                        @endcan
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Player Image URI</th>
                                <th scope="col">Preview</th>
                                <th scope="col">Team</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($players))
                            @foreach($players as $player)

                                <tr>
                                    <th scope="row">{{$player->id}}</th>
                                    <td>{{$player->firstName}}</td>
                                    <td>{{$player->lastName}}</td>
                                    <td class="col-md-2">{{$player->playerImageURI}}</td>
                                    <td><img src="/images/players/{{ $player->playerImageURI }}" width="100px"></td>
                                    <td>{{$player->team->name}}</td>
                                    <td class="col-md-5">
                                        <a href="{{route('player.show', $player->id)}}"> <button type="button" class="btn btn-secondary float-left" style="margin-right: 2px;">View</button></a>
                                        @can('manage-player')

                                            <a href="{{route('player.edit', $player->id)}}"> <button type="button" class="btn btn-primary float-left" style="margin-right: 2px;">Edit</button></a>
                                        @endcan
                                        @can('manage-player')
                                            <form action="{{ route('player.destroy', $player->id) }}" method="post" class="float-left">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="btn btn-danger" style="margin-right: 2px;">Delete</button>
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
