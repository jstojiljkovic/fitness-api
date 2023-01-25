<?php

namespace App\Traits;

use App\Helpers\ApplicationHelper;
use Illuminate\Database\Eloquent\Model;

trait ApplyOrganisationUserTrait
{
    /**
     * @return void
     */
    public static function bootApplyOrganisationUserTrait(): void
    {
        static::creating(static function (Model $model) {
            $model->organisation_id = ApplicationHelper::activeOrganisation();
            $model->user_id = ApplicationHelper::activeUser();
        });
    }
}
