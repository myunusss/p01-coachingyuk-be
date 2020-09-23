<?php

namespace App\Http\Requests\Topic;

use App\Helpers\FormRequest;
use App\Rules\ExistsSlug;

class TopicGetRequest extends FormRequest
{
    /**
     * Add slug to request validation
     * @var $routeParametersToValidate
     * @return array
     */

    protected $routeParametersToValidate = ['slug' => 'topic'];

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
            'slug' => ['nullable', new ExistsSlug('topics')]
        ];
    }

    public function messages()
    {
        return [];
    }
}
