<?php

namespace App\CRM\Services;

use App\CRM\Models\Note;
use App\CRM\DTOs\NoteData;
use App\CRM\Models\Customer;
use Illuminate\Contracts\Auth\Authenticatable;
use App\CRM\Repositories\NoteRepositoryInterface;

class NoteService
{
    public function __construct(protected NoteRepositoryInterface $repo) {}

    public function create(NoteData $dto): ?Note
    {
        $customer = Customer::find($dto->customer_id);
        if (!$customer) {
            return null;
        }
        return $this->repo->create([
            'customer_id' => $dto->customer_id,
            'content'     => $dto->content,
            'user_id'     => $dto->user_id,
        ]);
    }

    public function delete(int $customerId, int $noteId, Authenticatable $user): bool
    {
        $note = $this->repo->findForCustomer($customerId, $noteId);
        if (!$note || $note->user_id !== $user->id) {
            return false;
        }
        return $this->repo->delete($note);
    }
}
