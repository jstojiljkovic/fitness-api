<?php

namespace App\Models;

use App\Traits\ApplyOrganisationUserTrait;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\WorkHour
 *
 * @property string $id
 * @property string $user_id
 * @property int $day
 * @property string $start
 * @property string $end
 * @property int $available
 * @property-read User $user
 * @method static Builder|WorkHour newModelQuery()
 * @method static Builder|WorkHour newQuery()
 * @method static Builder|WorkHour query()
 * @method static Builder|WorkHour whereAvailable( $value )
 * @method static Builder|WorkHour whereDay( $value )
 * @method static Builder|WorkHour whereEnd( $value )
 * @method static Builder|WorkHour whereId( $value )
 * @method static Builder|WorkHour whereStart( $value )
 * @method static Builder|WorkHour whereUserId( $value )
 * @mixin Eloquent
 * @property string $organisation_id
 * @method static Builder|WorkHour whereOrganisationId( $value )
 */
class WorkHour extends Model
{
    use HasFactory, HasUuids, ApplyOrganisationUserTrait;

    /**
     * @var bool
     */
    public $timestamps = false;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'work_hour';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id', 'organisation_id', 'day', 'start',
        'end', 'available'
    ];

    /**
     * Get the organisation that owns the work-hour
     *
     * @return BelongsTo
     */
    public function organisation(): BelongsTo
    {
        return $this->belongsTo(Organisation::class);
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
}
