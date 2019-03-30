<?php

namespace App\Http\Middleware;

use Closure;
use App\Note;

class NotePerrmissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Note $note, Closure $next)
    {
        if(auth()->user()->load(['user'])->user->id == $note->user_id)
          return $next($request);
        else
          return response()->json([ "message" => "Unauthorized"],401);
    }
}
