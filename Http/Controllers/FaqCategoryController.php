<?php

namespace App\Http\Controllers;

use App\Http\Resources\Faq\FaqCategoryResource;
use App\Http\Resources\Faq\FaqResource;
use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Http\Request;

class FaqCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->withErrorHandling(function ()  {
            return FaqCategoryResource::collection(FaqCategory::all());
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FaqCategory  $faqCategory
     * @return \Illuminate\Http\Response
     */
    public function show(FaqCategory $faqCategory)
    {
        return $this->withErrorHandling(function () use ($faqCategory) {
            return FaqResource::collection(Faq::where('faq_category_id',$faqCategory->id)->get());
        });
    }


}
