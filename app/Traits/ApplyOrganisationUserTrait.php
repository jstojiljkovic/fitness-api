<?php

namespace App\Traits;

use App\Helpers\ApplicationHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

trait ApplyOrganisationUserTrait
{
    /**
     * @return void
     */
    public static function bootApplyOrganisationUserTrait(): void
    {
        if (is_null(Auth::user())) {
            return;
        }

        static::creating(static function (Model $model) {
            $model->organisation_id = ApplicationHelper::activeOrganisation();
            $model->user_id = ApplicationHelper::activeUser();
        });
    }
}
