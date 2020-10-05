<?php

namespace App\Http\Requests\ActivityReply;

use App\Helpers\FormRequest;
use App\Rules\ExistsId;

/**
 * @OA\Schema(
 *   schema="ActivityReplyUpdateRequest",
 *   @OA\Property(
 *     property="topic_id",
 *     type="integer"
 *   ),
 *   @OA\Property(
 *     property="content",
 *     type="string"
 *   )
 * )
 */
class ActivityReplyUpdateRequest extends FormRequest
{
    /**
     * Add id to request validation
     * @var $routeParametersToValidate
     * @return array
     */

    protected $routeParametersToValidate = ['id' => 'activity-reply'];

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
            'id' => ['required', new ExistsId('activity_replies')],
            'activity_id' => ['nullable', new ExistsId('activities')],
            'content' => ['nullable'],
        ];
    }

    public function messages()
    {
        return [];
    }
}
