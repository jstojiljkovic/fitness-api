<?php

namespace App\Models;

use App\Enums\WorkoutIntensityEnum;
use App\Enums\WorkoutLevelEnum;
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
use Illuminate\Support\Carbon;

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
 * @property string $id
 * @property string $organisation_id
 * @property string $user_id
 * @property string $video_id
 * @property string $name
 * @property string $description
 * @property string $filename
 * @property string $thumbnail
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Workout whereCreatedAt( $value )
 * @method static Builder|Workout whereDescription( $value )
 * @method static Builder|Workout whereFilename( $value )
 * @method static Builder|Workout whereId( $value )
 * @method static Builder|Workout whereName( $value )
 * @method static Builder|Workout whereOrganisationId( $value )
 * @method static Builder|Workout whereThumbnail( $value )
 * @method static Builder|Workout whereUpdatedAt( $value )
 * @method static Builder|Workout whereUserId( $value )
 * @method static Builder|Workout whereVideoId( $value )
 * @property int $duration
 * @property WorkoutIntensityEnum $intensity
 * @property WorkoutLevelEnum $level
 * @method static Builder|Workout whereDuration( $value )
 * @method static Builder|Workout whereIntensity( $value )
 * @method static Builder|Workout whereLevel( $value )
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
        'description', 'filename', 'thumbnail', 'intensity',
        'level', 'duration'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'intensity' => WorkoutIntensityEnum::class,
        'level' => WorkoutLevelEnum::class
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
