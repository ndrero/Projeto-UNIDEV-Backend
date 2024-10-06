<?php

namespace App\Http\Requests;

use Illuminate\Support\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class CreateTeamRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:30', 'min:3'],
            'foundation_date' => ['required', 'before:' . Carbon::now()->toDateString()],
            'id' => ['required'],
            'players' => ['array', 'max:6'],
            'players.*.name' => 'required|min:3|max:30',
            'players.*.position' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O nome é obrigatório.',
            'name.string' => 'O nome deve ser uma string.',
            'name.max' => 'O nome não pode ter mais de 30 caracteres.',
            'name.min' => 'O nome deve ter pelo menos 3 caracteres.',
            'foundation_date.required' => 'A data de fundação é obrigatória.',
            'foundation_date.before' => 'A data de fundação deve ser anterior a hoje.',
            'id.required' => 'O ID é obrigatório.',
            'players.max' => 'O número máximo de jogadores é 6.',
            'players.*.name.required' => 'O nome do jogador é obrigatório.',
            'players.*.name.min' => 'O nome do jogador deve ter pelo menos 3 caracteres.',
            'players.*.name.max' => 'O nome do jogador não pode ter mais de 30 caracteres.'
        ];
    }
}
