<?php

namespace App\Http\Requests;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class BaseFormRequest extends FormRequest
{

    /**
     * Handle a failed validation attempt.
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $validErrors = [];
        foreach ((new ValidationException($validator))->errors() as $key => $errors) {
            foreach ($errors as $error) {
                $validErrors[] = $error;
            }
        }

        //$validErrors = (new ValidationException($validator))->errors();

        throw new HttpResponseException(
            (new ApiController)->validError($validErrors)
        );
    }
}
