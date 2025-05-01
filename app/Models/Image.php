<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    protected $fillable = ['product_id', 'image'];
    protected $table = 'product_images';

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the URL for the image stored in S3.
     *
     * @return string
     */
    public function getUrl()
    {
        if (!$this->image) {
            return '';
        }
        return Storage::disk('s3')->url($this->image);
    }
}
