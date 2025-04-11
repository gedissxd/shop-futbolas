<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'price', 'variant', 'stock'];
    protected $table = 'products_list';

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
