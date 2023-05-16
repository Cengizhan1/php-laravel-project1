<?php

namespace App\Nova;

use App\Enums\MeetStatusEnum;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Meet extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Meet>
     */
    public static $model = \App\Models\Meet::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'code';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];
    public static function authorizedToCreate(\Illuminate\Http\Request $request)
    {
        return false;
    }

    public function authorizedToUpdate(\Illuminate\Http\Request $request): bool
    {
        return false;
    }

    public function authorizedToDelete(Request $request): bool
    {
        return false;
    }

    public function authorizedToReplicate(Request $request): bool
    {
        return false;
    }

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
            BelongsTo::make("user")->nullable(),
            BelongsTo::make( "supervisor"),
            BelongsTo::make("category"),
            Date::make("Başlangıç Tarihi", "start_at"),
            Date::make("Bitiş Tarihi", "end_at"),
            Currency::make("Ücret", "price"),
            Select::make("Durum","status")->options(MeetStatusEnum::toArray()),
            Boolean::make("Süpervizör Onayı", "supervisor_approval"),
            Text::make("İptal Türü", "canceled_by_type"),
            Text::make("Mesaj", "message"),
            Number::make("İptal id", "canceled_by_id"),
            Boolean::make("Kullanıcı Onayı", "user_approval"),
            Number::make("İptal Edilen Tutarı", "canceled_count"),
            Text::make("İptal Mesajı", "canceled_message"),
            Text::make("Kod", "code"),

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
        return [];
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
