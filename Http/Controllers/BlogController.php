<?php

namespace App\Http\Controllers;

use App\Http\Resources\Blog\BlogIndexResource;
use App\Models\Blog;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->withErrorHandling(function ()  {
            return BlogIndexResource::collection(Blog::all());
        });
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        return $this->withErrorHandling(function () use ($blog) {
            return BlogIndexResource::make($blog);
        });
    }

}
