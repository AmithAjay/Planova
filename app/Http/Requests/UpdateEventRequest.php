<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'description' => 'required|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'max_participants' => 'nullable|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'ticket_price' => 'nullable|numeric|min:0',
            'event_type' => 'required|string|in:Online,Offline,Hybrid',
            'custom_fields' => 'nullable|string',
            'is_published' => 'nullable|boolean',
            'organizing_departments' => 'nullable|array',
            'organizing_departments.*' => 'string',
            'is_open_to_all' => 'required|boolean',
            'eligible_departments' => 'nullable|array|required_if:is_open_to_all,false',
            'eligible_departments.*' => 'string',
        ];
    }
}
