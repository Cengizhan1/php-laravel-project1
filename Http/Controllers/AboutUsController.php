<?php

namespace App\Http\Controllers;

use App\Http\Resources\AboutUs\AboutUsResource;
use App\Models\AboutUs;

class AboutUsController extends Controller
{
    public function show()
    {
        return $this->withErrorHandling(function ()  {
            return AboutUsResource::make(AboutUs::firstorfail());
        });
    }
}
