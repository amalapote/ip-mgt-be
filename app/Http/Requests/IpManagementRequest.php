<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ValidateIP;

class IpManagementRequest extends FormRequest
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
        return match ($this->method()) {
            'POST' => [
                'ip_address' => 'required|string|ip|unique:ip_management,ip_address',
                'label' => 'required|string|max:255',
                'comment' => 'required|string|max:500',
            ],
            'PUT', 'PATCH' => [
                'label' => 'required|string|max:255',
                'comment' => 'required|string|max:500',
            ],
            default => [],
        };
    }
}
