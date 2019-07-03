@extends('layouts.app');

@section('content')
    <h1>Edit article</h1>
    
    {!! Form::open(['action'=>['ArticlesController@update',$article->id], 'method'=> 'POST','enctype' =>'multipart/form-data']) !!}
    
    <div class='form-group'>
        {{Form::label('title', 'Title')}}
        {{Form::text('title', $article->title,['class'=> 'form-control', 'placeholder' => 'Title'])}}
    </div>

    <div class='form-group'>
            {{Form::label('body', 'Body')}}
            {{Form::textarea('body', $article->body,['id' => 'article-ckeditor','class'=> 'form-control', 'placeholder' => 'Body text'])}}
    </div>

    <div class='form-group'>
            {{Form::file('cover-image')}}
     </div>
    

        {{Form::hidden('_method','PUT') }}
        {{Form::submit('Submit', ['class'=> 'btn btn-primary'])}}


    {!! Form::close() !!}
   
@endsection