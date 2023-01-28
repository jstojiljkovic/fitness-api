<?php

namespace App\Models;

use App\Models\Scopes\OrganisationScope;
use App\Traits\ApplyOrganisationUserTrait;
use Database\Factories\EquipmentFactory;
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
 * App\Models\Equipment
 *
 * @method static Builder|Equipment newModelQuery()
 * @method static Builder|Equipment newQuery()
 * @method static Builder|Equipment query()
 * @mixin Eloquent
 * @property string $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Organisation|null $organisation
 * @property-read User|null $user
 * @method static Builder|Equipment whereCreatedAt( $value )
 * @method static Builder|Equipment whereId( $value )
 * @method static Builder|Equipment whereName( $value )
 * @method static Builder|Equipment whereUpdatedAt( $value )
 * @property string $organisation_id
 * @property string $user_id
 * @property string $description
 * @property string $filename
 * @property string|null $thumbnail
 * @method static Builder|Equipment whereDescription( $value )
 * @method static Builder|Equipment whereFilename( $value )
 * @method static Builder|Equipment whereOrganisationId( $value )
 * @method static Builder|Equipment whereThumbnail( $value )
 * @method static Builder|Equipment whereUserId( $value )
 * @method static EquipmentFactory factory( ...$parameters )
 * @property-read Collection|Workout[] $workouts
 * @property-read int|null $workouts_count
 */
class Equipment extends Model
{
    use HasFactory, HasUuids, ApplyOrganisationUserTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'equipment';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'organisation_id', 'user_id', 'name',
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
     * Get the organisation that owns the equipment
     *
     * @return BelongsTo
     */
    public function organisation(): BelongsTo
    {
        return $this->belongsTo(Organisation::class);
    }

    /**
     * Get the user that owns the equipment
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The workouts that belong to the equipment
     *
     * @return BelongsToMany
     */
    public function workouts(): BelongsToMany
    {
        return $this->belongsToMany(Workout::class);
    }
}
