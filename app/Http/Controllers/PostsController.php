<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Post ;
// use SQL
//use DB ;
class PostsController extends Controller
{
 //acces control
 public function __construct()
 {
     $this->middleware('auth', ['except' => ['index', 'show']]);
     //
 }


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
       if ( $request->hasFile('cover_image')) {
           $fileNameWithExt =$request->file('cover_image')->getClientOriginalName();
           $fileName=pathinfo($fileNameWithExt,PATHINFO_FILENAME);
           $ext =$request->file('cover_image')->getClientOriginalExtension();
           $fileNameToStore= $fileName.'_'.time().$ext;
           $path=$request->file('cover_image')->storeAs('public/cover_image',$fileNameToStore);
       }
       else{
           $fileNameToStore='no.jpg';
       }
        $post = new Post ; 
        $post->cover_image = $fileNameToStore;
        $post->title =$request->input('title');
        $post->body = $request->input('body') ; 
        $post->user_id= auth()->user()->id;
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
         if (auth()->user()->id!==$post->user_id){
              return redirect ('/posts')->with('error','SORRY ! You are unautherized to edit this post ');
          }
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
        if ( $request->hasFile('cover_image')) {
            $fileNameWithExt =$request->file('cover_image')->getClientOriginalName();
            $fileName=pathinfo($fileNameWithExt,PATHINFO_FILENAME);
            $ext =$request->file('cover_image')->getClientOriginalExtension();
            $fileNameToStore= $fileName.'_'.time().$ext;
            $path=$request->file('cover_image')->storeAs('public/cover_image',$fileNameToStore);
        }
        else{
            $fileNameToStore='no.jpg';
        }
     $post = Post::find($id);
    
      $msg ='post  '. $post->title;
      $message = $msg ;

     if ($request->title != null){
      $msg.=' title updated from('.strtoupper($post->title).' )to ('.strtoupper($request->title ).')';
      $post->title = $request->input('title');}

  if($request->hasFile('cover_image')){
      
      $post->cover_image=$fileNameToStore;
      $msg.='  image upageted';
  }

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
      
        if (auth()->user()->id!==$post->user_id){
            return redirect ('/posts')->with('error','SORRY ! You are unautherized to delete this post ');
        }  
        $post->delete();
        return redirect('/posts' )->with('success' , $title.'  deleted');
        //
    }
}
