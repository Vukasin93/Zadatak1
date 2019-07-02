@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href='/zadatak/public/articles/create'  class="btn btn-primary">Create article</a>
                    <h3>Your Articles</h3>
                    @if(count($articles)>0)
                    <table class='table table-striped'>
                        <tr>
                            <th>Title</th>
                            <th></th>
                            <th></th>
                        </tr>
                        @foreach($articles as $article)
                        <tr>
                                <td>{{$article->title}}</td>
                                <td><a href="/zadatak/public/articles/{{$article->id}}/edit" class="btn btn-default">Edit</a></td>
                                <td>

                                 {{Form::open(['action' => ['ArticlesController@destroy',$article->id],'method' => 'POST' ,'class'=>'pull-right'])}}
                                 {{Form::hidden('_method','DELETE') }}
                                 {{Form::submit('Delete', ['class'=> 'btn btn-danger'])}}
                                 {{ Form::close() }}
                                </td>
                        </tr>
                        @endforeach
                    </table>
                    @else
                    <p>You don't have articles</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

