<?php

namespace Botble\Elafcart\Http\Requests;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class ElafcartRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:250'],
            'description' => ['nullable', 'string', 'max:400'],
            'content' => ['nullable', 'string'],
            'status' => Rule::in(BaseStatusEnum::values()),
            'image' => ['nullable', 'string'],
        ];
    }
}
