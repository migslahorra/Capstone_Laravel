<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'price_range',
        'area',
        'address',         
        'street',
        'purok',
        'city',
        'province',
        'country',
        'postal_code',
        'status',
        'images',
    ];

    /**
     * Cast attributes to native types.
     */
    protected $casts = [
        'images' => 'array',
    ];

    /**
     * Get the user that owns the property.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Accessor for image URLs.
     */
    public function getImageUrlsAttribute()
    {
        return array_map(function ($filename) {
            return asset('uploads/' . $filename);
        }, $this->images ?? []);
    }
}