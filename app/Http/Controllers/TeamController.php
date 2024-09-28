<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTeamRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateTeamRequest;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class TeamController extends Controller
{
    private $team;
    private $request;

    public function __construct(Team $team, Request $request)
    {
        $this->team = $team;
        $this->request = $request;
    }

    public function getAll()
    {
        return $this->team->getAll();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTeamRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function createTeam(StoreTeamRequest $request)
    {
        $teams = $this->team->getAll();
        $data = array_merge($request->validated(), ['registration_date' => Carbon::now()->format('Y-m-d h:i:s')]);
        $teams[] = $data;
        Storage::put('db/teams.txt', json_encode($teams));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function getById($id)
    {
        $team = $this->team->getById($id);

        if(!$team) {
            return response('Não foi encontrado um registro com esse ID', 404);
        }

        return $team;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTeamRequest  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTeamRequest $request, Team $team)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        //
    }
}
