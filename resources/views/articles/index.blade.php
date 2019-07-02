@extends('layouts.app');

@section('content')
    <h1>Articles</h1>
    @if(count($articles)>0)
    @foreach($articles as $article)
    <div class='well'>
        <div class='row'>
            <div class='col-md-4 col-sm-4'>
                <img  src="/zadatak/public/storage/cover-images/{{$article->cover_image}}" style="width:200px">
            </div>
            <div class='col-md-8 col-sm-8'>
                    <h3><a href="/zadatak/public/articles/{{$article->id}}">{{$article->title}}</a></h3>
                    <small>Written on {{$article->created_at}} by  {{$article->user->name}}</small>
            </div>
    
        </div>
    </div>
    @endforeach
    @else
    <p>Nema artikla</p>
    @endif
@endsection