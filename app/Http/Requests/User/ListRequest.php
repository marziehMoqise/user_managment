<?php

namespace App\Http\Requests\User;

use App\Http\Requests\ApiRequest;
use Illuminate\Validation\Rule;

class ListRequest extends ApiRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'nullable', 'string'],
            'email' => ['sometimes', 'string'],
            'country' => ['sometimes', 'string'],
            'currency' => ['sometimes', 'string'],
            'orderBy' => [Rule::in(['id', 'country', 'currency'])],
            'order' => [Rule::in(['asc', 'desc'])],
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */


    protected function prepareForValidation(): void
    {
        $this->merge([
            'orderBy' => $this->orderBy ?: 'id',
            'order' => strtolower($this->order) ?: 'desc',
        ]);
    }
}
