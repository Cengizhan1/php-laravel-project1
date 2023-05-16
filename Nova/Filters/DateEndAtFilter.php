<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\DateFilter;
use Laravel\Nova\Filters\Filter;


class DateEndAtFilter extends DateFilter
{

    public function name()
    {
        return "Bitiş Tarihi";
    }

    public function apply(Request $request, $query, $value)
    {
        return $query->whereDate('date','=<',$value);
    }
}
