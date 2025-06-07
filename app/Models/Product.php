<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'price', 'featured'];
    protected $table = 'products_list';

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function tags()
    {
        return $this->hasMany(Tag::class);
    }

    public function variants(): HasMany
    {
        return $this->hasMany(Variant::class);
    }
}
