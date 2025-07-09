<?php

namespace App\CRM\Repositories;

use App\CRM\Models\Note;

interface NoteRepositoryInterface
{
    public function create(array $data): Note;
    public function findForCustomer(int $customerId, int $noteId): ?Note;
    public function delete(Note $note): bool;
}
