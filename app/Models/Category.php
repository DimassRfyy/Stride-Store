<?php

namespace App\Models;

use App\Models\Shoe;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'icon',
    ];

    public function shoes(): HasMany
    {
        return $this->hasMany(Shoe::class);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    protected static function boot()
    {
        parent::boot();

        // Hapus gambar saat kategori dihapus
        static::deleting(function ($category) {
            if ($category->icon && Storage::disk('public')->exists($category->icon)) {
                Storage::disk('public')->delete($category->icon);
            }
        });

        // Hapus gambar lama sebelum diperbarui
        static::updating(function ($category) {
            if ($category->isDirty('icon') && $category->getOriginal('icon')) {
                Storage::disk('public')->delete($category->getOriginal('icon'));
            }
        });
    }
}
