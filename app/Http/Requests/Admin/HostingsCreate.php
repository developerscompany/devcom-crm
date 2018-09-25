<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class HostingsCreate extends FormRequest
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
            'id' => 'nullable',
            'name' => 'min:2|max:25|required|string',
            'last_name' => 'min:2|max:25|required|string',
            'second_name' => 'min:2|max:25|required|string',
            'site' => 'min:2|max:50|required|string',
            'phone' => 'min:6|max:15|required',
        ];
    }
}
