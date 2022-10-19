<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class ClientsRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "names" => "required|string",
            "gender" => "required|string",
            "phonenumber" => "required|string",
            "nid" => "required|integer",
            "salary" => "required|string",
            "commitment" => "required|string",
            "amountAllowed" => "required|integer",
            "district" => "required|string",
            "sector" => "required|string",
            "company" => "required|string",
            "position" => "required|string",
            "other",
            "status"
        ];
    }

      /**
     * Handle a failed validation attempt.
     *
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator $validator): void
    {
        if ($validator->fails()) {
            throw new HttpResponseException(response()
                ->json(
                    [
                        "errors" => $validator->errors()->all()
                    ],
                    Response::HTTP_UNPROCESSABLE_ENTITY
                ));
        }
    }
}
