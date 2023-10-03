<?php

namespace App\Http\Requests\Admin\CallLog;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreCallLog extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('admin.call-log.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'caller_phonenumber' => ['nullable', 'string'],
            'callee_phonenumber' => ['nullable', 'string'],
            'call_id' => ['nullable', 'string'],
            'user_id' => ['required', 'integer'],
            
        ];
    }
}
