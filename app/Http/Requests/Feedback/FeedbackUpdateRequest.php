<?php

namespace App\Http\Requests\Feedback;

use App\Helpers\FormRequest;
use App\Rules\ExistsId;

/**
 * @OA\Schema(
 *   schema="FeedbackUpdateRequest",
 *   @OA\Property(
 *     property="type",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="content",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="email",
 *     type="string"
 *   )
 * )
 */
class FeedbackUpdateRequest extends FormRequest
{
    /**
     * Add id to request validation
     * @var $routeParametersToValidate
     * @return array
     */

    protected $routeParametersToValidate = ['id' => 'feedback'];
    
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
            'id' => ['required', new ExistsId('feedbacks')],
            'type' => [
                'nullable',
                Rule::in(['bug_report', 'billing_problem', 'general_feedback'])
            ],
            'content' => ['nullable'],
            'email' => ['nullable'],
        ];
    }

    public function messages()
    {
        return [];
    }
}
