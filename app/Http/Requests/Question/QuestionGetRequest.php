<?php

namespace App\Http\Requests\Question;

use App\Helpers\FormRequest;
use App\Rules\ExistsId;

class QuestionGetRequest extends FormRequest
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
            'id' => ['nullable', new ExistsId('questions')]
        ];
    }

    public function messages()
    {
        return [];
    }
}
