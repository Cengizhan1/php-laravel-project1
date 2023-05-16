<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\NovaRequest;

class ChangeStatusDemand extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        foreach ($models as $model){
            $model->update([
               "status"=>true
            ]);
        }
        return Action::message("İşlem Başarıyla Gerçekleşti");
    }

    public function fields(NovaRequest $request)
    {
        return [];
    }
//    public $onlyOnIndex = true;
//
//    /**
//     * Indicates if this action is only available on the resource detail view.
//     *
//     * @var bool
//     */
//    public $onlyOnDetail = true;
}
