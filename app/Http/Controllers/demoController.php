<?php

namespace App\Http\Controllers;

use App\Models\demo;
use Illuminate\Http\Request;

class demoController extends Controller
{
    public function demo(Request $request) {
        // dd($request->all());
        demo::create($request->all());
        // $input = [
        //     'title' => 'Demo Title',
        //     'description' => 'dfsdfds',
        //     'card' => [
        //         'title' => 'sdfdfdsfs',
        //         'description' => 'Twcsdcdsco',
        //         'image' => 'dsfsdfsfds',
        //     ]
        // ];
        // dd($input['card']);
        // $item = demo::create($input);

        // dd($item->data);
    }
}
