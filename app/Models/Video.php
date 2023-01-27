<?php

namespace App\Models;

use App\Models\Scopes\OrganisationScope;
use App\Traits\ApplyOrganisationUserTrait;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Video
 *
 * @property string $id
 * @property string $organisation_id
 * @property string $user_id
 * @property string $name
 * @property string $description
 * @property string $source
 * @property string $filename
 * @property string|null $thumbnail
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Organisation $organisation
 * @property-read User $user
 * @method static Builder|Video newModelQuery()
 * @method static Builder|Video newQuery()
 * @method static Builder|Video query()
 * @method static Builder|Video whereCreatedAt( $value )
 * @method static Builder|Video whereDescription( $value )
 * @method static Builder|Video whereFilename( $value )
 * @method static Builder|Video whereId( $value )
 * @method static Builder|Video whereName( $value )
 * @method static Builder|Video whereOrganisationId( $value )
 * @method static Builder|Video whereSource( $value )
 * @method static Builder|Video whereThumbnail( $value )
 * @method static Builder|Video whereUpdatedAt( $value )
 * @method static Builder|Video whereUserId( $value )
 * @mixin Eloquent
 * @property-read Collection|Step[] $steps
 * @property-read int|null $steps_count
 * @property-read Collection|Workout[] $workouts
 * @property-read int|null $workouts_count
 */
class Video extends Model
{
    use HasFactory, HasUuids, ApplyOrganisationUserTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'video';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'organisation_id', 'user_id', 'name',
        'description', 'source', 'filename', 'thumbnail'
    ];

    /**
     * @return void
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new OrganisationScope());
    }

    /**
     * Get the organisation that owns the video
     *
     * @return BelongsTo
     */
    public function organisation(): BelongsTo
    {
        return $this->belongsTo(Organisation::class);
    }

    /**
     * Get the user that owns the video
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the workouts for the video
     *
     * @return HasMany
     */
    public function workouts(): HasMany
    {
        return $this->hasMany(Workout::class);
    }

    /**
     * Get the steps for the video
     *
     * @return HasMany
     */
    public function steps(): HasMany
    {
        return $this->hasMany(Step::class);
    }
}
