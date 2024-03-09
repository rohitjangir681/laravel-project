<?php

use App\Models\Enquirie;
use App\Models\Page;

function getMenuPages() {
    $pages = Page::where('status', 1)->orderBy('ordering', 'ASC')->get();    
    return $pages;
}

function enquiriesCount() {
    $countEnquiries = Enquirie::count();
    return $countEnquiries;
}



?>