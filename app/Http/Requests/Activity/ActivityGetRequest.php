<?php

namespace App\Http\Requests\Activity;

use App\Helpers\FormRequest;
use App\Rules\ExistsId;

class ActivityGetRequest extends FormRequest
{
    /**
     * Add id to request validation
     * @var $routeParametersToValidate
     * @return array
     */

    protected $routeParametersToValidate = ['id' => 'activity'];

    /**
     * Determine if the activity is authorized to make this request.
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
            'id' => ['nullable', new ExistsId('activities')]
        ];
    }

    public function messages()
    {
        return [];
    }
}
