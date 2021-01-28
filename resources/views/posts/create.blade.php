
@extends('layouts.app')

@section('content')
<h1 style="color:dark;">Create Post</h1>
{!! Form::open(['action' => 'App\Http\Controllers\PostsController@store', 'method'=>'POST']) !!}
   <div class="form-group">
   
   {{Form::label('title', 'Title', ['class'=>'text-dark'])}}
   {{Form::text('title','',['class'=>'form-control','placeholder'=>'Title'])}}
   
   
   </div>
   <div class="form-group">
   
   {{Form::label('body', 'Body', ['class'=>'text-dark'])}}
   {{Form::textarea('body','',['class'=>'form-control ','placeholder'=>'Body'])}}
   
   
   </div>
   {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
{!! Form::close() !!}
  @endsection 