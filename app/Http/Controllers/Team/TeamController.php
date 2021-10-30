<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Http;

class TeamController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get(env('API_URL').'team');
        $teams = $response->getBody()->getContents();

        return view('team.index')->with([
            'teams' => json_decode($teams)
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::denies('manage-team')) {
            return redirect()->route('team.index');
        }
        return view('team.create');
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
            'name' => 'required',
            'logoURI' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();
        if ($image = $request->file('logoURI')) {

            $destinationPath = 'images/teams/';

            $logo = date('YmdHis') . "_" . $image->getClientOriginalName() . "." . $image->getClientOriginalExtension();
            $uploadFIle = $image->move($destinationPath, $logo);

            if ($uploadFIle) {
                $response = Http::withBasicAuth(env('API_USER'), env('API_PASSWORD'))->post(env('API_URL').'team', [
                    'name' => $request->name,
                    'logoURI' => $logo,
                ]);

                return redirect()->route('team.index')
                    ->with('success','Team created successfully.');
            }
        }
        return redirect()->route('team.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $url = env('API_URL').'team/'.$id;
        $response = Http::get($url);
        $data = $response->getBody()->getContents();
        return view('team.show')->with([
            'teams' => json_decode($data)
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
        if(Gate::denies('manage-team')) {
            return redirect()->route('team.index');
        }

        $url = env('API_URL').'team/'.$id;
        $response = Http::get($url);
        $data = $response->getBody()->getContents();
        $team = json_decode($data);

        return view('team.edit')->with([
            'team' => $team[0]
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
        if(Gate::denies('manage-team')) {
            return redirect()->route('team.index');
        }

        $url = env('API_URL').'team/'.$id;
        $response = Http::get($url);
        $data = $response->getBody()->getContents();
        $team = json_decode($data);
        $logo = "";
        $input = $request->all();
        if ($image = $request->file('logoURI')) {
            $destinationPath = 'images/teams/';
            $logo = date('YmdHis') . "_" . $image->getClientOriginalName();
            $uploadFIle = $image->move($destinationPath, $logo);
        }
        $response = Http::withBasicAuth(env('API_USER'), env('API_PASSWORD'))->put(env('API_URL').'team/'.$id, [
            'name' => is_null($request->name) ? $team[0]->name : $request->name,
            'logoURI' => is_null($logo) ? $team[0]->logoURI : $logo,
        ]);

        return redirect()->route('team.index')
            ->with('success','Team updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::denies('manage-team')) {
            return redirect()->route('team.index');
        }

        $response = Http::withBasicAuth(env('API_USER'), env('API_PASSWORD'))->delete($url = env('API_URL').'team/'.$id);
        return redirect()->route('team.index');
    }
}
