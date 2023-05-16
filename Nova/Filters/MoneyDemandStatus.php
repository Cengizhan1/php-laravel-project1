<?php

namespace App\Nova\Filters;

use Laravel\Nova\Filters\Filter;
use Laravel\Nova\Http\Requests\NovaRequest;

class MoneyDemandStatus extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'select-filter';


    /**
     * Apply the filter to the given query.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected $column;


    public function apply(NovaRequest $request, $query, $value)
    {
        return $query->where("status", (bool)$value);

    }


/**
 * Get the filter's available options.
 *
 * @param \Laravel\Nova\Http\Requests\NovaRequest $request
 * @return array
 */
public
function options(NovaRequest $request)
{
    $newOptions = [];
    $newOptions["Durumu onaylanan"] = true;
    $newOptions["Durumu onaylanmayan"] = false;
    return $newOptions;

}

public
function name(): string
{
    return "Durum Filtresi";
}

}
