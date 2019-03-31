<?php

namespace App\Http\Controllers;

use App\Note;
use App\User;
use App\Http\Requests\NoteCreatedRequest;
use App\Http\Requests\NoteUpdatedRequest;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    
     public function __construct(){
         $this->middleware('note.perrmission',[ "only" => ["show","delete"] ]);
     }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NoteCreatedRequest $request)
    {
        if(auth()->user()->load(['user'])->user == null)
         User::create([ 'social_user_id' => auth()->id() ]);
       $note = Note::create([
         "title" => $request->input('title'),
         "content" => $request->input('content'),
         "user_id" => auth()->user()->load(['user'])->user->id
       ]);
      
       return response()->json([ "data" => $note ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        return response()->json([ "data" => $note ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(NoteUpdatedRequest $request, Note $note)
    {
        $note->update([
          "title" => ($request->filled('title')) ? $request->input('title') : $note->title,
          "content" => ($request->filled('content')) ? $request->input('content') : $note->content
        ]);

        return response()->json([ "data" => $note ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        $deleted = $note->delete();

        response()->json([ "deleted" => $deleted ]);
    }
}
