<?php

namespace App\Http\Requests\Activity;

use App\Helpers\FormRequest;
use App\Rules\ExistsId;

/**
 * @OA\Schema(
 *   schema="ActivityUpdateRequest",
 *   @OA\Property(
 *     property="topic_id",
 *     type="integer"
 *   ),
 *   @OA\Property(
 *     property="content",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="note",
 *     type="string"
 *   )
 * )
 */
class ActivityUpdateRequest extends FormRequest
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
            'id' => ['required', new ExistsId('activities')],
            'topic_id' => ['nullable', new ExistsId('topics')],
            'content' => ['nullable'],
            'note' => ['nullable'],
        ];
    }

    public function messages()
    {
        return [];
    }
}
