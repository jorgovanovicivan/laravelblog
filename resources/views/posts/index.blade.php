
@extends('layouts.app')

@section('content')

<p>Posts</p>
@if(count($posts)>0)

<div class="card">
<ul class="list-group list-group-flash">
@foreach($posts as $post)

<li class="list-group-item"></li>
<h3 >  <a class="text-info" href="/posts/{{$post->id}}">{{$post->title}}</a></h3>

<small>Written on {{$post->created_at}}</small>
@endforeach
</ul>
</div>
@else

@endif
  @endsection