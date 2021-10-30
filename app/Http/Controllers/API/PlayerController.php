<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Player;
use Validator;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $player = Player::with('team')->get();

        if(!$player->count()) {
            return response()->json(["message" => "No Player Record Found"], 404);
        }
        return response($player, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'firstName' => 'required',
            'lastName' => 'required',
            'playerImageURI' => 'required',
            'team_id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $player = Player::create($request->all());
        return response()->json($player, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Player::where('id', $id)->exists()) {
            $player = Player::with('team')->where('id', $id)->get();
            return response($player, 200);
        } else {
            return response()->json([
                "message" => "Player not found to show."
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'firstName' => 'required',
            'lastName' => 'required',
            'playerImageURI' => 'required',
            'team_id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        if (Player::where('id', $id)->exists()) {
            $player = Player::find($id);
            $player->firstName = is_null($request->firstName) ? $player->firstName : $request->firstName;
            $player->lastName = is_null($request->lastName) ? $player->lastName : $request->lastName;
            $player->playerImageURI = is_null($request->playerImageURI) ? $player->playerImageURI : $request->playerImageURI;
            $player->team_id = is_null($request->team_id) ? $player->team_id : $request->team_id;
            $player->save();

            return response()->json([
                "message" => "Records updated successfully",
                "id" => $id
            ], 200);
        } else {
            return response()->json([
                "message" => "Player not found to update."
            ], 404);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Player::where('id', $id)->exists()) {
            $player = Player::find($id);
            $player->delete();

            return response()->json([
                "message" => "records deleted"
            ], 202);
        } else {
            return response()->json([
                "message" => "Player not found to delete."
            ], 404);
        }
    }
}
