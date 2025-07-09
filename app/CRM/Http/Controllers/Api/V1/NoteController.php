<?php

namespace App\CRM\Http\Controllers\Api\V1;

use App\CRM\DTOs\NoteData;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use App\CRM\Services\NoteService;
use App\Http\Controllers\Controller;
use App\CRM\Http\Requests\Api\V1\NoteRequest;
use App\CRM\Http\Resources\Api\V1\NoteResource;

class NoteController extends Controller
{
    public function __construct(protected NoteService $service) {}

    public function store(NoteRequest $request, $customerId)
    {
        $dto = NoteData::fromArray([
            'customer_id' => $customerId,
            'content'     => $request->validated('content'),
            'user_id'     => $request->user()->id,
        ]);

        $note = $this->service->create($dto);
        
        if (!$note) {
            return ApiResponse::error('Customer not found', 404);
        }
        return ApiResponse::success(new NoteResource($note), 'Note added', 201);
    }

    public function destroy(Request $request, $customerId, $noteId)
    {
        $deleted = $this->service->delete($customerId, $noteId, $request->user());
        if (!$deleted) {
            return ApiResponse::error('Note not found or unauthorized', 404);
        }
        return ApiResponse::success(null, 'Note deleted');
    }
}
