<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Post ;
// use SQL
//use DB ;
class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
     // $posts= Post::orderBy('created_at','DESC')->get();

      // use SQL 
     //$posts = DB::select('select * from posts');
     $posts= Post::orderBy('created_at','DESC')->get();

        return view ('posts.index' , ['posts'=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view ('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'title' => ['required'],
            'body' =>[ 'required'],
        ]);
        $post = new Post ; 
        $post->title =$request->input('title');
        $post->body = $request->input('body') ; 
        $post->save();
        return redirect('/posts')->with('success','post created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $post = Post::find($id);
      
        return view('posts.show' ,['post' => $post]);    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = Post::find($id);
        return view ('posts.edit' ,['post'=>$post]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
     $post = Post::find($id);
    
      $msg ='post  '. $post->title;
      $message = $msg ;
     if ($request->title != null){
      $msg.=' title updated from('.strtoupper($post->title).' )to ('.strtoupper($request->title ).')';
      $post->title = $request->input('title');} 
  
     if ($request->body != null){

     $post->body =$request->input('body');
    $msg.='      body updated from (  '.strtoupper($post->body).'  ) to ( '.strtoupper($request->body).')';}
    
     $post->save();


        if ($msg!=$message){
     return redirect('/posts')->with('success',$msg);}
     else{
        return redirect('/posts')->with('error',$post->title.'    did not updated');
     }
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::find($id);
        $title=$post->title ;
        $post->delete();
        return redirect('/posts' )->with('success' , $title.'  deleted');
        //
    }
}
