<?php

namespace App\Http\Requests\Question;

use App\Helpers\FormRequest;
use App\Rules\ExistsId;

class QuestionUpdateRequest extends FormRequest
{
    /**
     * Add Id to request validation
     * @var $routeParametersToValidate
     * @return array
     */

    protected $routeParametersToValidate = ['id' => 'question'];

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
            'id' => ['required', new ExistsId('questions')],
            'topic_id' => ['nullable', new ExistsId('topics')],
            'content' => ['required'],
        ];
    }

    public function messages()
    {
        return [];
    }
}
