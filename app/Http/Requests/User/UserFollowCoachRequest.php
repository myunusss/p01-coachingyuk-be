<?php

namespace App\Http\Requests\Question;

use App\Helpers\FormRequest;
use App\Rules\ExistsId;
use App\Rules\ExistsSlug;

/**
 * @OA\Schema(
 *   schema="UserFollowCoachRequest",
 *   @OA\Property(
 *     property="coach_id",
 *     type="integer"
 *   )
 * )
 */
class UserFollowCoachRequest extends FormRequest
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
            'coach_id' => ['required', new ExistsId('users')],
        ];
    }

    public function messages()
    {
        return [];
    }
}
