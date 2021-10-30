@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><b>View Team : {{ $players[0]->firstName }} {{ $players[0]->lastName }}</b></div>

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
                                        <td>{{$player->playerImageURI}}</td>
                                        <td><img src="/images/players/{{ $player->playerImageURI }}" width="100px"></td>
                                        <td>{{$player->team->name}}</td>
                                        <td>

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
                        <a href="{{route('player.index')}}"> <button type="button" class="btn btn-primary float-left">Back</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
