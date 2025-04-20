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

        // For Laravel Cloud - this works with both public and private buckets
        return Storage::disk('s3')->url($this->image);
    }

    /**
     * Create a temporary URL for private buckets.
     *
     * @param int $expiration Time in minutes until URL expires
     * @return string
     */
    public function getTemporaryUrl($expiration = 5)
    {
        if (!$this->image) {
            return '';
        }

        try {
            // For private buckets in Laravel Cloud
            return Storage::disk('s3')->temporaryUrl(
                $this->image,
                now()->addMinutes($expiration)
            );
        } catch (\Exception $e) {
            // Fallback to regular URL if bucket doesn't support signed URLs
            return $this->getUrl();
        }
    }
}
