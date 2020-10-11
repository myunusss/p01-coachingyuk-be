<?php

namespace App\Http\Requests\Event;

use App\Helpers\FormRequest;
use App\Rules\ExistsId;

class EventGetRequest extends FormRequest
{
    /**
     * Add id to request validation
     * @var $routeParametersToValidate
     * @return array
     */

    protected $routeParametersToValidate = ['id' => 'event'];

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
            'id' => ['nullable', new ExistsId('events')]
        ];
    }

    public function messages()
    {
        return [];
    }
}
