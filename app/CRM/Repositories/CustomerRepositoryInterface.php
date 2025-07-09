<?php
namespace App\CRM\Repositories;

use App\CRM\Models\Customer;

interface CustomerRepositoryInterface
{
    public function all(?string $query = null);
    public function find(int $id): ?Customer;
    public function create(array $data): Customer;
    public function update(Customer $customer, array $data): bool;
    public function delete(Customer $customer): bool;
}