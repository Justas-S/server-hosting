<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SampConfigStore extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->has('rcon_password') && !$this->session()->has('double_auth')) {
            return false;
        }
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
            'language'  => 'required',
            'mapname'   => 'required',
            'maxnpc'    => 'required|numeric',
            'rcon_password' => 'min:5',
        ];
    }
}
