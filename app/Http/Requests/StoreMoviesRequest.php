<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\Exceptions\HttpResponseException;


use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

use Illuminate\Support\Facades\Gate;


class StoreMoviesRequest extends FormRequest
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
            'title' => ['required', 'max:20'],
            'summary' =>  ['required', 'max:200'],
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg,webp|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',
            'rating' => 'numeric|min:3',
            'link' =>  ['required', 'max:100'],
        ];
        
    }

    public function failedValidation(Validator $validator)

    {

        throw new HttpResponseException(response()->json([

            'success'   => false,

            'status'   => 422,

            'message'   => 'Validation errors',

            'errors'      => $validator->errors()

        ]));

    }

    public function messages()

    {

        return [

            'title.required' => 'Title is required',
            'title.max' => 'Maximum character is 20',
            'rating.numeric' => 'Pls input number',
            'summary.required' => 'Summary is required',
            'summary.max' => 'Maximum character is 200',
            'rating.required' => 'Rating is required',
            'rating.min' => 'Pls provide minimum 3',
            'link.required' => 'Link is required',
            'link.max' => 'Maximum character is 100',
        ];

    }

}