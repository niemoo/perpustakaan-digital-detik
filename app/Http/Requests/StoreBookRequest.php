<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => 'required',
            'title' => 'required|string',
            'description' => 'required|string',
            'amount' => 'required|numeric|min:0',
            'file' => 'required|file|mimes:pdf',
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
