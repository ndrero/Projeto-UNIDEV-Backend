<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Arr;

/**
 * @property array $teams
 */

class Team extends Model
{
    use HasFactory;


    public function getAll()
    {
        $teams = Storage::get('db/teams.txt');
        return json_decode($teams);
    }

    public function getById($id)
    {
        $teamsCollection = collect($this->getAll());

        return $teamsCollection
            ->where("id", $id)
            ->first();
    }

    public function getWithoutPlayers()
    {
        $teamsCollection = collect($this->getAll());
        return $teamsCollection
            ->filter(function ($team){
                return !$team->players;
            });
    }

    public function createTeam(Request $request)
    {
        $teams = $this->getAll();
        $data = array_merge($request->validated(), ['registration_date' => Carbon::now()->format('Y-m-d h:i:s')]);
        $teams[] = $data;
        Storage::put('db/teams.txt', json_encode($teams));
        return true;
    }

    public function updateTeam($data, $id)
    {
        $teamsCollection = collect($this->getAll());
        $teamFound = false;
        $updatedTeams = $teamsCollection->map(function ($team) use ($id,$data, &$teamFound){
            if($team->id == $id){
                $teamFound = true;
                return array_merge((array)$team, $data);
            }
            return $team;
        });

        if($teamFound){
            Storage::put('db/teams.txt', json_encode($updatedTeams));
            return true;
        }
        return false;
    }


    public function deleteTeam($id)
    {
        $teamsCollection = collect($this->getAll());
        $teamFound = false;
        $updatedTeams = $teamsCollection->reject(function ($team) use ($id, &$teamFound){
            if($team->id == $id){
                $teamFound = true;
                return true;
            }
            return false;
        });

        if($teamFound){
            Storage::put('db/teams.txt', json_encode($updatedTeams));
            return true;
        }
        return false;
    }
}

