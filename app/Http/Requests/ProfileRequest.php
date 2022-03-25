<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'min:1'],
            'last_name' => ['required', 'min:1'],
            'address' => ['required', 'min:3'],
            'city' => ['required', 'min:3'],
            'zip_code' => ['required', 'min:3'],
            'country' => ['required'],
            'mobile' => ['required','digits:10'],
            'email' => ['required', 'email', Rule::unique((new User)->getTable())->ignore(auth()->id())],
        ];
    }
}
