<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class TodoUpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|string|exists:todo_items,id',
            'name' => 'required|string',
            'content' => 'nullable|string',
            'level' => 'required|integer|in:0,1,2',
            'deadline' => 'required|date',
            'finish' => 'required|boolean',
            'is_top' => 'required|boolean',
        ];
    }
}
