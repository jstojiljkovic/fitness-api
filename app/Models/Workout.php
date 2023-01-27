<?php

namespace App\Models;

use App\Models\Scopes\OrganisationScope;
use App\Traits\ApplyOrganisationUserTrait;
use Database\Factories\WorkoutFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Workout
 *
 * @property-read Collection|Equipment[] $equipments
 * @property-read int|null $equipments_count
 * @property-read Organisation $organisation
 * @property-read User $user
 * @property-read Video $video
 * @method static WorkoutFactory factory( ...$parameters )
 * @method static Builder|Workout newModelQuery()
 * @method static Builder|Workout newQuery()
 * @method static Builder|Workout query()
 * @mixin Eloquent
 */
class Workout extends Model
{
    use HasFactory, HasUuids, ApplyOrganisationUserTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'workout';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'organisation_id', 'user_id', 'video_id', 'name',
        'description', 'filename', 'thumbnail'
    ];

    /**
     * @return void
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new OrganisationScope());
    }

    /**
     * Get the organisation that owns the workout
     *
     * @return BelongsTo
     */
    public function organisation(): BelongsTo
    {
        return $this->belongsTo(Organisation::class);
    }

    /**
     * Get the user that owns the workout
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the video that owns the workout
     *
     * @return BelongsTo
     */
    public function video(): BelongsTo
    {
        return $this->belongsTo(Video::class);
    }

    /**
     * The equipments that belong to the workout
     *
     * @return BelongsToMany
     */
    public function equipments(): BelongsToMany
    {
        return $this->belongsToMany(Equipment::class);
    }
}
