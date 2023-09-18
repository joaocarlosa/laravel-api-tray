<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'seller_id' => $this->seller_id,
            'value' => $this->value,
            'commission' => $this->commission,
            'sale_date' => $this->sale_date,
        ];
    }

}
