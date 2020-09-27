<?php

namespace App\Http\Requests\Topic;

use App\Helpers\FormRequest;
use App\Rules\ExistsId;

/**
 * @OA\Schema(
 *   schema="TopicStoreRequest",
 *   @OA\Property(
 *     property="name",
 *     type="string"
 *   )
 * )
 */
class TopicStoreRequest extends FormRequest
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
            'category_id' => ['required', new ExistsId('categories')],
            'name' => ['required'],
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
