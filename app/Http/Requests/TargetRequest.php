<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TargetRequest extends FormRequest
{
   public function rules()
    {
        return [
            'target.target' => 'required|string|max:400',
        ];
    }
}
