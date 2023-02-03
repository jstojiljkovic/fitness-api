<?php

namespace App\Models;

use Database\Factories\StepFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Step
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
 * @property-read Video|null $video
 * @method static StepFactory factory( ...$parameters )
 * @method static Builder|Step newModelQuery()
 * @method static Builder|Step newQuery()
 * @method static Builder|Step query()
 * @method static Builder|Step whereCreatedAt( $value )
 * @method static Builder|Step whereDescription( $value )
 * @method static Builder|Step whereFilename( $value )
 * @method static Builder|Step whereId( $value )
 * @method static Builder|Step whereName( $value )
 * @method static Builder|Step whereOrganisationId( $value )
 * @method static Builder|Step whereSource( $value )
 * @method static Builder|Step whereThumbnail( $value )
 * @method static Builder|Step whereUpdatedAt( $value )
 * @method static Builder|Step whereUserId( $value )
 * @mixin Eloquent
 * @property string $video_id
 * @property string $start
 * @property string $end
 * @method static Builder|Step whereEnd( $value )
 * @method static Builder|Step whereStart( $value )
 * @method static Builder|Step whereVideoId( $value )
 */
class Step extends Model
{
    use HasFactory, HasUuids;

    /**
     * @var bool
     */
    public $timestamps = false;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'step';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'video_id', 'name',
        'description', 'start', 'end'
    ];

    /**
     * Get the video that owns the step
     *
     * @return BelongsTo
     */
    public function video(): BelongsTo
    {
        return $this->belongsTo(Video::class);
    }
}
