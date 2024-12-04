<?php

namespace App\Http\Requests\order;

use App\Http\Requests\util_request\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class PayOrderRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return false;
    }

    public function rules(): array
    {
        return [
            'voucher_serie_id' => 'required|integer|exists:voucher_series,id',
            'issuance_date' => 'date|nullable',
            'expiration_date' => 'date|after_or_equal:issuance_date|nullable',
            'payment_type' => 'string|nullable',
            'commentary' => 'string|nullable',
            'payment_methods' => 'array|nullable',
            'payment_methods.*' => 'string|max:50|exists:payment_methods,name',
            'amounts' => 'array|nullable',
            'amounts.*' => 'decimal:0,2|min:0',
            'commentary' => 'string|max:255|nullable'
        ];
    }
}
