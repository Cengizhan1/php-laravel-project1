<?php

namespace App\Nova;

use App\Enums\WalletTransactionEnum;
use App\Nova\Metrics\WalletTransactionApprovedPrice;
use App\Nova\Metrics\WalletTransactionTotalPrice;
use App\Nova\Metrics\WalletTransactionUnapprovedPrice;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class WalletTransaction extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\WalletTransaction>
     */
    public static $model = \App\Models\WalletTransaction::class;

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


    /**
     * Get the fields displayed by the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            Currency::make("Ücret", "price"),
//            Number::make("Aktarım Durumu", "transaction_result"),
            Select::make("Aktarım Durumu","transaction_result")->options(WalletTransactionEnum::toArray()),
            Date::make("Tarih", "date"),
            Text::make("Mesaj", "message"),
            MorphTo::make("senderable")->types([
                User::class
            ]),
            MorphTo::make("recipientable")->types([Supervisor::class]),
            BelongsTo::make("meet"),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [
            new WalletTransactionTotalPrice(),
            new WalletTransactionApprovedPrice(),
            new WalletTransactionUnapprovedPrice(),
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
        return [];
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
        return [];
    }
}
