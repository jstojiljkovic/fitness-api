<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Equipment
 *
 * @method static Builder|Equipment newModelQuery()
 * @method static Builder|Equipment newQuery()
 * @method static Builder|Equipment query()
 * @mixin Eloquent
 * @property string $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Organisation|null $organisation
 * @property-read \App\Models\User|null $user
 * @method static Builder|Equipment whereCreatedAt($value)
 * @method static Builder|Equipment whereId($value)
 * @method static Builder|Equipment whereName($value)
 * @method static Builder|Equipment whereUpdatedAt($value)
 */
class Equipment extends Model
{
    use HasFactory, HasUuids;

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
