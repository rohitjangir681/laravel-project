<?php
use Illuminate\Support\Str;

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
        return \App\Models\Block::where('identifier', $urlKey)->exists();
    }
}


?>