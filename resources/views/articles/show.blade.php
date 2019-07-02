@extends('layouts.app');

@section('content')
<a href='/zadatak/public/articles' class='btn btn-default'>Go Back</a>
    <h1>{{$article->title}}</h1>
    <div>{!!$article->body!!}</div>
    <hr>
    <small>Written on {{$article->created_at}} by  {{$article->user->name}}</small>
    <hr>
    @if(!Auth::guest())
        @if(Auth::user()->id == $article->user->id)
        <a href='/zadatak/public/article/{{$article->id}}/edit' class='btn btn-default'>Edit</a>
        {{Form::open(['action' => ['ArticleController@destroy',$article->id],'method' => 'POST' ,'class' =>'pull-right'])}}
        {{Form::hidden('_method','DELETE') }}
        {{Form::submit('Delete', ['class'=> 'btn btn-danger'])}}
        @endif
    @endif
@endsection