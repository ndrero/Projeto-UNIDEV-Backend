<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeamRequest extends FormRequest
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
            'foundation_date' => ['required'],
            'id' => ['required'],
            'players' => ['array', 'max:6'],
            'players.*.name' => 'required|min:3|max:30',
            'players.*.position' => 'required',
        ];
    }
}
