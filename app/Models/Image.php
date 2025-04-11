<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['product_id', 'image'];
    protected $table = 'product_images';

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
