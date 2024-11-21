<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Shoe extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'thumbnail',
        'about',
        'price',
        'stock',
        'is_popular',
        'category_id',
        'brand_id',
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function photos(): HasMany
    {
        return $this->hasMany(ShoePhoto::class,);
    }
    public function sizes(): HasMany
    {
        return $this->hasMany(ShoeSize::class,);
    }
    protected static function boot()
{
    parent::boot();

    // Delete thumbnail and related photos when shoe is deleted
    static::deleting(function ($shoe) {
        // Delete the thumbnail if it exists
        if ($shoe->thumbnail && Storage::disk('public')->exists($shoe->thumbnail)) {
            Storage::disk('public')->delete($shoe->thumbnail);
        }

        // Delete related photos in ShoePhoto model
        foreach ($shoe->photos as $photo) {
            if ($photo->photo && Storage::disk('public')->exists($photo->photo)) {
                Storage::disk('public')->delete($photo->photo);
            }
            $photo->delete(); // Delete the ShoePhoto record itself
        }
    });

    // Delete old thumbnail before updating
    static::updating(function ($shoe) {
        if ($shoe->isDirty('thumbnail') && $shoe->getOriginal('thumbnail')) {
            Storage::disk('public')->delete($shoe->getOriginal('thumbnail'));
        }
    });
}
}
