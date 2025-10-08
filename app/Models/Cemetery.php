<?php

namespace App\Models;

use Clickbar\Magellan\Cast\GeometryCast;
use Clickbar\Magellan\Data\Geometries\MultiPolygon;
use Clickbar\Magellan\Data\Geometries\Point;
use Clickbar\Magellan\Data\Geometries\Polygon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Cemetery extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'cemeteries';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'city',
        'description',
        'boundary',
        'entrance',
        'center'
    ];

    protected $attributes = [
        'name' => '',
        'city' => '',
        'description' => '',
    ];

    protected $casts = [
        'boundary' => GeometryCast::class . ':' . Polygon::class,
        'entrance' => Point::class,
        'center' => Point::class,
    ];


    protected array $postgisColumns = [
        'boundary' => [
            'type' => 'geometry',
            'srid' => 4326,
        ],
    ];

    public function graves(): HasMany
    {
        return $this->hasMany(Grave::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string)Str::uuid();
        });
    }

}
