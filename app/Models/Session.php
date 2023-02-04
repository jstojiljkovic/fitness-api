<?php

namespace App\Models;

use App\Enums\SessionStatusEnum;
use App\Models\Scopes\OrganisationScope;
use App\Traits\ApplyOrganisationUserTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Session extends Model
{
    use HasFactory, HasUuids, ApplyOrganisationUserTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'session';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'workout_id', 'organisation_id', 'created_by',
        'scheduled', 'start', 'end', 'status',
        'capacity', 'used', 'remark'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'status' => SessionStatusEnum::class,
    ];

    /**
     * @return void
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new OrganisationScope());
    }

    /**
     * Get the workout that owns the session
     *
     * @return BelongsTo
     */
    public function workout(): BelongsTo
    {
        return $this->belongsTo(Workout::class);
    }

    /**
     * Get the organisation that owns the session
     *
     * @return BelongsTo
     */
    public function organisation(): BelongsTo
    {
        return $this->belongsTo(Organisation::class);
    }

    /**
     * Get the user that owns the session
     *
     * @return BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The users that belong to the session
     *
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
