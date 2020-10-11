<?php

namespace App\Http\Requests\Event;

use App\Helpers\FormRequest;
use App\Rules\ExistsId;

/**
 * @OA\Schema(
 *   schema="EventUpdateRequest",
 *   @OA\Property(
 *     property="name",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="coach_id",
 *     type="integer"
 *   ),
 *   @OA\Property(
 *     property="date",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="location",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="is_online",
 *     type="boolean"
 *   ),
 *   @OA\Property(
 *     property="is_free",
 *     type="boolean"
 *   ),
 *   @OA\Property(
 *     property="price",
 *     type="integer"
 *   )
 * )
 */
class EventUpdateRequest extends FormRequest
{
    /**
     * Add Id to request validation
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
            'id' => ['required', new ExistsId('events')],
            'name' => ['nullable'],
            'coach_id' => ['nullable'],
            'date' => ['nullable'],
            'location' => ['nullable'],
            'is_online' => ['nullable'],
            'is_free' => ['nullable'],
            'price' => ['nullable'],
        ];
    }

    public function messages()
    {
        return [];
    }
}
