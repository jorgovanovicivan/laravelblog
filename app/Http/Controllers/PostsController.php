<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Post as PostModel;
use Illuminate\Http\Request;
use DB;

use App\Http\Resources\PostsResource as PostResource;
class PostsController extends BaseController
{

    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);//osim show da se logujes
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //sve postove iz baze
      //  $posts=Post::all();
       //  $posts= Post::orderBy('title','asc')->get;
   //  $posts= Post::orderBy('title','desc')->get;//sortira 
  // $posts=DB::select('SELECT *FROM posts');
       // return view('posts.index')->with('posts', $posts);
       $posts = PostModel::all();
       return view('posts.index')->with('posts', $posts);
     //  return $this->sendResponse(PostResource::collection($posts), 'Products retrieved successfully');
    // return response()->json(Post::get(),200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,['title'=>'required','body'=>'required',] );
        $post=new Post;
        $post->title=$request->input('title');
        $post->body=$request->input('body');
        $post->user_id= auth()->user()->id;//dolazi iz auth ne trazi se,jer user ima id
        $post->save();
        return redirect('/posts')->with('success','Post kreiran.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $post= Post::find($id);
  
      return view('posts.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post= Post::find($id);
        if(auth()->user()->id!==$post->user_id){
            return redirect('/posts')->with('error','NEMOGUC PRISTUP');
        }
        return view('posts.edit')->with('post',$post);

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
        $this->validate($request,['title'=>'required','body'=>'required',] );
        $post=Post::find($id);
        $post->title=$request->input('title');
        $post->body=$request->input('body');
        $post->save();
        return redirect('/posts')->with('success','Post je izmenjen.');
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
        if(auth()->user()->id!==$post->user_id){
            return redirect('/posts')->with('error','NEMOGUC PRISTUP');
        }
        $post->delete();
        return redirect('posts')->with('success','Post izbirsan');
    }
}
