<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Http\Resources\NoteResource;
use App\Http\Resources\NoteCollection;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Services\NoteService;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(NoteService $noteService)
    {
        // Get login user
        $user = request()->user();
        $metadata = null;

        // Get all items for user, admin or super admin
        if($user && ($user->roleHas('admin') || $user->roleHas('super-admin'))){
            $notes = Note::with('user')->paginate(20);
        }else{
            $notes = Note::where('user_id', $user->id)->with('user')->paginate(20);
        }

        // Transform the items
        if($notes->count() >= 2){
            $notes = NoteResource::collection($notes);
        }else{
            $notes = new NoteResource($notes);
        }
        $metadata = $noteService->getMetadata($notes) ?? null;

        // Return response
        return $this->sendSuccess($notes, 'Notes fetched', 201, $metadata);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNoteRequest $request)
    {
        $data = $request->all();
        $user =  request()->user();
        $data['user_id'] = $user->id;

        $note = Note::create($data);
        $note->load('user');
        $note = new NoteResource($note);
        return $this->sendSuccess($note, 'Note created successfully', 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        // Load user relationship
        $note->load('user');
        $note = new NoteResource($note);
        return $this->sendSuccess($note, 'Note fetched', 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNoteRequest $request, Note $note)
    {
        $user = request()->user();
        if(($user->id != $note->user_id) || (!$user->roleHas('admin')) || (!$user->roleHas('super-admin'))){
            return $this->sendError([], 'Unauthorized access', 401);
        }

        $note->update($request->only(['title', 'content']));
        $note->load('user');
        $note = new NoteResource($note);

        return $this->sendSuccess($note, 'Note updated successfully', 201);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        $note->delete();
        return $this->sendSuccess([], 'Note deleted successfully', 201);

    }
}
