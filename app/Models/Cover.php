<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

class Cover extends Model
{
    use HasFactory;
    protected $fillable = [
        'image_path',
        'title',
        'start_at',
        'end_at',
        'is_active',

    ];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    protected function image(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (!$this->image_path) {
                    return asset('img/sin-portada.png');
                }

                if (Storage::disk('public')->exists($this->image_path)) {
                    return Storage::disk('public')->url($this->image_path);
                }

                return asset('img/sin-portada.png');
            },
        );
    }
}
