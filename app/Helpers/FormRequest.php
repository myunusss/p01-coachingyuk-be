<?php

namespace App\Helpers;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest as LaravelFormRequest;
use App\Helpers\APIResponse;

class FormRequest extends LaravelFormRequest
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
            //
        ];
    }

    public function all($keys = null)
    {
        $data = parent::all();

        // ini buat masukin parameter yang di route ke request
        if (isset($this->routeParametersToValidate)) {
            foreach ($this->routeParametersToValidate as $validationDataKey => $routeParameter) {
                $data[$validationDataKey] = $this->route($routeParameter);
            }
        }

        // ini buat masukin parameter query ke request
        if (isset($this->queryParametersToValidate)) {
            foreach ($this->queryParametersToValidate as $validationDataKey => $queryParameter) {
                $data[$validationDataKey] = $this->query($queryParameter);
            }
        }

        return $data;
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        if (isset($errors['uuid'])) {
            $code = NOT_FOUND_CODE;
        } else {
            $code = UNPROCESSABLE_ENTITY_CODE;
        }
        throw new HttpResponseException(
            APIResponse::json(['message' => $errors], $code)
        );
    }

    protected function failedAuthorization()
    {
        throw new HttpResponseException(
            APIResponse::json(['message' => NOT_FOUND_STATUS], NOT_FOUND_CODE)
        );
    }

    public function messages()
    {
        return [];
    }
}
