<?php

namespace App\CRM\Services;

use App\CRM\Models\Customer;
use App\CRM\Customer\DTOs\CustomerData;
use App\CRM\Repositories\CustomerRepositoryInterface;

class CustomerService
{
    public function __construct(protected CustomerRepositoryInterface $repo) {}

    public function list(?string $query = null)
    {
        return $this->repo->all($query);
    }

    public function get(int $id): ?Customer
    {
        return $this->repo->find($id);
    }

    public function create(CustomerData $dto): Customer
    {
        return $this->repo->create([
            'name'      => $dto->name,
            'email'     => $dto->email,
            'phone'     => $dto->phone,
            'address'   => $dto->address,
            'company'   => $dto->company,
            'birthdate' => $dto->birthdate,
            'source'    => $dto->source,
            'status'    => $dto->status,
        ]);
    }

    public function update(Customer $customer, array $data): bool
    {
        return $this->repo->update($customer, $data);
    }

    public function delete(Customer $customer): bool
    {
        return $this->repo->delete($customer);
    }
}
