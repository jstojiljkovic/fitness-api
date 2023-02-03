<?php

namespace App\Models;

use Database\Factories\OrganisationFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Organisation
 *
 * @property-read Collection|User[] $users
 * @property-read int|null $users_count
 * @method static OrganisationFactory factory( ...$parameters )
 * @method static Builder|Organisation newModelQuery()
 * @method static Builder|Organisation newQuery()
 * @method static Builder|Organisation query()
 * @mixin Eloquent
 * @property string $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Organisation whereCreatedAt( $value )
 * @method static Builder|Organisation whereId( $value )
 * @method static Builder|Organisation whereName( $value )
 * @method static Builder|Organisation whereUpdatedAt( $value )
 * @property-read Collection|Equipment[] $equipments
 * @property-read int|null $equipments_count
 * @property-read Collection|Video[] $videos
 * @property-read int|null $videos_count
 * @property-read Collection|Workout[] $workouts
 * @property-read int|null $workouts_count
 */
class Organisation extends Model
{
    use HasFactory, HasUuids;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'organisation';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Get the users for the organisation
     *
     * @return HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the equipments for the organisation
     *
     * @return HasMany
     */
    public function equipments(): HasMany
    {
        return $this->hasMany(Equipment::class);
    }

    /**
     * Get the videos for the organisation
     *
     * @return HasMany
     */
    public function videos(): HasMany
    {
        return $this->hasMany(Video::class);
    }

    /**
     * Get the workouts for the organisation
     *
     * @return HasMany
     */
    public function workouts(): HasMany
    {
        return $this->hasMany(Workout::class);
    }

    /**
     * Get the work-hours for the organisation
     *
     * @return HasMany
     */
    public function workHours(): HasMany
    {
        return $this->hasMany(WorkHour::class);
    }
}
