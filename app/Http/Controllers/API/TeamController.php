<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Team;
use Validator;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = Team::get();
        if(!$teams->count()) {
            return response()->json(["message" => "No Team Record Found"], 404);
        }
        return response($teams, 200);
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
            'name' => 'required',
            'logoURI' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $team = Team::create($request->all());
        return response()->json($team, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Team::where('id', $id)->exists()) {
            $team = Team::where('id', $id)->get();
            return response()->json($team, 200);
        } else {
            return response()->json([
                "message" => "Team not found to show."
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
            'name' => 'required',
            'logoURI' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        if (Team::where('id', $id)->exists()) {
            $team = Team::find($id);
            $team->name = is_null($request->name) ? $team->name : $request->name;
            $team->logoURI = is_null($request->logoURI) ? $team->logoURI : $request->logoURI;
            $team->save();

            return response()->json([
                "message" => "Records updated successfully",
                "id" => $id
            ], 200);
        } else {
            return response()->json([
                "message" => "Team not found to update."
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
        if(Team::where('id', $id)->exists()) {
            $team = Team::find($id);
            $team->delete();

            return response()->json([
                "message" => "records deleted"
            ], 202);
        } else {
            return response()->json([
                "message" => "Team not found to delete."
            ], 404);
        }
    }

}
