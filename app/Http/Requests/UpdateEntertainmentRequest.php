<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Enums\EntertainmentStatus;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEntertainmentRequest extends FormRequest
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
            'title' => ['required', 'string', Rule::unique('entertainments', 'title')->ignore($this->entertainment), 'max:150'],
            'url' => ['nullable', 'url', 'string'],
            'status' => ['required', Rule::in(array_column(EntertainmentStatus::cases(), 'value'))],
            'tags' => ['nullable', 'string'],
            'images.*' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }
}
