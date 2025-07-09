<?php
namespace App\CRM\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'email'     => $this->email,
            'source'    => $this->source,
            'status'    => $this->status,
            'phone'     => $this->phone,
            'address'   => $this->address,
            'company'   => $this->company,
            'birthdate' => $this->birthdate,
            'notes'     => $this->whenLoaded('notes'),
        ];
    }
}