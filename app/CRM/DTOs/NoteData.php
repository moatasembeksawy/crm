<?php
namespace App\CRM\DTOs;

class NoteData
{
    public function __construct(
        public readonly int $customer_id,
        public readonly string $content,
        public readonly int $user_id,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            $data['customer_id'],
            $data['content'],
            $data['user_id'],
        );
    }
}