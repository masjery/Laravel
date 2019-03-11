<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use DB;


class postcontroller extends Controller
{   
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //$post = Post::all();
       // $posts = DB::select('SELECT * FROM posts');
         //return Post::where('title','post two');
        
        // $posts = Post::orderBy('title','asc')->get();
        // $posts = Post::orderBy('title','asc')->take(1)->get();
        
       //  $posts = Post::orderBy('created_at','asc')->paginate(10);
         $posts = Post::orderBy('created_at','desc')->paginate(10);
        return view('post.index')->with('posts',$posts);
       
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'body'=> 'required',
            'cover_image'=> 'image|nullable|max:1999'
        ]);
        
        //handle image
        if($request->hasFile('cover_image')){
        //get filename with extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
        //get just file name
            $filename = pathinfo($filenameWithExt,  PATHINFO_FILENAME);
        //get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
        //filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
        //upload image
            $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
            } 
            else{
                $fileNameToStore = 'noimage.jpg';
            }
       
        
        //create post
        
        $post= new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->User_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();
        
        return redirect('post')->with('success','post created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('post.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
           $post = Post::find($id);
        //correct user
        
        if(auth()->User()->id !==$post->User_id){
             return redirect('/post')->with('error', 'unauthorized page');  
        }
        return view('post.edit')->with('post',$post);
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
        $post= Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->save();
        
        return redirect('post')->with('success','Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          $post = Post::find($id);
          
          //correct user
        if(auth()->user()->id !== $post->user_id){
             return redirect('/post')->with('error', 'unauthorized page');  
        }
          $post->delete();
          return redirect('post')->with('success','Post deleted');
        
    }
}
