<?php

namespace App\CRM\Customer\DTOs;

class CustomerData
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly ?string $phone,
        public readonly ?string $address,
        public readonly ?string $company,
        public readonly ?string $birthdate,
        public readonly ?string $source,
        public readonly ?string $status,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            $data['name'],
            $data['email'],
            $data['phone'] ?? null,
            $data['address'] ?? null,
            $data['company'] ?? null,
            $data['birthdate'] ?? null,
            $data['source'] ?? null,
            $data['status'] ?? null,
        );
    }
}
