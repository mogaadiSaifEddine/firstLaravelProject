<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function index() {
        $title  = "Lsapp";
        $first = "Test : first app Laravel        " ;
        return view ('pages.index',compact('title','first'));
    }
    public function about (){
        $welcome = 'WELCOME TO THE : 
        about section';
        return view ('pages.about' , compact ('welcome'));
    } 


    public function services (){
        $data = array(
            'title'=>'services' , 
        'services'=>['Laravel ' , 'express' , 'php' , 'node']
        );
        return view ('pages.services')->with($data);
    }
    
}
