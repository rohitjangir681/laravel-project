<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Slider;
use App\Models\Block;

class HomeController extends Controller
{
    public function index() {
        $sliders = Slider::where('status', 1)->orderBy('ordering', 'ASC')->get();
        $blocks = Block::where('status', 1)->orderBy('ordering', 'ASC')->get();
        return view('web.index', compact('sliders', 'blocks'));
    }
    
    public function contact() {
        return view('web.contact');
    }


    // for particular page open data
    public function page($urlKey) {
        // echo $urlKey;
        $pages = Page::where('url_key', $urlKey)->first();
        return view('web.page', compact('pages'));
    }

    // public function identifier($identifier) {
    //     echo $identifier;
    //     die();
    //     // $blocks = Block::where('identifier', $identifier)->first();
    //     // return view('web.block', compact('identifier'));
    // }

}

// rohitjangir681@gmail.com
// Visual Studio Code
// user_index, user_create, user_edit, user_delete



