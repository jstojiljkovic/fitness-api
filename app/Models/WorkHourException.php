<?php

namespace App\Models;

use App\Filters\WorkHourExceptionFilters;
use App\Models\Scopes\UserScope;
use App\Traits\ApplyUserTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkHourException extends Model
{
    use HasFactory, HasUuids, ApplyUserTrait;

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'work_hour_exception';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id', 'date', 'start', 'end'
    ];

    /**
     * @return void
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new UserScope());
    }

    /**
     * Get the user that owns the work-hour
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to include filters.
     *
     * @param $query
     * @param $data
     *
     * @return mixed
     */
    public function scopeFilter($query, $data): mixed
    {
        return ( new WorkHourExceptionFilters )->apply($query, $data);
    }
}
