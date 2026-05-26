<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'role' => ['required', Rule::in(config('roles'))],
        ];
    }

    public function validatedRoleData(): array
    {
        $data = $this->validated();

        return [
            'role' => $data['role'],
        ];
    }
}