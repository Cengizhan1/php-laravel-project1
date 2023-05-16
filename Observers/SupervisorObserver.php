<?php

namespace App\Observers;

use App\Models\Supervisor;
use App\Models\User;

class SupervisorObserver
{
    /**
     * Handle the Supervisor "created" event.
     *
     * @param  \App\Models\Supervisor  $supervisor
     * @return void
     */
    public function created(Supervisor $supervisor)
    {
        //
    }

    /**
     * Handle the Supervisor "updated" event.
     *
     * @param  \App\Models\Supervisor  $supervisor
     * @return void
     */
    public function updated(Supervisor $supervisor)
    {
        //
    }

    /**
     * Handle the Supervisor "deleted" event.
     *
     * @param  \App\Models\Supervisor  $supervisor
     * @return void
     */
    public function deleting (Supervisor $supervisor)
    {
        $supervisor->meets()->update([
                "supervisor_id" => null,
            ]
        );
        $supervisor->competencies()->update([
                "supervisor_id" => null,
            ]
        );
        $supervisor->educations()->update([
                "supervisor_id" => null,
            ]
        );
        $supervisor->workingPrices()->update([
                "supervisor_id" => null,
            ]
        );
        $supervisor->workingHours()->update([
                "supervisor_id" => null,
            ]
        );
    }

    /**
     * Handle the Supervisor "restored" event.
     *
     * @param  \App\Models\Supervisor  $supervisor
     * @return void
     */
    public function restored(Supervisor $supervisor)
    {
        //
    }

    /**
     * Handle the Supervisor "force deleted" event.
     *
     * @param  \App\Models\Supervisor  $supervisor
     * @return void
     */
    public function forceDeleted(Supervisor $supervisor)
    {
        //
    }
}
