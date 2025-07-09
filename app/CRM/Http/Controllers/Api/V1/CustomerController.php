<?php

namespace App\CRM\Http\Controllers\Api\V1;

use App\CRM\Models\Customer;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CRM\Services\CustomerService;
use App\CRM\Customer\DTOs\CustomerData;
use App\CRM\Http\Requests\Api\V1\CustomerRequest;
use App\CRM\Http\Resources\Api\V1\CustomerResource;

class CustomerController extends Controller
{
    public function __construct(protected CustomerService $service) {}

    public function index(Request $request)
    {
        $query = $request->input('query');

        $customers = $this->service->list($query);

        return ApiResponse::success(CustomerResource::collection($customers));
    }

    public function show($id)
    {
        $customer = $this->service->get($id);
        if (!$customer) {
            return ApiResponse::error('Customer not found', 404);
        }
        return ApiResponse::success(new CustomerResource($customer));
    }

    public function store(CustomerRequest $request)
    {
        $dto = CustomerData::fromArray($request->validated());
        $customer = $this->service->create($dto);
        return ApiResponse::success(new CustomerResource($customer), 'Customer created', 201);
    }

    public function update(CustomerRequest $request, Customer $customer)
    {
        $this->service->update($customer, $request->validated());
        return ApiResponse::success(new CustomerResource($customer), 'Customer updated');
    }

    public function destroy(Customer $customer)
    {
        $this->service->delete($customer);
        return ApiResponse::success(null, 'Customer deleted');
    }
}
