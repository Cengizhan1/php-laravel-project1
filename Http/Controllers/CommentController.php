<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\CommentRequest;
use App\Http\Resources\Comment\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->withErrorHandling(function (){
            $user = auth()->user();
            $comments = $user->supervisor_active ? Comment::where('supervisor_id',$user->activeId)->get() : Comment::where('user_id',$user->activeId)->get();
            return response()->success(0,null, CommentResource::collection($comments),201);
        });
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        return $this->withErrorHandling(function () use ($comment) {
            return CommentResource::make($comment);
        });
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request)
    {
        return $this->withErrorHandling(function () use ($request) {
            $comment = Comment::create([
                'user_id'=>auth()->user()->id,
                'supervisor_id'=>$request->supervisor_id,
                'meet_id'=>$request->meet_id,
                'date'=>now(),
                'comment'=>$request->comment,
                'star'=>$request->star,
            ]);
            return response()->success(0, null, $comment->id, 201);
        });
    }

}
