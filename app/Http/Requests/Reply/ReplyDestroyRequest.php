<?php

namespace App\Http\Requests\Reply;

use App\Helpers\FormRequest;
use App\Rules\ExistsId;

class ReplyDestroyRequest extends FormRequest
{
    /**
     * Add id to request validation
     * @var $routeParametersToValidate
     * @return array
     */

    protected $routeParametersToValidate = ['id' => 'reply'];

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
            'id' => ['required', new ExistsId('replies')]
        ];
    }

    public function messages()
    {
        return [];
    }
}
