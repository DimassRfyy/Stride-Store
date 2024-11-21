<?php

namespace App\Models;

use App\Models\Shoe;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Brand extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'logo',
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

        // Hapus gambar saat brand dihapus
        static::deleting(function ($brand) {
            if ($brand->logo && Storage::disk('public')->exists($brand->logo)) {
                Storage::disk('public')->delete($brand->logo);
            }
        });

        // Hapus gambar lama sebelum diperbarui
        static::updating(function ($brand) {
            if ($brand->isDirty('logo') && $brand->getOriginal('logo')) {
                Storage::disk('public')->delete($brand->getOriginal('logo'));
            }
        });
    }
}
