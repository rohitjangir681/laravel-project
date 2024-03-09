<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name',
        'status',
        'is_featured',
        'sku',
        'qty',
        'stock_status',
        'weight',
        'price',
        'special_price',
        'special_price_from',
        'special_price_to',
        'short_description',
        'description',
        'related_product',
        'url_key',
        'meta_tag',
        'meta_title',
        'meta_description'
    ];

        
    function categories() {
        return $this->belongsToMany(Category::class, 'product_categories');
    }

    public function productAttributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }

    // public function getAttributesData() {
    //     return $this->belongsToMany(Product::class, 'product_attributes');
    // }





}
