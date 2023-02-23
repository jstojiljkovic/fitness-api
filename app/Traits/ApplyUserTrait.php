<?php

namespace App\Traits;

use App\Helpers\ApplicationHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

trait ApplyUserTrait
{
    /**
     * @return void
     */
    public static function bootApplyUserTrait(): void
    {
        if (!Auth::check()) {
            return;
        }

        static::creating(static function (Model $model) {
            $model->user_id = ApplicationHelper::activeUser();
        });
    }
}
