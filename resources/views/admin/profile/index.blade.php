@extends('layouts.admin')
@section('title', '登録済みプロフィールの一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h2>プロフィール一覧</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <a href="{{ action('Admin\ProfileController@add') }}" role="button" class="btn btn-primary">新規作成</a>
            </div>
        </div>
        <div class="row">
            <div class="list-Profile col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th width="5%">ID</th>
                                <th width="10%">名前</th>
                                <th width="10%">趣味</th>
                                <th width="5%">性別</th>
                                <th width="50%">自己紹介</th>
                                <th width="20%">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($profiles as $profile)
                                <tr>
                                    <td>{{ $profile->id }}</td>
                                    <td>{{ \Str::limit($profile->name, 100) }}</td>
                                    <td>{{ \Str::limit($profile->hobby, 100) }}</td>
                                    <td>{{ \Str::limit($profile->gender, 100) }}</td>
                                    <td>{{ \Str::limit($profile->introduction, 100) }}</td>
                                    <td style="display:table; margin:10px;">
                                        <div style="display:table-cell;">
                                            <a class="btn btn-primary" style="margin-right:5px;" href="{{ action('Admin\ProfileController@edit', ['id' => $profile->id]) }}">編集</a>
                                        </div>
                                        <div style="display:table-cell;">
                                            <form action="{{ action('Admin\ProfileController@delete') }}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="id" value="{{ $profile->id }}">
                                                <input class="btn btn-primary" type="submit" value="削除" >
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection