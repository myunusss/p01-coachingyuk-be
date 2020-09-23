<?php

namespace App\Http\Requests\Answer;

use App\Helpers\FormRequest;
use App\Rules\ExistsId;

class AnswerStoreRequest extends FormRequest
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
            'question_id' => ['nullable', new ExistsId('questions')],
            'content' => ['required'],
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
