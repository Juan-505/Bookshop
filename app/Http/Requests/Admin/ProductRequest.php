<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tensach' => ['required', 'string', 'max:255'],
            'hinh' => ['nullable', 'string', 'max:255'],
            'id_loai' => ['required', 'integer', Rule::exists('theloai', 'id_loai')],
            'dongia' => ['required', 'integer', 'min:0'],
            'hangton' => ['required', 'integer', 'min:0'],
            'daban' => ['required', 'integer', 'min:0'],
            'ngaynhap' => ['nullable', 'date'],
            'giamgia' => ['nullable', 'integer', 'min:0', 'max:100'],
            'nhacungcap' => ['nullable', 'string', 'max:255'],
            'tacgia' => ['nullable', 'string', 'max:255'],
            'nxb' => ['nullable', 'string', 'max:255'],
            'namxb' => ['nullable', 'integer', 'min:0', 'max:9999'],
            'trongluong' => ['nullable', 'integer', 'min:0'],
            'sotrang' => ['nullable', 'integer', 'min:0'],
            'mota' => ['nullable', 'string'],
            'hinhthuc' => ['nullable', 'string', 'max:100'],
        ];
    }
}