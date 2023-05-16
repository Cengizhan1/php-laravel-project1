<?php

namespace App\Http\Controllers;

use App\Http\Resources\Category\CategoryIndexResource;
use App\Http\Resources\Category\CategoryShowResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->withErrorHandling(function ()  {
            return CategoryIndexResource::collection(Category::where('category_id',null)->get());
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return $this->withErrorHandling(function () use ($category)  {
            return CategoryShowResource::collection(Category::where('category_id',$category->id)->get());
        });
    }

}
