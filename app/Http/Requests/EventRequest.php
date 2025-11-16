<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() && $this->user()->role === 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        $isCreate = $this->routeIs('events.store');

        return [
            "title"           => [$isCreate ? 'required' : 'sometimes', 'string', 'max:100'],
            "description"     => [$isCreate ? 'required' : 'sometimes', 'string', 'max:255'],
            "location"        => [$isCreate ? 'required' : 'sometimes', 'string', 'max:100'],
            "date"            => [$isCreate ? 'required' : 'sometimes', 'date'],
            "available_seats" => [$isCreate ? 'required' : 'sometimes', 'integer', 'min:0'],
            "category_id"     => [$isCreate ? 'required' : 'sometimes', 'exists:categories,id'],
        ];
    }
}
