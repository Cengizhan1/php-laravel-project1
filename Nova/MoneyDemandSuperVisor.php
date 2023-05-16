<?php

namespace App\Nova;

use App\Nova\Actions\ChangeStatusDemand;
use App\Nova\Filters\DateEndAtFilter;
use App\Nova\Filters\DateStartAtFilter;
use App\Nova\Filters\MoneyDemandStatus;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Http\Requests\NovaRequest;
use Waynestate\Nova\CKEditor4Field\CKEditor;

class MoneyDemandSuperVisor extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\MoneyDemandSuperVisor>
     */
    public static $model = \App\Models\MoneyDemand::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];
    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->where('requester_type', "App\Models\Supervisor");
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            ID::make()->sortable(),
            Currency::make("Talep Edilen Fiyat", "demanded_price"),
//            Number::make("demand_reason_id"),
            Number::make("demand_reason_id")->default(0),
            Date::make("Tarih", "date"),
            MorphTo::make("requestable")->nullable()->types([
//                User::class,
                Supervisor::class,
            ]),
            CKEditor::make("Message", "message"),
            Boolean::make("status")
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [
            new ChangeStatusDemand(),
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [
            new MoneyDemandStatus(),
            new DateStartAtFilter(),
            new DateEndAtFilter(),];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [
            new ChangeStatusDemand()
        ];
    }
}
