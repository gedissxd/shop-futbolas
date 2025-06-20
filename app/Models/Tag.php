<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'product_id'];

    /**
     * Get the product that owns the tag.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
