<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
}

