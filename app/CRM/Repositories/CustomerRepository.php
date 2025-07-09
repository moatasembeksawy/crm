<?php

namespace App\CRM\Repositories;

use App\CRM\Models\Customer;
use App\CRM\Enums\CustomerSource;
use App\CRM\Enums\CustomerStatus;

class CustomerRepository implements CustomerRepositoryInterface
{
    public function all(?string $query = null)
    {
        $builder = Customer::with('notes');

        if ($query) {
            // Use lower-case search for better index usage and performance
            $query = strtolower($query);

            $builder->where(function ($q) use ($query) {
                $q->where('name', 'like', "%$query%");

                if (in_array($query, CustomerSource::getValues())) {
                    $q->orWhere('source', $query);
                }
                if (in_array($query, CustomerStatus::getValues())) {
                    $q->orWhere('status', $query);
                }
            });
        }
        return $builder->paginate(10);
    }

    public function find(int $id): ?Customer
    {
        return Customer::with('notes')->find($id);
    }

    public function create(array $data): Customer
    {
        return Customer::create($data);
    }

    public function update(Customer $customer, array $data): bool
    {
        return $customer->update($data);
    }

    public function delete(Customer $customer): bool
    {
        return $customer->delete();
    }
}
