<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pages extends Controller
{
    public function index(){
        $title = 'welcome dudes';
           // return view('pages.index',compact('title'));
            return view('pages.index')->with('title',$title);
    }
    
      public function about(){
       $title = 'About';
           // return view('pages.index',compact('title'));
            return view('pages.about')->with('title',$title);
    }
    
      public function service(){
          $data=array(
          'title' => 'Services',
          'services'=>['web development','programming','SEO']          
          );
        return view('pages.service')->with($data);
    }
}
