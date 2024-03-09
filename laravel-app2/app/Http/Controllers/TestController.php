<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Custom\Myfolder\CustomNamespace;


class TestController extends Controller
{
    public function index() {
        $data = new CustomNamespace();
        $test = $data->getNameSpace();

        $data2 = $data->newFunction();

        $staticMethod = CustomNamespace::testStatic();

        return view('namespace', compact('test', 'data2', 'staticMethod'));
    }


    public function myTestFunction() {
        return view('test');
    }


}


