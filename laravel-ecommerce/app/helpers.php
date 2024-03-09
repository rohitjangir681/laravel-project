<?php

use Illuminate\Support\Str;
use App\Models\Block;

if (!function_exists('generateUniqueUrlKey')) {
    function generateUniqueUrlKey($name)
    {
        $baseSlug = Str::slug($name);
        $urlKey = $baseSlug;
        $counter = 1;

        // Check if the URL key already exists
        while (urlKeyExists($urlKey)) {
            $urlKey = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $urlKey;
    }
}

if (!function_exists('urlKeyExists')) {
    function urlKeyExists($urlKey)
    {
        // Assuming Product is your model name
        return \App\Models\Page::where('url_key', $urlKey)->exists();
    }
}



// Product url key

if (!function_exists('generateProductUniqueUrlKey')) {
    function generateProductUniqueUrlKey($name)
    {
        $baseSlug = Str::slug($name);
        $urlKey = $baseSlug;
        $counter = 1;

        // Check if the URL key already exists
        while (productUrlKeyExists($urlKey)) {
            $urlKey = $baseSlug . '-' . $counter;
            $counter++;
        }
        return $urlKey;
    }
}

if (!function_exists('productUrlKeyExists')) {
    function productUrlKeyExists($urlKey)
    {
        // Assuming Product is your model name
        return \App\Models\Product::where('url_key', $urlKey)->exists();
    }
}



// Category URL Key

if (!function_exists('generateCategoryUniqueUrlKey')) {
    function generateCategoryUniqueUrlKey($name)
    {
        $baseSlug = Str::slug($name);
        $urlKey = $baseSlug;
        $counter = 1;

        // Check if the URL key already exists
        while (categoryUrlKeyExists($urlKey)) {
            $urlKey = $baseSlug . '-' . $counter;
            $counter++;
        }
        return $urlKey;
    }
}

if (!function_exists('categoryUrlKeyExists')) {
    function categoryUrlKeyExists($urlKey)
    {
        return \App\Models\Category::where('url_key', $urlKey)->exists();
    }
}


// Attribute Name key

if(!function_exists('generateNameKey')) {
    function generateNameKey($name) {
        $baseKey = Str::lower($name);
        $nameKey = Str::replace(' ', '_', $baseKey);
        $counter = 1;

        while(nameKeyExists($nameKey)) {
            $nameKey = $nameKey . '_' . $counter; 
        }
        return $nameKey;
    }
}

if(!function_exists('nameKeyExists')) {
    function nameKeyExists($nameKey) {
        return \App\Models\Attribute::where('name_key', $nameKey)->exists();
    }
}


function getBlock($identifier) {
    $blocks = Block::where('identifier', $identifier)->where('status', 1)->first();
    
    return $blocks;
} 


// echo "<h1>This is test helper</h1>";
