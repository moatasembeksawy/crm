<?php
namespace App\CRM\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class NoteResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'          => $this->id,
            'customer_id' => $this->customer_id,
            'content'     => $this->content,
            'user_id'     => $this->user_id,
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at,
        ];
    }
}