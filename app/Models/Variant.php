<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

class Variant extends Model
{
    use HasFactory;
    protected $fillable = [
        'sku',
        'stock',
        'product_id',
    ];

    protected function image(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (!$this->image_path) {
                    return asset('img/image_placeholder.jpg');
                }

                if (Storage::disk('public')->exists($this->image_path)) {
                    return Storage::disk('public')->url($this->image_path);
                }

                return asset('img/image_placeholder.jpg');
            },
        );
    }



    //Relacion uno a muchos inversa
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    //Relacion muchos a muchos
    public function features()
    {
        return $this->belongsToMany(Feature::class)->withTimestamps();
    }
}
