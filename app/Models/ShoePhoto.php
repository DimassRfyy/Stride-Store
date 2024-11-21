<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class ShoePhoto extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'photo',
        'shoe_id'
    ];

    protected static function boot()
    {
        parent::boot();

        // Hapus gambar saat Shoe dihapus
        static::deleting(function ($shoePhoto) {
            if ($shoePhoto->photo && Storage::disk('public')->exists($shoePhoto->photo)) {
                Storage::disk('public')->delete($shoePhoto->photo);
            }
        });

        // Hapus gambar lama sebelum diperbarui
        static::updating(function ($shoePhoto) {
            if ($shoePhoto->isDirty('photo') && $shoePhoto->getOriginal('photo')) {
                Storage::disk('public')->delete($shoePhoto->getOriginal('photo'));
            }
        });
    }
}
