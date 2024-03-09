<?php 

use App\Models\Page;


function getPagesMenu() {
    $pages = Page::where('parent_id', 0)->get();
    return $pages;
}

function getSubMenu($id) {
    
    $pages = Page::where('parent_id', $id)->get();
    return $pages;
}

function getSubSubMenu($id) {
    $pages = Page::where('parent_id', $id)->get();
    return $pages;
}


?>