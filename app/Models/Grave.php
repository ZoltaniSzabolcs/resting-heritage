<?php

namespace App\Models;

use Clickbar\Magellan\Data\Geometries\Point;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Grave extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'graves';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'cemetery_id',
        'name',
        'location'
    ];

    protected $attributes = [
        'name' => '',
    ];

    protected $casts = [
        'location' => Point::class,
    ];

    protected array $postgisColumns = [
        'location' => [
            'type' => 'geometry',
            'srid' => 4326,
        ],
    ];

    public function cemetery() : BelongsTo
    {
        return $this->belongsTo(Cemetery::class);
    }

    public function persons() : HasMany
    {
        return $this->hasMany(Person::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string)Str::uuid();
        });
    }

}
