<?php

namespace App\CRM\Repositories;

use App\CRM\Models\Note;

class NoteRepository implements NoteRepositoryInterface
{
    public function create(array $data): Note
    {
        return Note::create($data);
    }

    public function findForCustomer(int $customerId, int $noteId): ?Note
    {
        return Note::where('customer_id', $customerId)->where('id', $noteId)->first();
    }

    public function delete(Note $note): bool
    {
        return $note->delete();
    }
}
