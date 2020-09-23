<?php

namespace App\Http\Requests\Question;

use App\Helpers\FormRequest;
use App\Rules\ExistsSlug;

class QuestionDestroyRequest extends FormRequest
{
    /**
     * Add slug to request validation
     * @var $routeParametersToValidate
     * @return array
     */

    protected $routeParametersToValidate = ['slug' => 'question'];

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
            'slug' => ['required', new ExistsSlug('questions')]
        ];
    }

    public function messages()
    {
        return [];
    }
}
