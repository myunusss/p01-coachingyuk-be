<?php

namespace App\Http\Requests\Answer;

use App\Helpers\FormRequest;
use App\Rules\ExistsSlug;

class AnswerDestroyRequest extends FormRequest
{
    /**
     * Add slug to request validation
     * @var $routeParametersToValidate
     * @return array
     */

    protected $routeParametersToValidate = ['slug' => 'answer'];

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
            'slug' => ['required', new ExistsSlug('answers')]
        ];
    }

    public function messages()
    {
        return [];
    }
}
