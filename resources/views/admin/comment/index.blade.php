@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">評論管理</div>
                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                {!! implode('<br>', $errors->all()) !!}
                            </div>
                        @endif

                            <table  class="table table-striped">
                                <thead>
                                    <tr class="panel-title">
                                        <td class="col-md-5 col-md-offset-1">Content</td>
                                        <td class="col-md-3 col-md-offset-1">User</td>
                                        <td class="col-md-4 col-md-offset-1">Page</td>
                                        <td class="col-md-2 col-md-offset-1">Edit</td>
                                        <td class="col-md-2 col-md-offset-1">Delete</td>
                                    </tr>
                                </thead>


                                @foreach ($articles as $article)
                                    <tr >
                                        <td class="col-md-5" style="width: 30px; max-width: 30px; overflow: hidden; ">{{$article->content}}</td>
                                        <td class="col-md-3 col-md-offset-1">{{$article->nickname}}</td>
                                        <td class="col-md-3 col-md-offset-1">{{$article->title}}</td>
                                        <td class="col-md-2 col-md-offset-1"><a href="{{url('admin/comment/'.$article->id.'/edit')}}" class="btn btn-success">编辑</a></td>
                                        <td class="col-md-2 col-md-offset-1">
                                            <form action="{{url('admin/comment/'.$article->id)}}" method="POST"  style="display: inline;">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger">删除</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach


                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection