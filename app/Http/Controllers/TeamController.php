<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Team;
use Illuminate\Http\Request;
use GuzzleHttp\Promise\Create;
use App\Http\Requests\CreateTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
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

    // Informa todos os times e todas suas informações
    public function getAll()
    {
        return $this->team->getAll();
    }

    /**
     * Mostra o time que corresponde ao ID informado
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
     * Mostra os times que não possuem nenhum jogador
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function getWithoutPlayers()
    {
        return $this->team->getWithoutPlayers();
    }

        /**
     * Cria um time com as informações passadas por request
     *
     * @param  \App\Http\Requests\CreateTeamRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function createTeam(CreateTeamRequest $request)
    {
        $createdTeam = $this->team->createTeam($request);
        if(!$createdTeam) {
            return response('Não foi possível registrar o time', 404);
        }
        return response('Time registrado com sucesso', 200);
    }

    /**
     * Atualiza o time conforme no ID informado
     *
     * @param  \App\Http\Requests\UpdateTeamRequest  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function updateTeam(UpdateTeamRequest $request , $id)
    {
        $updated = $this->team->updateTeam($request->all(), $id);
        if(!$updated){
            return response('Time não encontrado', 404);
        }
        return response('Time atualizado com sucesso', 200);
    }

    /**
     * Remove o time conforme o ID informado
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function deleteTeam($id)
    {
        $deleted = $this->team->deleteTeam($id);

        if(!$deleted){
            return response('Time não encontrado', 404);
        }
        return response('Time deletado com sucesso', 200);
    }
}
