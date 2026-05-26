<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $category = $this->route('category');

        $rules = [
            'ten_loai' => ['required', 'string', 'max:255'],
            'id_cha' => ['nullable', 'integer', Rule::exists('theloai', 'id_loai')],
        ];

        if ($category) {
            $rules['id_cha'][] = Rule::notIn([$category->id_loai]);
        }

        return $rules;
    }
}