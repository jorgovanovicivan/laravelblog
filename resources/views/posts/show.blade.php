
@extends('layouts.app')

@section('content')
<a href="/posts" class="btn btn-secondary">Nazad</a>
<h1 class="text-dark">{{$post->title}} </h1>
<p class="text-dark">{{$post->body}}</p>

 <hr>
 @if(!Auth::guest())
 @if(Auth::user()->id == $post->user_id)
 <a href="/posts/{{$post->id}}/edit" class="btn btn-success" style="width:73px">Edit</a>
 {!!Form::open(['action'=>['App\Http\Controllers\PostsController@destroy', $post->id],'method'=>'POST','class'>'pull-right'])!!}
 {{Form::hidden('_method', 'DELETE')}}
 {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
 {!!Form::close()!!}

 @endif
 @endif
 <div>@comments(['model' => $post ])</div>
  @endsection