<?php

namespace App\Models;

use App\Models\Scopes\OrganisationScope;
use App\Traits\ApplyOrganisationUserTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Organisation $organisation
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Video newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Video newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Video query()
 * @method static \Illuminate\Database\Eloquent\Builder|Video whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video whereOrganisationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video whereThumbnail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video whereUserId($value)
 * @mixin \Eloquent
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
}
