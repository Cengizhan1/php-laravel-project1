<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\DateFilter;
class DateStartAtFilter extends DateFilter
{

    public function name()
    {
        return "Başlangıç Tarihi";
    }

    public function apply(Request $request, $query, $value)
    {
        return $query->whereDate('date','>=',$value);
    }
}
