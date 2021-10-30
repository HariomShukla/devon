<?php

namespace App\Http\Controllers\Player;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Http;

class PlayerController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get(env('API_URL').'player');
        $players = $response->getBody()->getContents();

        return view('player.index')->with([
            'players' => json_decode($players)
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::denies('manage-player')) {
            return redirect()->route('player.index');
        }
        $response = Http::get(env('API_URL').'team');
        $teams = $response->getBody()->getContents();

        return view('player.create')->with([
            'teams' => json_decode($teams)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'playerImageURI' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'team_id' => 'required',
        ]);

        $input = $request->all();
        if ($image = $request->file('playerImageURI')) {

            $destinationPath = 'images/players/';

            $logo = date('YmdHis') . "_" . $image->getClientOriginalName() . "." . $image->getClientOriginalExtension();
            $uploadFIle = $image->move($destinationPath, $logo);

            if ($uploadFIle) {
                $response = Http::withBasicAuth(env('API_USER'), env('API_PASSWORD'))->post(env('API_URL').'player', [
                    'firstName' => $request->firstName,
                    'lastName' => $request->lastName,
                    'team_id' => $request->team_id,
                    'playerImageURI' => $logo,
                ]);

                return redirect()->route('player.index')
                    ->with('success','Player created successfully.');
            }
        }
        return redirect()->route('player.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $url = env('API_URL').'player/'.$id;
        $response = Http::get($url);
        $data = $response->getBody()->getContents();
        return view('player.show')->with([
            'players' => json_decode($data)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Gate::denies('manage-player')) {
            return redirect()->route('player.index');
        }

        $res = Http::get(env('API_URL').'team');
        $teams = $res->getBody()->getContents();

        $url = env('API_URL').'player/'.$id;
        $response = Http::get($url);
        $data = $response->getBody()->getContents();
        $player = json_decode($data);

        return view('player.edit')->with([
            'player' => $player[0],
            'teams' => json_decode($teams)
        ]);
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
        if(Gate::denies('manage-player')) {
            return redirect()->route('player.index');
        }

        $url = env('API_URL').'player/'.$id;
        $response = Http::get($url);
        $data = $response->getBody()->getContents();
        $player = json_decode($data);
//        echo "<pre>";
//        print_r($player);
//        die;
        $logo = "";
        $input = $request->all();
        if ($image = $request->file('playerImageURI')) {
            $destinationPath = 'images/players/';
            $logo = date('YmdHis') . "_" . $image->getClientOriginalName();
            $uploadFIle = $image->move($destinationPath, $logo);
        }

        $response = Http::withBasicAuth(env('API_USER'), env('API_PASSWORD'))->put(env('API_URL').'player/'.$id, [
            'firstName' => is_null($request->firstName) ? $player[0]->firstName : $request->firstName,
            'lastName' => is_null($request->lastName) ? $player[0]->lastName : $request->lastName,
            'playerImageURI' => empty($logo) ? $player[0]->playerImageURI : $logo,
            'team_id' => is_null($request->team_id) ? $player[0]->team_id : $request->team_id,
        ]);
        $data = $response->getBody()->getContents();

        return redirect()->route('player.index')
            ->with('success','Player updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::denies('manage-player')) {
            return redirect()->route('player.index');
        }

        $response = Http::withBasicAuth(env('API_USER'), env('API_PASSWORD'))->delete($url = env('API_URL').'player/'.$id);
        return redirect()->route('player.index');
    }
}
