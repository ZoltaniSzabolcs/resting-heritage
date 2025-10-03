<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Person extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'persons';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'grave_id',
        'first_name',
        'last_name',
        'initials',
        'birth_date',
        'death_date',
        'birth_place',
        'death_place',
        'biography',
        'occupation',
        'image_url'
    ];

    protected $attributes = [
        'first_name' => '',
        'last_name' => '',
        'initials' => '',
        'birth_place' => '',
        'death_place' => '',
        'biography' => '',
        'occupation' => '',
        'image_url' => '',
    ];

    public function grave() : HasOne
    {
        return $this->hasOne(Grave::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string)Str::uuid();
        });
    }

}
